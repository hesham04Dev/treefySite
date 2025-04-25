<div>
    @if (!$is_translator)
        @include('user.set-role')
    @else
        <form wire:submit.prevent="save" class="space-y-4">
            <div>
                <label class="block">CV Upload</label>
                <input type="file" wire:model="cv" class="border p-2 rounded w-full">
                @error('cv') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Description</label>
                <textarea wire:model="desc" class="border p-2 rounded w-full"></textarea>
                @error('desc') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Preferred Language</label>
                <select wire:model="selectedLanguages" class="border p-2 rounded w-full" multiple>
                    @foreach ($languages as $lang)
                        <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                    @endforeach
                </select>
                @error('language_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Submit
            </button>
        </form>
    @endif
</div>
