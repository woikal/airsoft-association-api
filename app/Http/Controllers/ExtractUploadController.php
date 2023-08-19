<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadExtractRequest;
use App\Models\AssociationParser;
use App\Models\Extract;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ExtractUploadController extends Controller
{
    /**
     * Display a form to upload a single zvr file.
     *
     * @return Response
     */
    public function form(): Response
    {
        return response()->view('zvrUpload.form');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function upload(UploadExtractRequest $request): Response
    {
        if ($request->file('files')) {
            $parser = new AssociationParser();
            $extracts = [];
            foreach ($request->file('files') as $file) {gitkr
                if (!$file->isValid()) {
                    continue;
                }
                $parser->setFile($file);

                if (!$parser->validate()) {
                    continue;
                }

                $filename = Hash::make($file->getFilename());
                $file->move(public_path('uploads'), $filename);

                $extracts[] = Extract::create([
                    'original_filename' => $file->getFilename(),
                    'filename'          => $filename,
                    'zvr'               => $parser->getZvr(),
                    'parsed'            => false,
                    'uploaded_by'       => Auth::user(),
                ]);
            }
            if (count($extracts)) {
                return response()->view('pdf-parser.show', compact('extracts'));
            }
        }

        return response()->view('extract.form', ['notifications' => ['No files where uploaded']]);
    }
}
