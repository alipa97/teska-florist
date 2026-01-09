@extends('layouts.dashboard')

@section('title', 'Dashboard | Produk | Teska')

@section('content')
{{-- Header --}}
<header class="bg-white border-b">
  <div class="max-w-screen-xl px-4 py-6 mx-auto sm:px-6 lg:px-8">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold sm:text-3xl">Produk</h1>
      <p class="text-sm text-gray-500">Kelola semua produk di sini.</p>
    </div>
  </div>
</header>

{{-- List Produk --}}
<section class="max-w-screen-xl px-4 sm:px-6 sm:py-4 lg:px-8">
  <div class="py-4">
    <a href="{{ route('dashboard.products.create') }}"
      class="inline-block px-5 py-3 text-sm font-medium text-white transition bg-gray-600 rounded hover:bg-gray-700 focus:outline-none focus:ring"
      type="button">
      Tambah Produk
    </a>
  </div>
  <div class="border border-gray-200 rounded-lg">
    <div class="overflow-x-auto rounded-t-lg">
      <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
        <thead class="ltr:text-left rtl:text-right">
          <tr class="bg-slate-950">
            <th class="px-4 py-2 font-medium text-center text-white whitespace-nowrap">No</th>
            <th class="px-4 py-2 font-medium text-center text-white whitespace-nowrap">Nama Produk</th>
            <th class="px-4 py-2 font-medium text-center text-white whitespace-nowrap">Harga</th>
            <th class="px-4 py-2 font-medium text-center text-white whitespace-nowrap">Kategori</th>
            <th class="px-4 py-2 font-medium text-center text-white whitespace-nowrap">Jumlah Stok</th>
            <th class="px-4 py-2 font-medium text-center text-white whitespace-nowrap">Gambar</th>
            <th class="px-4 py-2 font-medium text-center text-white whitespace-nowrap">Aksi</th> <!-- Kolom Aksi -->
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
          @foreach ($products as $product)
          <tr>
            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ $loop->iteration }}</td>
            <td class="px-4 py-2 font-medium text-center text-gray-900 whitespace-nowrap">{{ $product->name }}</td>
            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ $product->category->name }}</td>
            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{ $product->stock_quantity }}</td>
            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
              <img src="{{ asset('storage/products/' .$product->image) }}" alt="{{ $product->name }}" class="object-cover w-12 h-12 rounded-lg"/>
            </td>
            <td class="text-center text-gray-700 whitespace">
              <div class="space-x-0 items-center justify-center lg:flex">
                <!-- Tombol Edit dengan Ikon -->
                <a href="{{ route('dashboard.products.edit', $product->slug) }}" class="items-center inline-block p-2 bg-yellow-600 rounded-md text-blue-50 hover:bg-yellow-800">
                  <i class="text-xl bx bx-edit-alt"></i>
                </a>
              
                <!-- Tombol Hapus dengan Ikon -->
                <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST" class="inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="p-2 bg-red-600 hover:bg-red-800 rounded-md text-red-50" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                    <i class="text-xl bx bx-trash"></i>
                  </button>
                </form>
              </div>
            </td>            
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center px-4 py-2 border-t border-gray-200 rounded-b-lg">
      {{ $products->links('vendor.pagination.custom', ['item' => $products]) }}
    </div>
  </div>
</section>

@endsection
