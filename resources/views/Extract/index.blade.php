@extends('general')

@section('title', 'Extracts')

@section('content')
    @if(count($extracts))
        <ul>
            @foreach($extracts as $extract)
                <li>
                    {{ $extract->id }}
                </li>
            @endforeach
        </ul>
    @endif
@endsection
