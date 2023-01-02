@extends('layouts.base')

@section('body')

    @include('partials.navigation')
    @yield('content')

    @isset($slot)
        {{ $slot }}
    @endisset
    @stack('scripts')
@endsection
