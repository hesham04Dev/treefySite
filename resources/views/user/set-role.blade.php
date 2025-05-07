<div class="p-6 bg-white rounded shadow-md">
    <h2 class="text-xl font-semibold mb-4">{{__("choose_your_role")}}</h2>

    <p class="mb-4 text-gray-600">{{__("are_you_translator")}}</p>

    <div class="flex space-x-4">
        <button
            wire:click="$set('is_translator', true)"
            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition"
        >
        {{__("yes")}}
        </button>

        <button
            wire:click="saveUser()"
            class="px-4 py-2 bg-black text-white rounded hover:bg-white hover:text-black transition"
        >
            {{__("no")}}
        </button>
    </div>
</div>
