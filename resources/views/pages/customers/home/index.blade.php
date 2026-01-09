@extends('layouts.app')

@section('title', 'Beranda | Teska')

@section('content')

    {{-- Hero --}}
    <main>
        @include('components.customers.beranda.hero')
    </main>

    {{-- New Product --}}
    <section>
        @include('components.customers.beranda.new-product')
    </section>

    {{-- Popular Product --}}
    <section>
        @include('components.customers.beranda.popular-product')
    </section>
@endsection
