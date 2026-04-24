@extends('theme::template')

@section('layout')
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1">
                <div class="col-span-1">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
@endsection
