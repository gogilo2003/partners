@extends('admin::web.layout.main')

@section('content')
    @foreach ($partners as $partner)
        <p>{{ $partner->name }}</p>
    @endforeach
@endsection
