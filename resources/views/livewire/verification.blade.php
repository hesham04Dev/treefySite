{{-- <div class="flex justify-center items-center min-h-screen  p-4"> --}}
    <div class="bg-base-100 rounded-xl shadow p-6 w-full max-w-md flex-center m-auto mt-2">
        @if ($translation && $translation != null)
            <div wire:key="translation-{{ $translation->id }}">
                <h3 class="text-sm text-base-content mb-1">
                    Project: <span class="font-semibold">{{ $project->name }}</span>
                </h3>

                <h2 class="text-xl font-bold text-base-content mb-4">
                    {{ $translation->key }}
                </h2>

                <div class="mb-4">
                    <label class="label p-0 mb-1">
                        <span class="label-text text-sm">{{__('Language')}}</span>
                    </label>
                    <p class="text-sm text-neutral">{{ $translation->language }}</p>
                </div>

                <div class="mb-4">
                    <label class="label p-0 mb-1">
                        <span class="label-text text-sm">{{ __('translation') }}</span>
                    </label>
                    <input type="text"
                        wire:model.defer="editableTranslation"
                        class="input input-bordered w-full text-sm"
                        placeholder="Edit translation" />
                </div>

                <div class="flex justify-between gap-3 mt-6">
                    <button wire:click="markAsCorrect({{ $translation->id }})"
                        class="btn btn-sm btn-success w-1/2">
                        {{ __("Done") }}
                    </button>
                    <button wire:click="skip({{ $translation->id }})"
                        class="btn btn-sm btn-neutral w-1/2">
                        {{ __("Skip") }}
                    </button>
                </div>
            </div>
        @else
            <div wire:key="no-translation" class="flex items-center justify-center min-h-[50vh]">
                <p class="">
                   {{ __('no_translations') }} 
                </p>
            </div>
        @endif
    </div>
{{-- </div> --}}
