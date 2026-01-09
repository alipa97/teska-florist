@extends('layouts.auth')

@section('title', 'Masuk | Teska')

@section('content')
<section class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/auth/background.jpg') }}');">
    <div class="bg-white p-8 shadow-lg rounded-lg max-w-sm w-full">
        <h2 class="text-2xl font-bold text-center mb-4">Masuk ke Akun Anda</h2>
        <form action="{{ route('login_post') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="customer@example.com"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-2 mt-1 border rounded-md text-gray-700 focus:ring focus:ring-slate-300 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
                />
                @if ($errors->has('email'))
                    <p class="mt-1 text-sm text-red-500">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="min. 8 karakter"
                    class="w-full px-4 py-2 mt-1 border rounded-md text-gray-700 focus:ring focus:ring-slate-300 {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }}"
                />
                @if ($errors->has('password'))
                    <p class="mt-1 text-sm text-red-500">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full bg-slate-950 text-white py-2 px-4 rounded-md hover:bg-slate-950 focus:outline-none">
                Masuk
            </button>

            <!-- Link to Register -->
            <p class="text-center text-sm text-gray-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-slate-700 underline hover:text-slate-900">Daftar</a>
            </p>
        </form>
    </div>
</section>
@endsection
