@extends('layouts.main')

@section('content')
<main class="bg-gradient-to-t from-[#062146] to-[#0141D9] flex flex-col items-center justify-center min-h-screen">

    <!-- Logo centralizada -->
    <div class="mt-5 flex justify-center mb-2">
        <a href="#" class="flex items-center">
            <img src="{{ asset('img/logo-vitrine.svg') }}" alt="logo vitrine" class="pb-8">
        </a>
    </div>
    <div
        class="bg-white px-6 pt-6 pb-8 shadow-xl ring-1 ring-gray-900/5 rounded-xl sm:px-10 mx-8 max-w-[860px]">
        <div class="w-full">
            <div class="mt-5">
                @livewire('onboard-form')
            </div>
        </div>
    </div>
</main>
@endsection