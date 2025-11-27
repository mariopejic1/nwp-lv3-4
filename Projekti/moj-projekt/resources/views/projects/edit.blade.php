<x-app-layout>
    <x-slot name="header">
        <h2>Uredi projekt: {{ $project->naziv }}</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto">
        <form action="{{ route('projects.update', $project) }}" method="POST">
            @csrf
            @method('PUT')

            @if(auth()->id() === $project->user_id)
                <input type="text" name="naziv" value="{{ $project->naziv }}" class="border p-2 w-full mb-2" required>
                <textarea name="opis" class="border p-2 w-full mb-2">{{ $project->opis }}</textarea>
                <input type="number" name="cijena" value="{{ $project->cijena }}" class="border p-2 w-full mb-2">
                <input type="date" name="datum_pocetka" value="{{ $project->datum_pocetka }}" class="border p-2 w-full mb-2">
                <input type="date" name="datum_zavrsetka" value="{{ $project->datum_zavrsetka }}" class="border p-2 w-full mb-2">

                <label class="font-semibold">Odaberi članove tima:</label>
                <select name="clanovi[]" multiple class="border p-2 w-full mb-2">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($project->clanovi->contains($user)) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            @endif

            <label class="font-semibold">Dodaj novi obavljeni posao:</label>
            <textarea name="novi_task" class="border p-2 w-full mb-2" placeholder="Opis posla"></textarea>

            <h3 class="font-semibold mt-4">Svi obavljeni poslovi:</h3>
            <ul class="border p-2">
                @foreach($tasks as $task)
                    <li>{{ $task->user->name }}: {{ $task->opis_posla }}</li>
                @endforeach
            </ul>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-2">Spremi</button>
        </form>
    </div>
</x-app-layout>
