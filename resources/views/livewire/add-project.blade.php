
{{-- <form wire:submit.prevent="{{ $isEdit ? 'update' : 'import' }}" class="max-w-xl mx-auto p-6 bg-white shadow-lg rounded-xl space-y-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">
        {{ $isEdit ? 'Edit Project' : 'Import New Project' }}
    </h2> --}}

    <!-- Project name -->
    {{-- <div>
        <label class="block text-sm font-medium text-gray-700">Project Name</label>
        <input type="text" wire:model="project_name"
               class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
               placeholder="Project Name">
        @error('project_name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div> --}}

    <!-- Description -->
    {{-- <div>
        <label class="block text-sm font-medium text-gray-700">Description</label>
        <textarea wire:model="project_description"
                  class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                  rows="3" placeholder="Project Description"></textarea>
        @error('project_description')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div> --}}

    <!-- Points -->
    {{-- <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Points per Word</label>
            <input type="number" wire:model="points_per_word"
                   class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                   placeholder="e.g. 1">
            @error('points_per_word')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div> --}}
{{-- 
        <div>
            <label class="block text-sm font-medium text-gray-700">Verifications per Word</label>
            <input type="number" wire:model="verifications_per_word"
                   class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                   placeholder="e.g. 2">
            @error('verifications_per_word')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div> --}}

    <!-- File Upload -->
    {{-- @unless($isEdit) --}}
        {{-- <div>
            <label class="block text-sm font-medium text-gray-700">ZIP File</label>
            <input type="file" wire:model="zip_file"
                   class="mt-1 w-full border border-dashed border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('zip_file')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div> --}}
    {{-- @endunless --}}

    <!-- Export & Options for Edit -->
    {{-- @if ($isEdit)
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <input type="checkbox" wire:model="is_disabled" id="is_disabled" class="h-4 w-4 text-indigo-600">
                <label for="is_disabled" class="text-sm text-gray-700">Disable project</label>
            </div>

            <button type="button" wire:click="export"
                    class="text-sm bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                Export
            </button>
        </div>
    @endif --}}

    <!-- Submit -->
    {{-- <div class="pt-4">
        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-lg shadow">
            {{ $isEdit ? 'Update Project' : 'Import Project' }}
        </button>
    </div>
</form> --}}


<div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow-md mt-2">
    <form wire:submit.prevent="{{$isEdit ?"update" :"import"  }}" class="space-y-6">
        {{-- Flash Messages --}}
        @if (session()->has('success'))
            <div class="alert alert-success text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-error text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- Project Name --}}
        <div class="form-control">
            <label for="project_name" class="label">
                <span class="label-text">{{ __('Project Name') }}</span>
            </label>
            <input type="text" wire:model="project_name" id="project_name"
                   class="input input-bordered w-full" />
            @error('project_name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- Project Description --}}
        <div class="form-control">
            <label for="project_description" class="label">
                <span class="label-text">{{ __('Project Description') }}</span>
            </label>
            <textarea wire:model="project_description" id="project_description"
                      class="textarea textarea-bordered w-full h-24 resize-none"></textarea>
            @error('project_description') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- Points per Word --}}
        <div class="form-control">
            <label for="points_per_word" class="label">
                <span class="label-text">{{ __('Points per Word') }}</span>
            </label>
            <input type="number" wire:model="points_per_word" id="points_per_word"
                   class="input input-bordered w-full" />
            @error('points_per_word') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- Verifications per Word --}}
        <div class="form-control">
            <label for="verifications_per_word" class="label">
                <span class="label-text">{{ __('Verifications per Word') }}</span>
            </label>
            <input type="number" wire:model="verifications_per_word" id="verifications_per_word"
                   class="input input-bordered w-full" />
            @error('verifications_per_word') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- Upload ZIP --}}
        <div class="form-control">
            <label for="zip_file" class="label">
                <span class="label-text">{{ __('Upload ZIP File') }}</span>
            </label>
            <input type="file" wire:model="zip_file" id="zip_file" accept=".zip"
                   class="file-input file-input-bordered w-full" />
            @error('zip_file') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- Submit Button --}}
        <div class="pt-4 ">
            @if ($isEdit)
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-center space-2">
                    <input type="checkbox" wire:model="is_disabled" id="is_disabled" class=" h-4 w-4 text-indigo-600">
                    <label for="is_disabled" class="text-sm text-gray-700 px-1">{{__("disable_project")}}</label>
                </div>
    
                <button type="button" wire:click="export"
                        class="btn btn-sm btn-warning w-md-1/5">
                        {{__("export")}}
                </button>
            </div>
        @endif
            <button type="submit" class="btn btn-primary w-full mt-2">
                {{ __('save') }}
            </button>

            {{-- <button type="button" class="btn btn-secondary w-2/4">{{__("export")}}</button> --}}
        </div>
    </form>
</div>
