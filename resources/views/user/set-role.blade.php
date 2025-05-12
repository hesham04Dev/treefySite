<div class="p-6 bg-gradient-to-b from-white to-gray-50 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">{{ __("choose_your_role") }}</h2>

    <p class="mb-4 text-gray-600">{{ __("are_you_translator") }}</p>

    <div class="flex space-x-4">
        <button
            wire:click="$set('is_translator', true)"
            class="btn btn-success hover:bg-green-700 transition"
        >
            {{ __("yes") }}
        </button>

        <button
            wire:click="saveUser()"
            class="btn btn-outline hover:bg-gray-100 hover:text-black transition"
        >
            {{ __("no") }}
        </button>
    </div>
</div>
