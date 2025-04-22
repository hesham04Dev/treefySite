<x-layouts.base>
    {{-- NAME  - points SECTION --}}
    <section>
        <div>
            <h2>df_welcome {{$user->name}}</h2>
            
        </div>
        <x-common.points :points="$points"/>
    </section>
    {{-- Card view _with search (enrolled project) import projects page here or? --}}
    <livewire:projects-list :userId="$user->id" />
</x-layouts.base>