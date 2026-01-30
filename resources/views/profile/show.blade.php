<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-red-600 leading-tight">
            Profil de {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-8 text-center">

            {{-- Photo --}}
            @if($user->photo)
                <img src="{{ asset('storage/'.$user->photo) }}" 
                     class="w-32 h-32 rounded-full mx-auto mb-6">
            @else
                <div class="w-32 h-32 bg-gray-300 rounded-full mx-auto mb-6 flex items-center justify-center">
                    Aucun Photo
                </div>
            @endif

            {{-- Name --}}
            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $user->name }}</h3>

            {{-- Specialite --}}
            <p class="text-gray-600 mb-4">
                <strong>Spécialité :</strong> {{ $user->specialite ?? 'Non renseignée' }}
            </p>

            {{-- Bio --}}
            <p class="text-gray-700">
                <strong>Bio :</strong><br>
                {{ $user->bio ?? 'Aucune biographie' }}
            </p>

        </div>
    </div>
</x-app-layout>
