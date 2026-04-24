@extends('theme::template')

@section('layout')
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-4 order-2 lg:order-1 lg:self-start lg:sticky lg:top-20">
                    @include('theme::partials.sidebar-statistik')
                </div>
                <div class="lg:col-span-8 order-1 lg:order-2">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
@endsection
