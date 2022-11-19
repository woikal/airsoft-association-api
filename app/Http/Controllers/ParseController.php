<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParsePdfRequest;
use App\Models\AssociationExcerptParser;

class ParseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('pdf-parser.form');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function parse(ParsePdfRequest $request)
    {
        $pdf = $request->file('pdf');

        $parser = new AssociationExcerptParser($pdf);
        $association = $parser->parse();
        dd($request->file('pdf'));
        $content = $request->toArray();

        return view('pdf-parser.show', ['content' => $content]);
    }
}
