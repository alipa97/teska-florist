@extends('layouts.app')

@section('title', 'Keranjang | Teska')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-3xl px-4 py-16 mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center text-gray-900 sm:text-4xl border-b pb-4">Keranjang Belanja</h1>

        <section aria-labelledby="cart-heading" class="mt-12">
            <ul role="list" class="divide-y divide-gray-200 space-y-6">
                @forelse ($carts as $cart)
                <li class="flex items-center space-x-6 bg-white shadow rounded-lg p-4">
                    <!-- Gambar Produk -->
                    <img src="{{ asset('storage/products/' . $cart->product->image) }}" 
                         alt="Gambar Produk" 
                         class="w-24 h-24 sm:w-32 sm:h-32 rounded object-cover object-center">

                    <!-- Detail Produk -->
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-medium text-gray-700">
                                {{ $cart->product->name }}
                            </h4>
                            <p class="text-sm font-medium text-gray-900">
                                @if ($cart->product->discount > 0)
                                    Rp{{ number_format($cart->product->price - ($cart->product->price * $cart->product->discount / 100), 0, ',', '.') }}
                                    <span class="text-gray-400 line-through text-sm">
                                        Rp{{ number_format($cart->product->price, 0, ',', '.') }}
                                    </span>
                                @else
                                    Rp{{ number_format($cart->product->price, 0, ',', '.') }}
                                @endif
                            </p>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <!-- Tombol Tambah/Kurang -->
                            <div class="flex items-center gap-3">
                                <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="w-8 h-8 bg-gray-100 font-bold text-red-600 rounded hover:bg-gray-200">
                                        -
                                    </button>
                                </form>
                                <p class="text-gray-700">{{ $cart->quantity }}</p>
                                <form action="{{ route('cart.add', $cart->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="w-8 h-8 bg-gray-100 font-bold text-blue-600 rounded hover:bg-gray-200">
                                        +
                                    </button>
                                </form>
                            </div>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-sm font-medium text-red-600 hover:text-red-500"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
                @empty
                <p class="py-6 text-center text-gray-700">Keranjang Kosong</p>
                @endforelse
            </ul>
        </section>

        <!-- Ringkasan Pesanan -->
        @if($carts->isNotEmpty())
        <section aria-labelledby="summary-heading" class="mt-10 bg-white shadow-lg p-6 rounded-lg">
            <h2 id="summary-heading" class="text-lg font-bold text-gray-900 border-b pb-3">Ringkasan Pesanan</h2>
            <div class="mt-4">
                <div class="flex justify-between items-center">
                    <dt class="text-base font-medium text-gray-900">Subtotal</dt>
                    <dd class="text-base font-medium text-gray-900">
                        Rp{{ number_format($carts->sum(function($cart) { 
                            return ($cart->product->price - ($cart->product->price * $cart->product->discount / 100)) * $cart->quantity; 
                        }), 0, ',', '.') }}
                    </dd>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('checkout.index') }}"
                   class="block w-full px-4 py-3 text-center text-base font-medium text-white bg-pink-600 rounded-lg hover:bg-pink-500 shadow">
                    Checkout
                </a>
            </div>

            <div class="mt-4 text-sm text-center">
                <p>
                    atau
                    <a href="{{ route('products.index') }}" class="font-medium text-pink-600 hover:text-pink-500">
                        Lanjutkan Belanja<span aria-hidden="true"> &rarr;</span>
                    </a>
                </p>
            </div>
        </section>
        @endif
    </div>
</div>
@endsection
