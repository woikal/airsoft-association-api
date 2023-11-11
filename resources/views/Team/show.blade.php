@extends('general')

@section('title', 'Teams')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Club ID</th>
            <th>Founded</th>
            <th>HQ Location</th>
        </tr>
        </thead>

        <tbody>
        @forelse($associations as $team)
            <tr>
                <td rowspan="{{ $team['officials']->count() + 1 }}">{{ $loop->index }}</td>
                <td>{{ $team['name'] }}</td>
                <td>{{ $team->isClub() ? $team->clubId : '-' }}</td>
                <td>
                    @forelse($team->officials as $official)
                        {{ $official['name'] }} {{ $official['surname'] }} ({{ $official['role'] }})<br>
                    @empty
                        -
                    @endforelse
                </td>
                <td>{{ $team['foundedAt']->format('Y/m') }}</td>
                <td>{{ $team['headquarter'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No teams found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
