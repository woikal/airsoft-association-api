<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoadPdfRequest;
use App\Http\Requests\StoreExtractRequest;
use App\Models\AssociationParser;
use App\Models\Extract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ExtractController extends Controller
{
    public function index(): Response
    {
        return response()->view('extract.index', ['extracts' => Extract::all()]);
    }

    public function create(): Response
    {
        return response()->view('extract.create');
    }

    public function store(StoreExtractRequest $request): RedirectResponse
    {
        /** @var UploadedFile $file */
        $file = $request->file('file');
        if (!$file instanceof UploadedFile || !$file->isValid()) {
            return redirect('extract.creat')->back(415);
        }

        $parser = new AssociationParser();
        $parser->setFile($file);

        if (!$parser->validate()) {
            return redirect('extract.creat')->back(415);
        }

        $filename = self::generateFilename($parser, $file);

        $file->move(storage_path('uploads/zvrs'), $filename);
        $extract = Extract::create([
            'original_filename' => $file->getFilename(),
            'filename'          => $filename,
            'zvr'               => $parser->getZvr(),
            'parsed'            => false,
            'uploaded_by'       => Auth::user(),
        ]);

        return redirect()->route('parse.edit', compact('extract'));
    }

    /**
     * @param AssociationParser $parser
     * @param UploadedFile      $file
     *
     * @return string
     */
    private static function generateFilename(AssociationParser $parser, UploadedFile $file): string
    {
        return sprintf("zvr_%s_%s_%s", $parser->getZvr(), $parser->getRecordDate(), Hash::make($file->getFilename()));
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
