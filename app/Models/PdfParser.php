<?php

namespace App\Models;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Smalot\PdfParser\Parser;

class PdfParser
{
    protected Parser $parser;

    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function parse(UploadedFile $file): Collection
    {
        try {
            $pdf = $this->parser->parseFile($file);
        } catch (Exception $e) {
            return 'Parsing failed: '.$e->getMessage();
        }

        return collect(explode("\t", $pdf->getText()));
    }
}