<x-layouts.app>
    <div class="flex flex-col min-h-screen">
        {{-- {{ __("home") }} --}}
       

        <x-parts.header />

        {{-- Flash message banner --}}
        @if (session()->has('message'))
            <div class="bg-[#eee] text-black px-4 py-3 text-center">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="bg-red-100 text-red-800 px-4 py-3 text-center">
                {{ session('error') }}
            </div>
        @endif
        @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex-grow">
            {{ $slot }}
        </div>

        <x-parts.footer />
    </div>
</x-layouts.app>
