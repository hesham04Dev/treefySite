<form wire:submit.prevent="{{ $isEdit ? 'update' : 'import' }}">
    <!-- Project name -->
    <input type="text" wire:model="project_name" placeholder="Project Name">

    <!-- Description -->
    <textarea wire:model="project_description" placeholder="Description"></textarea>

    <!-- Points -->
    <input type="number" wire:model="points_per_word" placeholder="Points per word">
    <input type="number" wire:model="verifications_per_word" placeholder="Verifications per word">
    <input type="file" wire:model="zip_file">
    <!-- File upload only if not editing -->
    @if ($isEdit)
        <button wire:click="export()" >export</button>
    @endif

    <button type="submit">
        {{ $isEdit ? 'Update Project' : 'Import Project' }}
    </button>
</form>
