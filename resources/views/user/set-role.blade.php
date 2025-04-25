<div class="p-6 bg-white rounded shadow-md">
    <h2 class="text-xl font-semibold mb-4">Choose Your Role</h2>

    <p class="mb-4 text-gray-600">Are you registering as a translator?</p>

    <div class="flex space-x-4">
        <button
            wire:click="$set('is_translator', true)"
            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition"
        >
            Yes, I'm a Translator
        </button>

        <button
            wire:click="saveUser()"
            class="px-4 py-2 bg-black text-white rounded hover:bg-white hover:text-black transition"
        >
            No, Continue as User
        </button>
    </div>
</div>
