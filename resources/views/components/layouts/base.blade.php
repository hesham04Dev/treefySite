<x-layouts.app>
    <div class="flex flex-col min-h-screen">
        <x-parts.header />
        <div class="flex-grow">
            {{ $slot }}
        </div>
        <x-parts.footer />
    </div>
</x-layouts.app>