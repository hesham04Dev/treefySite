<div>
@if ($translation)
    <div>
        {{ $translation->value }}
        <div class="flex flex-col gap-4">
            @forelse ($verifications as $verification)
                <div class="flex flex-col gap-2">
                    <div wire:key="verification-{{$verification->id}}" class="flex items-center gap-2">
                        <div class="text-sm font-semibold text-gray-700">
                            {{ optional($verification->translator?->user)->name ?? 'Unknown Translator' }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $verification->is_correct ? __("correct") : __("incorrect") }}
                        </div>

                        @if (!$verification->is_correct)
                            <div class="text-sm text-red-500">
                                {{ optional($verification->updatedTranslation)->value ?? '' }}
                            </div>
                            <div class="text-sm text-red-500">
                                {!! optional($verification->updatedTranslation)->translateToUserLang() ?? '' !!}
                            </div>
                        @endif

                        <button wire:click="selectVerification({{ $verification->id }})" class="text-sm text-gray-500">
                            select
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-sm text-gray-400">
                    {{__("no_verification")}}
                    
                </div>
            @endforelse
        </div>
    </div>
@else
    <div class="text-sm text-gray-400">
        {{__(key: "no_verification")}}
    </div>
@endif
</div>