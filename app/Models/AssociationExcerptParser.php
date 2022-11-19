<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Smalot\PdfParser\Document;
use Smalot\PdfParser\Page;
use Symfony\Component\HttpFoundation\File\File;
use Smalot\PdfParser\Parser;

class AssociationExcerptParser
{
    private Document $document;

    /**
     * @throws \Exception
     */
    public function __construct(File $file)
    {
        $parser = new Parser();
        $this->document = $parser->parseFile($file);
    }

    public function parse(): Collection
    {
        $pages = $this->document->getPages();
        $raw = $this->parsePages($pages);
        $idx = 0;
        while ($idx < count($raw)) {
            switch ($raw[$idx]) {
            case 'Vereinsregisterauszug ':
                $recordDate = new CarbonImmutable($this->extract($raw, ++$idx, '(?:\d{2}\.){2}\d{4}'));
                break;
            case 'Zuständigkeit':
                $authority = $this->extract($raw, ++$idx);
                break;
            case 'ZVR-Zahl':
                $zvr = $this->extract($raw, ++$idx, '\d+');
                break;
            case 'Name':
                $name = $this->extract($raw, ++$idx);
                break;
            case 'Sitz':
                $headquarter = $this->extract($raw, ++$idx);
                break;
            case 'c/o':
                $c_o = $this->extract($raw, ++$idx);
                break;
            case 'Zustellanschrift':
                $postalAddress = $this->extract($raw, ++$idx);
                break;
            case 'Entstehungsdatum':
                $foundedAt = new CarbonImmutable($this->extract($raw, ++$idx));
                break;
            case "\nVertretungsregelung":
                $positions = $this->extractPositions($raw, $idx++);
                break;
            default:
                $idx++;
            }
        }

        $arr = [
            'recordDate'  => $recordDate ?? null,
            'auhtority'   => $authority ?? '',
            'name'        => $name ?? '',
            'ZVR'         => $zvr ?? 0,
            'headquarter' => $headquarter ?? '',
            'c/o'         => $c_o ?? '',
            'foundedAt'   => $foundedAt ?? null,
            'positions'   => $positions?? collect(),
        ];
        dump($raw, $arr);

        return collect($arr);
    }

    protected function extract(Collection $raw, int $idx, string $pattern = '', string $flags = ''): ?string
    {
        if ($pattern === '') {
            return $raw[$idx];
        }

        preg_match("#$pattern#$flags", $raw[$idx], $matches);

        return $matches[0] ?? null;
    }

    protected function extractPositions(Collection $raw, int $startIndex): Collection
    {
        $positions = [];
        $blockLength = 9;
        $i = $startIndex + 1;
        while ($i < count($raw) - 4 - $blockLength) {
            $positionIndex = ($i - $startIndex) / $blockLength;
            $positions[(int) $positionIndex] = [
                'title'   => $raw->offsetGet($i),
                'name'    => $raw[$i + 5],
                'surname' => $raw[$i + 7],
            ];
            $i += $blockLength;
        }
        $positions[0]['title'] = $this->extract($raw, $startIndex, '(?:Organschaftliche Vertreter)\w+');
        dd($raw, $positions);

        return collect($positions);
    }

    private function parsePages(array $pages): Collection
    {
        $content = collect();
        foreach ($pages as $page) {
            $content->add($this->filterPage(collect($page->getTextArray())));
        }

        return $content->flatten(1);
    }

    private function filterPage(Collection $raw): Collection
    {
        $raw->forget(range($raw->count() - 4, $raw->count() - 1));
        $raw->transform(fn ($i) => Str::replace('"-" = Keine Eintragungen vorhanden', '', $i));
        $raw = $raw->filter(fn ($i) => is_string($i) && !empty($i));

        return $raw;
    }

}