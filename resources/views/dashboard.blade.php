@extends('layouts.app')

@section('content')
    <div class="w-full px-4 sm:px-8 md:px-12 lg:px-20 py-6">
        <div class="bg-blue-400 p-10 rounded-lg text-white flex flex-col md:flex-row justify-between items-center md:items-start gap-4 mb-6">
            <!-- Section Teks -->
            <div class="md:w-1/2">
                <h2 class="text-8xl font-semibold">Easy way to reserve a service</h2>
                <p class="text-2xl mt-6">Ease of doing a car/bike maintenance in the comfort of your home</p>
            </div>
            
            <!-- Section Gambar -->
            <div class="md:w-1/2 flex justify-center relative">
                <img src="{{ asset('img/car.png') }}" alt="Car" class="w-60 md:w-[350px] absolute bottom-0 right-[-30px] z-10">
                <img src="{{ asset('img/bike.png') }}" alt="Motor" class="w-60 md:w-[450px] z-0 right-[-55px] relative">
            </div>
        </div>


        <h2 class="text-lg font-bold mb-2">ADMIN</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @for ($i = 0; $i < 8; $i++)
                <div class="bg-white p-3 rounded-lg shadow">
                    <img src="{{ asset('img/item.jpg') }}" alt="Besi" class="w-full h-24 object-contain">
                    <h3 class="font-semibold text-gray-800 mt-2">Besi</h3>
                    <p class="text-sm text-gray-600">80L • Manual • 2 People</p>
                    <p class="text-sm text-gray-500">8 / 20</p>
                    <div class="flex justify-center mt-6">
                        <a href="https://shopee.co.id/ISKU-Linesman-Pliers-Tang-Kombinasi-Tang-Lancip-6-8-inch-Long-Nose-Plier-6-inci-kunci-set-i.1220743592.25121710755?sp_atk=5816fb0e-fb0d-43ac-b0b2-3b4257f76384&xptdk=5816fb0e-fb0d-43ac-b0b2-3b4257f76384">
                            <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-blue-700">Not Available</button>
                        </a>
                    </div>
                </div>
            @endfor
        </div>

        <div class="flex justify-center mt-6">
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Show more item
            </button>
        </div>
    </div>
@endsection
