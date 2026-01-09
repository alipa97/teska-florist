@extends('layouts.app')

@section('title', 'Produk | Teska')

@section('content')
<section class="px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8">
  <div class="flex space-x-8">
    <!-- Kategori Filter (sebelah kiri) -->
    <div class="w-1/5 px-3 mt-16">
      @include('components.customers.produk.category-filter')
    </div>
    
    <!-- Daftar Produk (di sebelah kanan) -->
    <div class="w-3/4">
      <!-- Judul Kategori -->
      <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">
        {{ $selectedCategory ? $selectedCategory->name : 'Produk Kami' }}
      </h2>

      <!-- Daftar Produk -->
      @include('components.customers.produk.collection', ['products' => $products])

      {{-- Pagination --}}
      <div class="flex justify-center px-4 py-2 border-t border-gray-200 rounded-b-lg">
        {{ $products->links() }}
      </div>
    </div>
  </div>
</section>
@endsection
