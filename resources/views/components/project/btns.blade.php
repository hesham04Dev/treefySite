{{-- resources/views/components/project/btns.blade.php
@props(['user' => auth()->user(), 'projectId' => null])

<div class="flex items-center space-x-2">
    @if($user->ownProject($projectId))
        <a href="{{ route('edit_project', $projectId) }}"
            class="px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600 transition">
            Edit
        </a>
        <a href="{{ route('projectVerifications', $projectId) }}">
            View Verifications
        </a>
    @elseif($user->isTranslator())
        @if($user->translator->isEnrolled($projectId))
            <button wire:click="unEnroll({{ $projectId }})"
                class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600 transition">
                Unenroll
            </button>
            <button wire:click="startVerification({{ $projectId }})"
                class="px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600 transition">
                Verify
            </button>
        @else

            <button wire:click="enroll({{ $projectId }})"
                class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                Enroll
            </button>
        @endif
    @endif
</div> --}}


{{-- resources/views/components/project/btns.blade.php --}}
@props(['user' => auth()->user(), 'project' => null])
{{-- {{ dd($project) }} --}}
<div class="flex items-center gap-2">
    @if($user->ownProject($project->id))
        <a href="{{ route('edit_project', $project->id) }}"
           class="btn btn-sm btn-warning">
            {{ __('Edit') }}
        </a>
        @if($project->verification_no >1)
        <a href="{{ route('projectVerifications', $project->id) }}"
           class="btn btn-sm btn-outline">
            {{ __('View Verifications') }}
        </a>
        @endif
    @elseif($user->isTranslator())
        @if($user->translator->isEnrolled($project->id))
            <button wire:click="unEnroll({{ $project->id }})"
                    class="btn btn-sm btn-error text-white">
                {{ __('Unenroll') }}
            </button>
            <button wire:click="startVerification({{ $project->id }})"
                    class="btn btn-sm btn-success text-white">
                {{ __('Verify') }}
            </button>
        @else
            <button wire:click="enroll({{ $project->id }})"
                    class="btn btn-sm btn-info text-white">
                {{ __('Enroll') }}
            </button>
        @endif
    @endif
</div>
