@extends('layouts.errors')

@section('title', 'Halaman tidak ditemukan | Teska')

@section('content')
  <div class="h-screen bg-white">
    <div class="items-center justify-center">
      <div class="mx-auto text-center">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">
          Halaman tidak ditemukan.
        </h1>
        
        <p class="mt-4 text-slate-500">
          Coba cari lagi, atau kembali ke beranda untuk memulai dari awal.
        </p>
        
        <a
          href="{{ route('home.index') }}"
          class="mt-6 inline-block bg-slate-950 px-5 py-3 text-sm font-medium text-white hover:bg-slate-800 focus:outline-none focus:ring duration-150"
        >
          Kembali Ke Beranda
        </a>
      </div>
    </div>
  </div>
@endsection
