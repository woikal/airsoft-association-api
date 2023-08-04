@extends('general')

@section('title', 'PDF parser')

@section('content')
    <div class="container">
        <div class="panel panel-primary">

            <div class="panel-body">
                @if($message = Session::get('success'))

                    <div class="alert alert-success alert-block">

                        <strong>{{ $message }}</strong>

                    </div>

                @endif
            </div>

            <form method="post" action="{{ route('parser.load') }}" enctype="multipart/form-data">
                @csrf

                <label for="files">ZVR-Auszug</label>

                <div class="mb-3">

                    <label class="form-label" for="inputFile">Select Files:</label>

                    <input
                        type="file"
                        name="files[]"
                        id="inputFile"
                        multiple
                        class="form-control @error('files') is-invalid @enderror">

                    @error('files')

                    <span class="text-danger">{{ $message }}</span>

                    @enderror

                </div>

                <button type="submit">Einlesen</button>
            </form>
        </div>
    </div>
@endsection
