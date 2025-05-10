<x-layouts.base>
<div>


    <form action="{{ route('paypal.create') }}" method="POST">
        @csrf
        <button type="submit">Buy 100 Points for $10</button>
    </form>

</div>
</x-layouts.base>