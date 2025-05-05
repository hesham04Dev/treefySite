<div class="p-4 max-w-2xl mx-auto">
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="text-xl font-bold mb-4">My Languages</h2>

    @if ($languages->isEmpty())
        <p class="text-gray-600">You have no languages assigned.</p>
    @else
        <ul class="space-y-2">
            @foreach ($languages as $lang)
                <li class="flex items-center justify-between bg-gray-100 p-2 rounded">
                    <span>{{ $lang->name }}</span>

                    @if ($confirmingLanguageId === $lang->id)
                        <div class="flex items-center gap-2">
                            <button wire:click="removeLanguage"
                                    class="text-white bg-red-500 px-2 py-1 rounded text-sm hover:bg-red-600">
                                Confirm
                            </button>
                            <button wire:click="cancelRemove"
                                    class="text-sm text-gray-600 hover:underline">Cancel</button>
                        </div>
                    @else
                        <button wire:click="confirmRemove({{ $lang->id }})"
                                class="text-red-500 hover:underline text-sm">
                            Remove
                        </button>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif

    <button wire:click="requestAddLanguage"
            class="mt-6 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
        Request to Add a Language
    </button>
    @if ($showRequestForm)
    <div class="mt-6 border-t pt-4">
        <h3 class="text-lg font-semibold mb-2">Request to Add a Language</h3>
        <form wire:submit.prevent="submitLanguageRequest" class="space-y-4">
            <div>
                <label class="block text-gray-700">Select Language</label>
                <select wire:model="requestLanguageId" class="w-full p-2 border rounded">
                    <option value="">-- Select --</option>
                    @foreach ($allLanguages as $lang)
                        <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                    @endforeach
                </select>
                @error('requestLanguageId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700">Reason</label>
                <textarea wire:model="requestReason" class="w-full p-2 border rounded" rows="3"></textarea>
                @error('requestReason') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700">Proof File (PDF, image, etc)</label>
                <input type="file" wire:model="requestFile" class="w-full p-2 border rounded">
                @error('requestFile') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Submit</button>
        </form>
    </div>
@endif


</div>
