@extends('layouts.app')

@section('title', 'Pesanan | Teska')

@section('content')

<div class="bg-gray-50 min-h-screen">
  <main class="py-12 px-6 sm:px-12 lg:px-20">
    <div class="max-w-5xl mx-auto">
      <header class="mb-12">
        <h1 class="text-3xl font-bold text-gray-800">Riwayat Pesanan</h1>
      </header>

      <section class="space-y-8">
        @forelse ($orders as $order)
          <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
              <div class="flex justify-between items-center">
                <div>
                  <h3 class="text-lg font-medium text-gray-900">Pesanan {{ $order->id }}</h3>
                  <p class="text-sm text-gray-500">
                    Dibuat pada <time datetime="{{ $order->created_at->toDateString() }}">{{ $order->created_at->format('d M Y') }}</time>
                  </p>
                </div>
                <div class="text-right">
                  <p class="text-lg font-semibold text-gray-800">Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                  <p class="text-sm text-indigo-600">{{ $order->status ?? 'Status Tidak Diketahui' }}</p>
                </div>
              </div>

              @if ($order->status === 'delivered')
                <div class="mt-4">
                  <p class="text-sm text-gray-600">No Resi: {{ $order->shippings->tracking_number }}</p>
                  <form action="{{ route('orders.received', $order->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none">
                      Pesanan Diterima
                    </button>
                  </form>
                </div>
              @endif

              <div class="mt-6 divide-y divide-gray-200">
                @if ($order->shipping_address != null)
                  @foreach ($order->items as $item)
                    <div class="py-4 flex items-center">
                      <img src="{{ asset('storage/products/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-20 h-20 rounded-md object-cover">
                      <div class="ml-4">
                        <h4 class="text-gray-800 font-semibold">{{ $item->product->name }}</h4>
                        <p class="text-sm text-gray-600">{{ $item->product->description }}</p>
                        <p class="mt-2 font-medium text-gray-900">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                        <div class="mt-2 flex space-x-4">
                        <a href="{{ route('checkout.buy_now', $item->product->slug) }}" 
                          class="inline-block px-4 py-2 text-sm font-medium text-white bg-pink-600 rounded hover:bg-pink-700">
                          Beli Lagi
                        </a>
                          <form action="{{ route('cart.store', $item->product->slug) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-sm text-white bg-slate-600 rounded hover:bg-slate-700">Tambah Ke Keranjang</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @else
                  <div class="py-4">
                    <h4 class="font-medium text-gray-800">
                      @if ($order->total_price == 199000)
                        Langganan Paket Basic
                      @elseif ($order->total_price == 299000)
                        Langganan Paket Premium
                      @elseif ($order->total_price == 499000)
                        Langganan Paket Eksklusif
                      @endif
                    </h4>
                    <p class="text-sm text-gray-600">Paket Berlaku Selama Satu Bulan</p>
                  </div>
                @endif
              </div>
            </div>

            <div class="p-4 bg-gray-100 flex justify-end">
              <a href="{{ route('orders.invoice', $order->id) }}" target="_blank" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 focus:outline-none">
                Lihat Faktur
              </a>
            </div>
          </div>
        @empty
          <p class="text-center text-gray-500">Belum ada pesanan.</p>
        @endforelse
      </section>
    </div>
  </main>
</div>
@endsection
