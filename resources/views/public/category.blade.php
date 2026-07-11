@extends('layouts.public')

@section('content')
    <div class="bg-blue-800 text-white py-12 text-center">
        <h1 class="text-4xl font-extrabold">Layanan {{ $category->name }}</h1>
        <p class="mt-2 text-blue-200">Pilih layanan yang Anda butuhkan di bawah ini.</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 font-semibold">&larr; Kembali ke Beranda</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services as $service)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col border border-gray-100">
                    @if($service->image_path)
                        <img src="{{ Storage::url($service->image_path) }}" alt="{{ $service->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                            Tidak ada gambar
                        </div>
                    @endif
                    
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $service->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4 flex-1">{{ $service->description }}</p>
                        
                        @if($service->price_estimation)
                            <div class="bg-blue-50 text-blue-800 px-3 py-2 rounded-md font-semibold text-sm mb-4">
                                Estimasi: {{ $service->price_estimation }}
                            </div>
                        @endif

                        @php
                            $waNumber = "6281234567890";
                            $message = "Halo CS Briel Service, saya tertarik dengan jasa " . $service->name . ". Mohon info lebih lanjut.";
                            $waUrl = "https://wa.me/" . $waNumber . "?text=" . urlencode($message);
                        @endphp
                        
                        <a href="{{ $waUrl }}" target="_blank" class="block w-full text-center bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.347-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.876 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            Hubungi CS (WhatsApp)
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 text-gray-500">
                    <p>Belum ada layanan untuk kategori ini.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
