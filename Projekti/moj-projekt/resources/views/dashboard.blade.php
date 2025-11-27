<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                {{ __("You're logged in!") }}
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Kreiraj novi projekt
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-lg mb-2">Moji projekti (kao voditelj)</h3>
                @forelse(auth()->user()->projektiVoditelj as $p)
                    <div class="border-b py-1">
                        <a href="{{ route('projects.edit', $p) }}" class="text-blue-600 hover:underline">
                            {{ $p->naziv }}
                        </a>
                    </div>
                @empty
                    <div>Nema projekata.</div>
                @endforelse
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-lg mb-2">Projekti na kojima sam član</h3>
                @forelse(auth()->user()->projektiClan as $p)
                    <div class="border-b py-1">
                        <a href="{{ route('projects.edit', $p) }}" class="text-blue-600 hover:underline">
                            {{ $p->naziv }}
                        </a>
                    </div>
                @empty
                    <div>Nema projekata.</div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
