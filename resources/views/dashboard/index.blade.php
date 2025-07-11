@extends('general')

@section('title', 'Dashboard')

@section('content')
    <dl>
        <dt>Uploaded Files</dt>
        <dd>{{ $extracts_count ?? 0 }}</dd>


        <dt>Stored Clubs</dt>
        <dd>{{ $clubss_count ?? 0 }}</dd>
    </dl>
@endsection
