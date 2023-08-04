@extends('general')

@section('title', 'Erfasster Inhalt')

@section('content')

    <table class="table">
        <thead>

        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Jahr</th>
            <th>Sitz</th>
        </tr>
        </thead>
        <tbody>

        @forelse($associations as $association)
            <tr>
                <th style="border-top: 1px solid; vertical-align: top"
                    rowspan="{{ $association['officials']->count() + 1 }}">{{ $loop->index }}</th>
                <td style="border-top: 1px solid">{{ $association['name'] }}</td>
                <td style="border-top: 1px solid">{{ $association['foundedAt']->format('Y/m') }}</td>
                <td style="border-top: 1px solid">{{ $association['headquarter'] }}</td>
            </tr>
            @foreach($association['officials'] as $official)
                <tr>
                    <td colspan="3">{{ $official['name'] }} {{ $official['surname'] }} ({{ $official['role'] }})</td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td></td>
                <td colspan="6"></td>
            </tr>
        @endforelse

        </tbody>
    </table>
@endsection
