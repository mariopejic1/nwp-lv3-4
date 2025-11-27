<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Uredi profil
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="name" class="block font-medium text-gray-700">Ime</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="border p-2 w-full" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="border p-2 w-full" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block font-medium text-gray-700">Nova lozinka (opcionalno)</label>
                    <input id="password" name="password" type="password" class="border p-2 w-full">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block font-medium text-gray-700">Potvrdi lozinku</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="border p-2 w-full">
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Spremi promjene
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
