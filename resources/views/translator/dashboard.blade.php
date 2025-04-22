<x-layouts.base>
    {{-- NAME / LEVEL - points SECTION --}}
    <section>
        <div class="w-2/5">
            <x-common.level :level="$user->level" :percentage="$level_percentage" />
            <h2>df_welcome {{$user->name}}</h2>
           
            
        </div>
        <x-common.points :points="$points"/>
            
        
    </section>
    {{-- FILAMENT Dashboard include --}}
    {{-- Card view _with search (enrolled project) import projects page here --}}
    <livewire:projects-list :userId="$user->id" />

</x-layouts.base>