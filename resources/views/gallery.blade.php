@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-utama mb-4 text-center">Perjalanan & Kegiatan</h1>
    <p class="text-center text-gray-600 mb-10 max-w-xl mx-auto">
        Potret perjalanan Darren & Adit dalam berbagai kegiatan, lomba, dan momen kebersamaan yang membentuk semangat kolaborasi dan kepemimpinan mereka.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-4 md:px-0">
        @php
            $gallery = [
                ['src' => 'images/adit-1.jpg', 'alt' => 'Adit, Karya Mahasiswa UMDP Fest 2025'],
                ['src' => 'images/adit-2.jpg', 'alt' => 'Adit, Band Marching Band Mendapatkan Juara 2 Musi Soundsport Competition'],
                ['src' => 'images/adit-3.jpg', 'alt' => 'Adit, The Great MB UMDP'],
                ['src' => 'images/darren-1.jpg', 'alt' => 'Darren, Juara Taekwondo'],
                ['src' => 'images/darren-2.png', 'alt' => 'Darren, Scrabble Competition']
            ];
        @endphp

        @foreach ($gallery as $image)
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <img src="{{ asset($image['src']) }}" alt="{{ $image['alt'] }}"
                    class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                    <p class="text-white text-sm font-semibold">{{ $image['alt'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
