<x-layouts.app>
    <div class="flex flex-col min-h-screen">
        <x-parts.header />

        {{-- Flash message banner --}}
        @if (session()->has('message'))
            <div class="bg-green-100 text-green-800 px-4 py-3 text-center">
                {{ session('message') }}
            </div>
        @endif

        <div class="flex-grow">
            {{ $slot }}
        </div>

        <x-parts.footer />
    </div>
</x-layouts.app>
