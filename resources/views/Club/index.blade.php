@extends('general')

@section('title', 'Clubs')

@section('content')
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>ZVR</th>
            <th>Officials</th>
            <th>Location</th>
            <th>Founded in</th>
        </tr>
        </thead>

        <tbody>
        @forelse($clubs as $club)
            <tr>
                <td>{{ $loop->index }}</td>
                <td>{{ $club->name }}</td>
                <td>{{ $club->clubId }}</td>
                <td>
                    {{--
                        @forelse($club->officials() as $official)
                            {{ $official['name'] }} {{ $official['surname'] }} ({{ $official['role'] }})<br>
                        @empty
                            -
                        @endforelse
                    --}}
                </td>
                <td>{{ $club->founded_at->format('Y/m') }}</td>
                <td>{{ $club->headquarter }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No teams found</td>
            </tr>
        @endforelse
        </tbody>

        @if(count($clubs))
            <tfoot>
            <tr>
                <td colspan="6">Found {{ count($clubs) }} teams.</td>
            </tr>
            </tfoot>
        @endif
    </table>
@endsection
