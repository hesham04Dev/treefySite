<div class="max-w-2xl mx-auto p-6">
    @if (!$is_translator)
        <div class="flex flex-col items-center justify-center min-h-[50vh] text-center">
            <div class="card bg-base-200 w-full max-w-md p-8 shadow-lg">
                @include('user.set-role')
            </div>
        </div>
    @else
        <div class="card bg-base-100 shadow-lg">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-6">{{ __('Translator Profile Setup') }}</h2>
                
                <form wire:submit.prevent="save" class="space-y-6">
                    {{-- CV Upload --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">{{ __('CV Upload') }} (PDF, DOCX)</span>
                        </label>
                        <input type="file" wire:model="cv" 
                               class="file-input file-input-bordered file-input-primary w-full" 
                               accept=".pdf,.doc,.docx" />
                        @error('cv') 
                            <div class="alert alert-error mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">{{ __('Professional Description') }}</span>
                        </label>
                        <textarea wire:model="desc" 
                                  class="textarea textarea-bordered h-32" 
                                  placeholder="{{ __('Tell us about your translation experience and qualifications...') }}"></textarea>
                        @error('desc') 
                            <div class="alert alert-error mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- Preferred Languages --}}
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">{{ __('Select Your Preferred Languages') }}</span>
                            <span class="label-text-alt">{{ __('Hold Ctrl/Cmd to select multiple') }}</span>
                        </label>
                        <select wire:model="selectedLanguages" 
                                class="select select-bordered w-full h-auto min-h-[3rem]" 
                                multiple size="5">
                            @foreach ($languages as $lang)
                                <option value="{{ $lang->id }}" class="p-2 hover:bg-base-200">
                                    {{ $lang->name }} ({{ $lang->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('language_id') 
                            <div class="alert alert-error mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary w-full gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            {{ __('Save Profile') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>