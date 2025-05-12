<x-layouts.base>
    <section id="points" class="container mx-auto px-4 py-20 bg-gradient-to-b from-white to-gray-50">
        <h2 class="text-3xl font-bold text-center mb-12">
            {{ __("user_points") }}: {{ $user->points }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
            <!-- Buy Points Section -->
            <div class="p-8 rounded-xl bg-gradient-to-r from-blue-500 to-blue-700 text-white shadow-lg hover:shadow-2xl transition-all transform hover:scale-105 text-center">
                <h3 class="font-semibold text-xl mb-4">{{ __("buy_points") }}</h3>
                <a href="{{ route('points.purchase.form') }}" class="text-white font-medium hover:text-yellow-300">{{ __("buy_now") }}</a>
            </div>

            <!-- Sell Points Section -->
            <div class="p-8 rounded-xl bg-gradient-to-r from-green-500 to-green-700 text-white shadow-lg hover:shadow-2xl transition-all transform hover:scale-105 text-center">
                <h3 class="font-semibold text-xl mb-4">{{ __("sell_points") }}</h3>
                <a href="{{ route('points.sell.form') }}" class="text-white font-medium hover:text-yellow-300">{{ __("sell_now") }}</a>
            </div>

            <!-- Transfer Points Section -->
            <div class="p-8 rounded-xl bg-gradient-to-r from-purple-500 to-purple-700 text-white shadow-lg hover:shadow-2xl transition-all transform hover:scale-105 text-center">
                <h3 class="font-semibold text-xl mb-4">{{ __("transfer_points") }}</h3>
                <a href="{{ route('points.transfer.form') }}" class="text-white font-medium hover:text-yellow-300">{{ __("transfer_now") }}</a>
            </div>
        </div>
    </section>
</x-layouts.base>
