<x-layouts.base>
    <div class="max-w-md mx-auto mt-10 p-6 bg-gradient-to-b from-white to-gray-50 shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">{{ __("buy_points") }}</h2>

        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="mb-4 text-red-600">{{ session('error') }}</div>
        @endif

        <form action="{{ route('paypal.create') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="points" class="block mb-2 font-medium text-lg">{{ __("enter_points") }}</label>
                <input type="number" id="points" name="points" value="100" min="1" required
                       class="w-full p-3 border-2 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transform hover:scale-105 transition duration-200">
                {{ __("purchase_now") }}
            </button>
        </form>
    </div>
</x-layouts.base>
