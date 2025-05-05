<div class="max-w-md mx-auto p-4 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">User Profile</h2>

    @if (session()->has('message'))
        <div class="p-2 mb-4 bg-green-100 text-green-800 rounded">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="updateProfile">
        <div class="mb-4">
            <label class="block text-gray-700">Name</label>
            <input wire:model="name" type="text" class="w-full p-2 border rounded">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>

    <form wire:submit.prevent="updatePassword">
        <div class="mb-4">
            <label class="block text-gray-700">Old password</label>
            <input wire:model="oldPassword" type="password" class="w-full p-2 border rounded">
            @error('oldPassword') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    
            <label class="block text-gray-700 mt-4">New password</label>
            <input wire:model="newPassword" type="password" class="w-full p-2 border rounded">
            @error('newPassword') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
    
</div>
