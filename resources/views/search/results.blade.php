<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Résultats de recherche pour "{{ $q }}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto">

            @if($users->isEmpty())
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
                    Aucun utilisateur trouvé.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($users as $user)
                        <div class="bg-white shadow p-4 rounded flex items-center space-x-4">
                            
                            {{-- Photo --}}
                            @if($user->photo)
                                <img src="{{ asset('storage/'.$user->photo) }}" class="w-16 h-16 rounded-full">
                            @else
                                <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">
                                    No Photo
                                </div>
                            @endif

                            {{-- Info --}}
                            <div>
                                <a href="{{ route('profile.show', $user->id) }}" class="text-lg font-bold text-blue-600 hover:underline">
                                    {{ $user->name }}
                                </a>
                                <p class="text-gray-600">
                                    {{ $user->specialite ?? 'Spécialité non renseignée' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
