<div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow-md">
    <form wire:submit.prevent="import" class="space-y-6">
        {{-- Flash Messages --}}
        @if (session()->has('success'))
            <div class="text-sm text-green-700 bg-green-100 border border-green-300 rounded p-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="text-sm text-red-700 bg-red-100 border border-red-300 rounded p-3">
                {{ session('error') }}
            </div>
        @endif

        {{-- Project Name --}}
        <div>
            <label for="project_name" class="block text-sm font-semibold mb-1">Project Name</label>
            <input type="text" wire:model="project_name" id="project_name" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('project_name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- Project Description --}}
        <div>
            <label for="project_description" class="block text-sm font-semibold mb-1">Project Description</label>
            <textarea wire:model="project_description" id="project_description" class="w-full p-2 border rounded-md resize-none h-24 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            @error('project_description') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- Points per Word --}}
        <div>
            <label for="points_per_word" class="block text-sm font-semibold mb-1">Points per Word</label>
            <input type="number" wire:model="points_per_word" id="points_per_word" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('points_per_word') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- Verifications per Word --}}
        <div>
            <label for="verifications_per_word" class="block text-sm font-semibold mb-1">Verifications per Word</label>
            <input type="number" wire:model="verifications_per_word" id="verifications_per_word" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('verifications_per_word') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- Upload ZIP --}}
        <div>
            <label for="zip_file" class="block text-sm font-semibold mb-1">Upload ZIP File</label>
            <input type="file" wire:model="zip_file" id="zip_file" accept=".zip" class="w-full text-sm">
            @error('zip_file') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- Submit Button --}}
        <div class="pt-4">
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-150 ease-in-out">
                Import Translations
            </button>
        </div>
    </form>
</div>
