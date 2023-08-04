<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoadPdfRequest;
use App\Models\AssociationParser;
use Illuminate\Http\Response;

class ParseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function form(): Response
    {
        return response()->view('pdf-parser.form');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function load(LoadPdfRequest $request): Response
    {
        $associations = collect();

        if ($request->file('files')) {
            $parser = new AssociationParser();
            foreach ($request->file('files') as $file) {
                if (!$file->isValid()) {
                    continue;
                }
                $parser->setFile($file);
                $associations->add($parser->parse());

                {
                    $fileName = time() . rand(1, 99) . '.' . $file->extension();

                    $file->move(public_path('uploads'), $fileName);

                    $files[]['name'] = $fileName;
                }
            }
        }

        return response()->view('pdf-parser.show', ['associations' => $associations]);
    }

}
