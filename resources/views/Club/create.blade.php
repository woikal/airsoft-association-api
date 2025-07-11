@extends('general')

@section('title', 'PDF parser')

@section('content')
    <div class="">

        <form action="{{ route('club.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="form-group col-md-8 col-sm-8">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>
                <div class="form-group col">
                    <label for="abbreviation">Abkürzung</label>
                    <input class="form-control" type="text" name="abbreviation" id="abbreviation">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="club_id">ZVR Zahl</label>
                    <input class="form-control" type="text" name="club_id" id="club_id">
                </div>
                <div class="form-group col-md-6">
                    <label for="location">Vereinssitz</label>
                    <input class="form-control" type="text" name="location" id="location">
                </div>
                <div class="form-group col-md-2">
                    <label for="founded_at">Gründungsjahr</label>
                    <select class="form-control" type="text" name="founded_at" id="founded_at">
                        @foreach(range(today()->format('Y'), 2000) as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col">
                    <label for="email">E-Mail</label>
                    <input class="form-control" type="email" name="email" id="email">
                </div>
                <div class="form-group col">
                    <label for="website">Website</label>
                    <input class="form-control" type="text" name="website" id="website">
                </div>
            </div>

            <div class="row">
                <div class="form-group col">
                    <label for="instagram">Instagram</label>
                    <input class="form-control" type="text" name="instagram" id="instagram">
                </div>
                <div class="form-group col">
                    <label for="facebook">Facebook</label>
                    <input class="form-control" type="text" name="facebook" id="facebook">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Verein eintragen</button>
        </form>
    </div>
@endsection
