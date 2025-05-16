@props(['from' => 0, 'to' => 100, 'duration' => 1000]) {{-- duration in milliseconds --}}

<span x-data="{ count: {{ $from }} }" x-init="
        let start = {{ $from }} ;
        const end = {{ $to }};
        const duration = {{ $duration }};
        if(end - start > 100){
            start = end -100;
        }
        const stepTime = Math.max(Math.floor(duration / ( end - start)), 1);
        const counter = setInterval(() => {
        if(count < start){
            count = start;
        }
            if (count < end) {
                count++;
            } else {
                clearInterval(counter);
            }
        }, stepTime);
    " x-text="count"></span>