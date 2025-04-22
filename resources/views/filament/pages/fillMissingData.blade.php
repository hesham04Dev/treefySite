<x-filament-panels::page>
  



    <form wire:submit.prevent="submit">
        {{ $this->form }}
    
        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">
            df_send
        </button>
    </form>
    
    @if (session()->has('success'))
        <div class="mt-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif
    
    
</x-filament-panels::page>
