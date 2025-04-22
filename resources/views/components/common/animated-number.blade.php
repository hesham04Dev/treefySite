@props(['to' => 100, 'duration' => 1000]) {{-- duration in milliseconds --}}

<span 
    x-data="{ count: 0 }" 
    x-init="
        let start = 0;
        const end = {{ $to }};
        const duration = {{ $duration }};
        const stepTime = Math.max(Math.floor(duration / end), 1);
        const counter = setInterval(() => {
            if (count < end) {
                count++;
            } else {
                clearInterval(counter);
            }
        }, stepTime);
    "
    x-text="count"
></span>
