<x-app-layout>
    <x-slot name="header">
        <h2>Kreiraj novi projekt</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto">
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf

            <input type="text" name="naziv" placeholder="Naziv projekta" class="border p-2 w-full mb-2" required>
            <textarea name="opis" placeholder="Opis projekta" class="border p-2 w-full mb-2"></textarea>
            <input type="number" name="cijena" placeholder="Cijena projekta" class="border p-2 w-full mb-2">
            <input type="date" name="datum_pocetka" class="border p-2 w-full mb-2">
            <input type="date" name="datum_zavrsetka" class="border p-2 w-full mb-2">

            <label class="font-semibold">Odaberi članove tima:</label>
            <select name="clanovi[]" multiple class="border p-2 w-full mb-2">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kreiraj projekt</button>
        </form>
    </div>
</x-app-layout>
