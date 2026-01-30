<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-red-600 leading-tight">
            Dashboard Recruteur
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-8 text-center">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">
                    Bienvenue, {{ Auth::user()->name }}!
                </h3>
                <p class="text-gray-600 text-lg">
                    Vous êtes Recruteur. Commencez à publier vos offres et rechercher des candidats.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
