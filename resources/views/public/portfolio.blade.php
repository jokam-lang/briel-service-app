@extends('layouts.public')

@section('content')
    <div class="bg-blue-800 text-white py-12 text-center">
        <h1 class="text-4xl font-extrabold">Galeri Portofolio</h1>
        <p class="mt-2 text-blue-200">Hasil karya dan perbaikan terbaik dari tim kami.</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($portfolios as $portfolio)
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                    @if($portfolio->image_path)
                        <img src="{{ Storage::url($portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="w-full h-64 object-cover hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-400">
                            Tidak ada gambar
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-900">{{ $portfolio->title }}</h3>
                        @if($portfolio->description)
                            <p class="text-gray-600 text-sm mt-1">{{ Str::limit($portfolio->description, 100) }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 text-gray-500">
                    <p>Belum ada portofolio yang diunggah.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
