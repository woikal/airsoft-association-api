<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Smalot\PdfParser\Document;
use Smalot\PdfParser\Page;
use Symfony\Component\HttpFoundation\File\File;
use Smalot\PdfParser\Parser;

class AssociationParser
{
    const LABEL_AUTHORITY_PERIOD = 'Vertretungsbefugnis';
    const LABEL_PREFIX           = 'Titel (vorang.)';
    const LABEL_POSTFIX          = 'Titel (nachg.)';
    const DISCLAIMER_1           = 'Dieser Auszug enthält Angaben über jene Personen, welche als Gründer oder';
    const LABEL_DATETIME         = 'Tagesdatum / Uhrzeit';
    const LABEL_HEADER           = 'Vereinsregisterauszug ';

    protected Parser $parser;
    protected Document $document;
    protected Collection $rawData;
    protected string $zvr;

    /**
     * @throws \Exception
     */
    public function __construct(File $file = null)
    {
        $this->parser = new Parser();
        $this->rawData = collect();

        if ($file) {
            $this->setFile($file);
        }
    }

    public function setFile(File $file)
    {
        $this->rawData = collect();
        $this->document = $this->parser->parseFile($file);
    }


    public function parse(): Collection
    {
        $pages = $this->document->getPages();
        $this->rawData = $this->parseContents($pages);

        $officials = collect();
        foreach ($this->rawData as $idx => $raw) {
            switch ($this->rawData->get($idx)) {
            case self::LABEL_HEADER:
                $recordDate = Carbon::createFromFormat('d.m.Y',
                    Str::afterLast($this->extract($this->rawData, $idx + 1), ' '));
                break;
            case 'Zuständigkeit':
                $authority = $this->extract($this->rawData, $idx + 1);
                break;
            case 'ZVR-Zahl':
                $zvr = $this->extract($this->rawData, $idx + 1, '\d+');
                break;
            case 'Name':
                $name = $this->extract($this->rawData, $idx + 1);
                break;
            case 'Sitz':
                $headquarter = $this->extract($this->rawData, $idx + 1);
                break;
            case 'c/o':
                $c_o = $this->extract($this->rawData, $idx + 1);
                break;
            case 'Zustellanschrift':
                $postalAddress = $this->extract($this->rawData, $idx + 1);
                break;
            case 'Entstehungsdatum':
                $foundedAt = new CarbonImmutable($this->extract($this->rawData, $idx + 1));
                break;
            case self::LABEL_AUTHORITY_PERIOD:
                $officials->add($this->extractOfficials($this->rawData, $idx));
                break;
            case self::LABEL_DATETIME:
                $datetimeString = $this->extract($this->rawData, $idx + 1);
                $time = Str::afterLast($datetimeString, ' ');
                $recordTime = Carbon::createFromFormat('H:i:s', $time);
                break;
            }
        }

        return collect([
            'recordDate'    => $recordDate ?? null,
            'recordTime'    => $recordTime ?? null,
            'authority'     => $authority ?? '',
            'name'          => $name ?? '',
            'ZVR'           => $zvr ?? 0,
            'headquarter'   => $headquarter ?? '',
            'c/o'           => $c_o ?? '',
            'postalAddress' => $postalAddress ?? '',
            'foundedAt'     => $foundedAt ?? null,
            'officials'     => $officials,
        ]);
    }

    public function validate()
    {
        $pages = $this->document->getPages();
        foreach ($pages[0]->getTextArray() as $fragment) {
            if (preg_match('#^\d{9,12}$#', $fragment, $matches)) {
                $this->zvr = $matches[0];

                return true;
            }
        }

        return false;
    }

    public function getZvr(): string
    {
        if (!isset($this->zvr)) {
            $this->validate();
        }

        return $this->zvr ?? '';
    }

    protected function extract(Collection $raw, int $idx, string $pattern = '', string $flags = ''): ?string
    {
        if ($pattern === '') {
            return $raw[$idx];
        }

        preg_match("#$pattern#$flags", $raw[$idx], $matches);

        return $matches[0] ?? null;
    }

    protected function extractOfficials(Collection $raw, int $idx): ?Collection
    {
        $prefixOffset = 7;
        $postfixOffset = 9;

        $prefix = $raw[$idx + $prefixOffset];
        if ($prefix != self::LABEL_POSTFIX) {
            $prefix = null;
            $postfixOffset--;
        }

        $nextAuthLabel = $raw[$idx + $postfixOffset + 2];
        $postfix = in_array($nextAuthLabel, [self::LABEL_AUTHORITY_PERIOD, self::DISCLAIMER_1]) ? null
            : $raw[$idx + $postfixOffset];


        return collect([
            'name'    => $raw[$idx + 4],
            'surname' => $raw[$idx + 6],
            'prefix'  => $prefix,
            'postfix' => $postfix,
            'role'    => $raw[$idx - 1],
            'start'   => Carbon::createFromFormat('d.m.Y', Str::before($raw[$idx + 1], ' - ')),
            'end'     => Carbon::createFromFormat('d.m.Y', Str::after($raw[$idx + 1], ' - ')),
        ]);
    }


    protected function parseContents(array $pages): Collection
    {
        $content = collect();
        foreach ($pages as $page) /** @var Page $page */ {
            $content->add($this->filterPage($page));
        }

        return $content->flatten(1);
    }

    protected function filterPage(Page $page): Collection
    {
        $raw = collect($page->getTextArray());

        // remove page number
        $raw->forget(range($raw->count() - 4, $raw->count() - 1));

        // remove footnote
        $raw->forget($raw->count() - 1);

        // remove placeholders and empty lines
        $raw = $raw->filter(fn($line) => !in_array($line, ['', '-', ' ',]));

        return $raw->values();
    }


}
