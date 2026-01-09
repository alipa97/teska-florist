@extends('layouts.dashboard')

@section('title', 'Dashboard | Pengguna | Teska')

@section('content')
{{-- Header --}}
<header class="bg-white border-b">
  <div class="max-w-screen-xl px-4 py-6 mx-auto sm:px-6 lg:px-8">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold sm:text-3xl">Pengguna</h1>
    </div>
  </div>
</header>

<section class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8">
  <div class="border border-gray-200 rounded-lg">
    <div class="overflow-x-auto rounded-t-lg">
      <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
        <thead class="ltr:text-left rtl:text-right">
          <tr class="bg-black">
            <th class="px-6 py-4 font-medium text-center text-white whitespace-nowrap">No</th>
            <th class="px-6 py-4 font-medium text-center text-white whitespace-nowrap">Nama Pengguna</th>
            <th class="px-6 py-4 font-medium text-center text-white whitespace-nowrap">Email</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
          @forelse ($users as $user)
            <tr>
              <td class="px-6 py-4 text-center text-gray-700 whitespace-nowrap">{{ $loop->iteration }}</td>
              <td class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap">{{ $user->name }}</td>
              <td class="px-6 py-4 text-center text-gray-700 whitespace-nowrap">{{ $user->email }}</td>
            </tr>    
          @empty
            <tr>
              <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                Belum ada data customer saat ini. 
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center px-4 py-2 border-t border-gray-200 rounded-b-lg">
      {{ $users->links('vendor.pagination.custom', ['item' => $users]) }}
    </div>
  </div>
</section>

@endsection
