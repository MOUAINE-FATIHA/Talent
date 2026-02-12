<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-red-600 leading-tight">
            Dashboard Chercheur
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-8 text-center">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">
                    Bienvenue, {{ Auth::user()->name }}!
                </h3>
                <p class="text-gray-600 text-lg mb-6">
                    Vous êtes Chercheur d'emploi. Consultez les offres et postulez à celles qui vous correspondent.
                </p>
                <a href="{{ route('job.offers') }}"
                   class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition">
                    Voir les offres d'emploi
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
