<x-app-layout>
    <x-slot name="header">
        <h2>{{ $project->naziv }}</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto">
        <p>{{ $project->opis }}</p>
        <p><strong>Voditelj:</strong> {{ $project->voditelj->name }}</p>
        <p><strong>Članovi tima:</strong></p>
        <ul>
            @foreach($project->clanovi as $clan)
                <li>{{ $clan->name }}</li>
            @endforeach
        </ul>

        <h3 class="font-semibold mt-4">Svi obavljeni poslovi:</h3>
        <ul class="border p-2">
            @foreach($tasks as $task)
                <li>{{ $task->user->name }}: {{ $task->opis_posla }}</li>
            @endforeach
        </ul>

        <a href="{{ route('projects.edit', $project) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-2 inline-block">Uredi</a>
    </div>
</x-app-layout>
