<div>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form action="{{ route('paypal.create') }}" method="POST">
        @csrf
        <button type="submit">Buy 100 Points for $10</button>
    </form>

</div>