<div>
    <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ $data["title"] }}</h2>

    @if(isset($data["href"]))
        <div class="mb-4">
            <a href="{{ $data["href"] }}" class="inline-block px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                + Add Project
            </a>
        </div>
    @endif

    <ul class="space-y-2">
        @foreach($projects as $project)
            <li class="p-3 bg-gray-100 rounded hover:bg-gray-200 transition">
                {{ $project->name }}
            </li>
        @endforeach
    </ul>

    <div class="mt-6">
        {{ $projects->links() }}
    </div>
</div>

