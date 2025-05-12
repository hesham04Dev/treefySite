<x-layouts.base>
    <div class="max-w-md mx-auto mt-10 p-6 bg-gradient-to-b from-white to-gray-50 shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">{{ __("send_points") }}</h2>

        <form action="{{ route('points.transfer') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-lg font-medium">{{ __("receiver_email") }}</label>
                <input type="email" name="email" id="email" required
                       class="input input-bordered w-full @error('email') input-error @enderror"
                       value="{{ old('email') }}">
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="points" class="block text-lg font-medium">{{ __("amount_of_points") }}</label>
                <input type="number" name="points" id="points" min="1" required
                       class="input input-bordered w-full @error('points') input-error @enderror"
                       value="{{ old('points') }}">
                @error('points')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-full hover:bg-blue-700">
                {{ __("send_points") }}
            </button>
        </form>
    </div>
</x-layouts.base>
