@extends('layouts.dashboard')

@section('title', 'Edit Produk | Teska')

@section('content')
<section class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
  <div class="p-6 bg-white rounded-lg shadow-lg">
    <h2 class="mb-6 text-2xl font-semibold text-gray-800">Edit Produk</h2>

    <form action="{{ route('dashboard.products.update', $product->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PUT')

      <!-- Nama Produk -->
      <div>
        <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama Produk</label>
        <input type="text" name="name" id="name" class="w-full px-4 py-2 text-sm border rounded-lg focus:ring focus:ring-pink-200 focus:outline-none" placeholder="Masukkan nama produk" value="{{ old('name', $product->name) }}" required>
        @error('name')
        <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
      </div>

      <!-- Harga -->
      <div>
        <label for="price" class="block mb-2 text-sm font-medium text-gray-700">Harga (Rp)</label>
        <input type="number" name="price" id="price" class="w-full px-4 py-2 text-sm border rounded-lg focus:ring focus:ring-pink-200 focus:outline-none" placeholder="Masukkan harga produk" value="{{ old('price', $product->price) }}" required>
        @error('price')
        <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
      </div>

      <!-- Kategori -->
      <div>
        <label for="category" class="block mb-2 text-sm font-medium text-gray-700">Kategori</label>
        <div class="flex gap-4">
          <!-- Pilihan kategori yang sudah ada -->
          <select name="category_id" id="category" class="w-full px-4 py-2 text-sm border rounded-lg focus:ring focus:ring-pink-200 focus:outline-none">
            <option value="">Pilih kategori</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
            @endforeach
          </select>
          <!-- Input untuk kategori baru -->
          <input type="text" name="new_category" id="new_category" class="flex-1 px-4 py-2 text-sm border rounded-lg focus:ring focus:ring-yellow-200 focus:outline-none" placeholder="Kategori baru (opsional)" value="{{ old('new_category') }}">
        </div>
        @error('category_id')
        <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
        @error('new_category')
        <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
      </div>

      <!-- Jumlah Stok -->
      <div>
        <label for="stock_quantity" class="block mb-2 text-sm font-medium text-gray-700">Jumlah Stok</label>
        <input type="number" name="stock_quantity" id="stock_quantity" class="w-full px-4 py-2 text-sm border rounded-lg focus:ring focus:ring-pink-200 focus:outline-none" placeholder="Masukkan jumlah stok" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
        @error('stock_quantity')
        <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
      </div>

      <!-- Gambar Produk -->
      <div>
        <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Gambar Produk</label>
        <input type="file" name="image" id="image" class="w-full px-4 py-2 text-sm border rounded-lg focus:ring focus:ring-pink-200 focus:outline-none">
        @if ($product->image)
        <p class="mt-2 text-sm text-gray-500">Gambar saat ini: 
          <a href="{{ asset('storage/products/' . $product->image) }}" class="text-blue-600 hover:underline" target="_blank">Lihat Gambar</a>
        </p>
        @endif
        @error('image')
        <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
      </div>

      <!-- Tombol -->
      <div class="flex justify-end gap-4">
        <a href="{{ route('dashboard.products.index') }}" class="px-5 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
          Batal
        </a>
        <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-pink-600 rounded-lg hover:bg-pink-700">
          Perbarui Produk
        </button>
      </div>
    </form>
  </div>
</section>
@endsection
