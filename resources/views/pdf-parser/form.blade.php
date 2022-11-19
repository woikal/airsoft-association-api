@extends('general')

@section('title', 'PDF parser')

@section('content')
    test
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <form method="post" action="/parse" enctype="multipart/form-data">
            @csrf

            <label for="pdf">ZVR-Auszug</label>

            <input type="file"
                   id="pdf" name="pdf"
                   accept="application/pdf">
            <button type="submit">Einlesen</button>
        </form>
    </div>
@endsection
