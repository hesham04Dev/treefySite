<div class="flex justify-center items-center min-h-screen bg-gray-100 p-4">
    <div class="bg-white shadow-lg rounded-xl p-6 w-full max-w-md text-center">
        @if ($translation)
        <div wire:key="translation-{{ $translation->id }}">
            <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $translation->key }}</h2>

            <div class="mb-4">
                <label class="block text-gray-600 text-sm mb-1">Language:</label>
                <p class="text-blue-600 font-medium">{{ $translation->language }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-600 text-sm mb-1">Translation:</label>
                <input type="text"
                    wire:model.defer="editableTranslation"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Edit the translation here" />
            </div>

            <div class="flex justify-between mt-6">
                <button wire:click="markAsCorrect({{ $translation->id }})"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow">
                    Done
                </button>
                <button wire:click="skip({{ $translation->id }})"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow">
                    Skip
                </button>
            </div>
        </div>
        @else
        <div wire:key="no-translation">
            <p class="text-gray-600">No translations available for verification.</p>
        </div>
        @endif
    </div>
</div>

