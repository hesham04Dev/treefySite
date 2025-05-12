<!-- Alpine.js from CDN -->
{{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

<!-- Header -->
<header class="bg-white shadow px-6 py-4" x-data="{ open: false }">
  <div class="flex items-center justify-between">
    <!-- Logo -->
    
    <div class="text-xl font-bold text-gray-800"><a href="{{ route('home') }}" class="flex items-center">
      Treefy 🌳 <span class="bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent font-bold">Treefy</span>
    </a></div>
  <x-parts.menu/>
</header>



