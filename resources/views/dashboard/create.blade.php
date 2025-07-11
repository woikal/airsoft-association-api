@extends('general')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">Vereinsregisterauszug hochladen</h3>
                    <p>Lade hier einen Auszug aus dem <a href="">Vereinregister</a> (ZVR) hoch, um autoamtisch dessen
                        Daten zu erfassen</p>

                    <form action="{{ route('parser.load') }}" method="post">
                        <div class="form-row">
                            <label class="form-label" for="inputFile">Datei auswählen</label>

                            <input
                                type="file"
                                name="file"
                                id="inputFile"
                                class="form-control @error('files') is-invalid @enderror">
                        </div>

                        <button type="submit" class="btn btn-primary">Hochladen</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <form action="{{ route('parser.load') }}" method="post">

                    <div class="card-body">
                        <h3 class="card-title">Teamdaten eingeben</h3>
                        <div class="form-row">
                            <label class="form-label" for="inputFile">Select Files:</label>

                            <input
                                type="file"
                                name="file"
                                id="inputFile"
                                class="form-control @error('files') is-invalid @enderror">
                        </div>

                        <div class="form-row mt-2">
                            <button type="submit" class="btn btn-primary">Speichern</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

