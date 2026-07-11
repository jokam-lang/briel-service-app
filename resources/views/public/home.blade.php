@extends('layouts.public')

@section('content')
    <!-- Hero Section -->
    <div class="bg-blue-700 text-white py-20 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-4">Solusi Terbaik Untuk Segala Kebutuhan Service Anda</h1>
            <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto mb-8">PT Briel Service melayani perawatan dan perbaikan Kendaraan, Alat Berat, Elektronik, hingga Kapal Laut dengan teknisi profesional.</p>
            <a href="#kategori" class="bg-white text-blue-800 font-bold px-8 py-3 rounded-full hover:bg-gray-100 shadow-lg transition">Lihat Layanan Kami</a>
        </div>
    </div>

    <!-- Kategori Section -->
    <div id="kategori" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-10">Kategori Jasa</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}" class="block group">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 group-hover:-translate-y-2 group-hover:shadow-xl border-t-4 border-blue-600 h-full flex flex-col justify-center">
                            <div class="p-6 text-center">
                                <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600">{{ $category->name }}</h3>
                                <p class="text-gray-500 mt-2 text-sm">Lihat semua jasa {{ strtolower($category->name) }} &rarr;</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @if($categories->isEmpty())
                <p class="text-center text-gray-500">Kategori belum tersedia. Tambahkan melalui panel Admin.</p>
            @endif
        </div>
    </div>
@endsection
