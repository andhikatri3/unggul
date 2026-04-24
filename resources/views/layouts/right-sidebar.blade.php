@extends('theme::template')

@section('layout')
    @hasSection('hero')
    <div class="container mx-auto px-4 pt-8">
        @yield('hero')
    </div>
    @endif

    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-9">
                    @yield('content')
                </div>
                <div class="lg:col-span-3">
                    @include('theme::partials.sidebar')
                </div>
            </div>
        </div>
    </section>

@endsection
