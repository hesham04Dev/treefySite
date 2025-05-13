<div class="p-6 max-w-2xl mx-auto card bg-base-100 ">
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <h2 class="text-2xl font-bold mb-6">My Languages</h2>

    @if ($languages->isEmpty())
        <div class="alert alert-info">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>You have no languages assigned.</span>
        </div>
    @else
        <ul class="space-y-3">
            @foreach ($languages as $lang)
                <li class="flex items-center justify-between p-4 bg-base-200 rounded-box">
                    <span class="font-medium">{{ $lang->name }}</span>

                    @if ($confirmingLanguageId === $lang->id)
                        <div class="flex items-center gap-2">
                            <button wire:click="removeLanguage" class="btn btn-error btn-sm">
                                Confirm Remove
                            </button>
                            <button wire:click="cancelRemove" class="btn btn-ghost btn-sm">
                                Cancel
                            </button>
                        </div>
                    @else
                        <button wire:click="confirmRemove({{ $lang->id }})" class="btn btn-outline btn-error btn-sm">
                            Remove
                        </button>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif

    <button wire:click="requestAddLanguage" class="btn btn-primary mt-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Request to Add a Language
    </button>

    @if ($showRequestForm)
        <div class="mt-6 card bg-base-200">
            <div class="card-body">
                <h3 class="card-title">Request to Add a Language</h3>
                <form wire:submit.prevent="submitLanguageRequest" class="space-y-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Select Language</span>
                        </label>
                        <select wire:model="requestLanguageId" class="select select-bordered">
                            <option disabled selected value="">Choose a language</option>
                            @foreach ($allLanguages as $lang)
                                <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                            @endforeach
                        </select>
                        @error('requestLanguageId') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Reason</span>
                        </label>
                        <textarea wire:model="requestReason" class="textarea textarea-bordered h-24" placeholder="Explain why you need this language"></textarea>
                        @error('requestReason') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Proof File (PDF, image, etc)</span>
                        </label>
                        <input type="file" wire:model="requestFile" class="file-input file-input-bordered w-full">
                        @error('requestFile') <span class="text-error text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="card-actions justify-end">
                        <button type="submit" class="btn btn-success">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>