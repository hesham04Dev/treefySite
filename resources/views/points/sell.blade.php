{{-- <x-layouts.base>
    <div class="container mx-auto p-6 max-w-lg bg-gradient-to-b from-white to-gray-50 shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold text-center mb-6">{{ __("sell_points") }}</h1>

        <p class="text-center mb-6">
            {{ __("your_points") }}: <strong>{{ auth()->user()->points }}</strong>
        </p>

        <form action="{{ route('points.sell') }}" method="POST" id="sell-form">
            @csrf

            <div class="mb-4">
                <label for="points" class="block mb-2 text-lg">{{ __("enter_points_to_sell") }}</label>
                <input type="number" min="1" name="points" id="points" class="input input-bordered w-full" value="100">
            </div>

            <div class="mb-6">
                <label for="amount" class="block mb-2 text-lg">{{ __("you_will_receive_usd") }}</label>
                <input type="text" name="amount" id="amount" class="input input-bordered w-full bg-gray-100 cursor-not-allowed" readonly>
            </div>

            <button type="submit" id="submit-btn" class="btn btn-success w-full hover:bg-green-700">
                {{ __("sell_points") }}
            </button>
        </form>

        <script>
            const pointsInput = document.getElementById('points');
            const amountInput = document.getElementById('amount');
            const submitBtn = document.getElementById('submit-btn');
            const userPoints = {{ auth()->user()->points }};
            const pointsToUsd = {{ config('app.points_to_usd') }}; // example: 0.1

            function updateAmount() {
                const points = parseInt(pointsInput.value) || 0;
                const amount = (points * pointsToUsd).toFixed(2);
                amountInput.value = amount;

                if (points > userPoints) {
                    amountInput.classList.add('bg-red-100');
                    submitBtn.disabled = true;
                    submitBtn.textContent = "{{ __('not_enough_points') }}";
                } else {
                    amountInput.classList.remove('bg-red-100');
                    submitBtn.disabled = false;
                    submitBtn.textContent = "{{ __('sell_points') }}";
                }
            }

            pointsInput.addEventListener('input', updateAmount);
            updateAmount();
        </script>
    </div>
</x-layouts.base> --}}



<x-layouts.base>
    <div class="container mx-auto p-6 max-w-lg bg-gradient-to-b from-white to-gray-50 shadow-lg rounded-lg" 
        x-data="{
            points: 100,
            userPoints: {{ auth()->user()->points }},
            pointsToUsd: {{ config('app.points_to_usd') }},
            useDifferentEmail: false,
            get amount() {
                return (this.points * this.pointsToUsd).toFixed(2);
            },
            get notEnoughPoints() {
                return this.points > this.userPoints;
            }
        }"
    >
        <h1 class="text-3xl font-semibold text-center mb-6">{{ __("sell_points") }}</h1>

        <p class="text-center mb-6">
            {{ __("your_points") }}: <strong>{{ auth()->user()->points }}</strong>
        </p>

        <form action="{{ route('points.sell') }}" method="POST" id="sell-form">
            @csrf

            <div class="mb-4">
                <label for="points" class="block mb-2 text-lg">{{ __("enter_points_to_sell") }}</label>
                <input type="number" min="1" name="points" id="points"
                    class="input input-bordered w-full"
                    x-model.number="points"
                >
            </div>

            <div class="mb-4">
                <label for="amount" class="block mb-2 text-lg">{{ __("you_will_receive_usd") }}</label>
                <input type="text" id="amount" readonly
                    class="input input-bordered w-full cursor-not-allowed"
                    :class="{ 'bg-red-100': notEnoughPoints, 'bg-gray-100': !notEnoughPoints }"
                    :value="amount"
                >
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center space-x-2">
                    <input type="checkbox" x-model="useDifferentEmail">
                    <span>{{ __('another_email') }}</span>
                </label>
            </div>

            <div class="mb-6" x-show="useDifferentEmail" x-transition>
                <label for="email" class="block mb-2 text-lg">{{ __("email") }}</label>
                <input type="email" name="email" id="email" class="input input-bordered w-full">
            </div>

            <button type="submit"
                id="submit-btn"
                class="btn btn-success w-full"
                :disabled="notEnoughPoints"
                x-text="notEnoughPoints ? '{{ __('not_enough_points') }}' : '{{ __('sell_points') }}'"
            ></button>
        </form>
    </div>
</x-layouts.base>
