

<x-layouts.base>
    {{-- DASHBOARD HEADER --}}
    <section class="p-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div class="md:w-2/5">
                <h2 class="text-2xl font-semibold mt-4 text-gray-800">👋 df_welcome {{ $user->name }}</h2>
            </div>

            <div class="md:w-1/5">
                <x-common.points :points="$points"/>
            </div>
        </div>

        {{-- PROJECT LIST --}}
        <div class="bg-white shadow-md rounded-lg p-6">
            <livewire:projects-list :userId="$user->id" />
        </div>
    </section>
</x-layouts.base>