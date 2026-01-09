@extends('layouts.auth')

@section('title', 'Daftar | Teska')

@section('content')
<section class="flex items-center justify-center min-h-screen bg-gray-100">
  <main class="flex items-center justify-center w-full px-8 py-8 sm:px-12 lg:px-16">
    <div class="max-w-xl w-full bg-white p-8 rounded-lg shadow-lg">
      <h1 class="text-2xl font-bold text-center text-gray-900 mb-6">Daftar Akun Baru</h1>
      
      <form action="{{ route('register_post') }}" method="POST" class="grid w-full grid-cols-1 gap-6">
        @csrf

        <!-- Nama -->
        <div class="mb-4">
          <label for="Nama" class="block text-sm font-medium text-gray-700">Nama</label>
          <input
            type="text"
            id="Nama"
            name="name"
            placeholder="John Doe"
            value="{{ old('name') }}"
            class="mt-1 w-full border px-4 py-2 border-gray-200 bg-white text-sm text-gray-700 shadow-sm
            focus:outline-slate-950
            {{ $errors->has('name') ? 'border-red-500' : '' }}"
          />
          @if ($errors->has('name'))
            <div class="mt-1 text-sm text-red-500">{{ $errors->first('name') }}</div>
          @endif
        </div>

        <!-- Email -->
        <div class="mb-4">
          <label for="Email" class="block text-sm font-medium text-gray-700">Email</label>
          <input
            type="email"
            id="Email"
            name="email"
            placeholder="customer@example.com"
            value="{{ old('email') }}"
            class="mt-1 w-full border px-4 py-2 border-gray-200 bg-white text-sm text-gray-700 shadow-sm
            focus:outline-slate-950
            {{ $errors->has('email') ? 'border-red-500' : '' }}"
          />
          @if ($errors->has('email'))
            <div class="mt-1 text-sm text-red-500">{{ $errors->first('email') }}</div>
          @endif
        </div>

        <!-- Password -->
        <div class="mb-4">
          <label for="Password" class="block text-sm font-medium text-gray-700">Password</label>
          <input
            type="password"
            id="Password"
            name="password"
            placeholder="min. 8 karakter"
            class="mt-1 w-full border px-4 py-2 border-gray-200 bg-white text-sm text-gray-700 shadow-sm
            focus:outline-slate-950
            {{ $errors->has('password') ? 'border-red-500' : '' }}"
          />
          @if ($errors->has('password'))
            <div class="mt-1 text-sm text-red-500">{{ $errors->first('password') }}</div>
          @endif
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-4">
          <label for="KonfirmasiPassword" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
          <input
            type="password"
            id="KonfirmasiPassword"
            name="password_confirmation"
            class="mt-1 w-full border px-4 py-2 border-gray-200 bg-white text-sm text-gray-700 shadow-sm focus:outline-slate-950
            {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}"
          />
          @if ($errors->has('password_confirmation'))
            <div class="mt-1 text-sm text-red-500">{{ $errors->first('password_confirmation') }}</div>
          @endif
        </div>

        <!-- Button Daftar -->
        <div class="mb-4">
          <button type="submit" class="w-full bg-slate-950 text-white py-2 px-4 rounded-md hover:bg-slate-950 focus:outline-none">
            Daftar
          </button>
        </div>

        <p class="text-sm text-center text-gray-600">
          Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk di sini</a>
        </p>
      </form>
    </div>
  </main>
</section>
@endsection
