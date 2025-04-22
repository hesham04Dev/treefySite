<div>
    <h2>{{ $data["title"] }}</h2>

    <ul>
        @if(isset($data["href"]))
        <li><a href="{{ $data["href"] }}">+</a></li>
        @endif
        @foreach($projects as $project)
            <li>{{ $project->name }}</li>
        @endforeach
    </ul>

    <div class="mt-4">
        {{ $projects->links() }}
    </div>
</div>
