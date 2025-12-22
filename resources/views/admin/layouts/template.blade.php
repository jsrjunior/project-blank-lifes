@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    <h1>{{modelAction($type ?? null, 'label')}}</h1>
@endsection

@section('content')
    @yield('content')
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/tempusdominus/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/moment/br.min.js') }}"></script>

    <script src="{{ asset('vendor/tempusdominus/tempusdominus-bootstrap-4.min.js') }}"></script>
    
    @vite(['resources/js/app.js'])
    @stack('js')
    @include('admin.layouts.partials.scripts')
@endsection
