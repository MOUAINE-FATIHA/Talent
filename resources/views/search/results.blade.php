@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12">

    <h2 class="text-3xl font-bold mb-6">Recherche de profils</h2>

    <!-- FORMULAIRE -->
    <form method="GET" action="{{ route('search') }}"
          class="bg-white shadow rounded p-6 grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

        <input type="text" name="name" placeholder="Nom"
               value="{{ request('name') }}"
               class="border rounded px-3 py-2">

        <input type="text" name="specialite" placeholder="Spécialité"
               value="{{ request('specialite') }}"
               class="border rounded px-3 py-2">

        <button class="bg-red-600 text-white rounded px-4 py-2 hover:bg-red-700">
            Rechercher
        </button>
    </form>

    <!-- RESULTATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($users as $user)
            <div class="bg-white shadow rounded p-4 flex gap-4 items-center">
                <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://via.placeholder.com/80' }}"
                     class="w-20 h-20 rounded-full object-cover">

                <div>
                    <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
                    <p class="text-gray-600">{{ $user->specialite }}</p>

                    <a href="{{ route('profile.show', $user) }}"
                       class="text-red-600 text-sm hover:underline">
                        Voir profil
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Aucun utilisateur trouvé.</p>
        @endforelse
    </div>

</div>
@endsection
