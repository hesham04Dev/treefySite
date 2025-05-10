<x-layouts.base>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Sell Points</h1>

        <p class="mb-4">
            Your points: <strong>{{ auth()->user()->points }}</strong>
        </p>

        <form action="{{ route('points.sell') }}" method="POST" id="sell-form">
            @csrf

            <label for="points" class="block mb-2">Enter points to sell:</label>
            <input type="number" min="1" name="points" id="points" class="border p-2 rounded w-full mb-4" value="100">

            <label for="amount" class="block mb-2">You will receive (USD):</label>
            <input type="text" name="amount" id="amount" class="p-2 rounded w-full mb-4 bg-gray-100" readonly>

            <button type="submit" id="submit-btn" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Sell Points
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
                    submitBtn.textContent = "Not enough points";
                } else {
                    amountInput.classList.remove('bg-red-100');
                    submitBtn.disabled = false;
                    submitBtn.textContent = "Sell Points";
                }
            }

            pointsInput.addEventListener('input', updateAmount);
            updateAmount();
        </script>
    </div>
</x-layouts.base>
