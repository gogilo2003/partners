@extends('admin::layout.main')


@section('title')
    @parent
    Partners
@endsection

@section('page_title')
    <i class="fas fa-users"></i> Partners
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
    <div id="partners_app">
        <Partners />
    </div>
@endsection
@push('scripts_bottom')
    <script src="{{ asset('vendor/partners/js/partners.js') }}"></script>
@endpush
