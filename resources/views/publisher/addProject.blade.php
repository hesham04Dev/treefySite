
@props(['projectId' => 0])
<x-layouts.base>

    <livewire:add-project  :projectId="$projectId"/>
    
    {{-- @livewire(App\Filament\Pages\ImportTranslations::class) --}}
    
</x-layouts.base>