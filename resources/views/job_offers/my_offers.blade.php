<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Mes offres d\'emploi') }}
            </h2>
            <a href="{{ route('job.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Créer une offre
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($jobOffers->count() > 0)
                <div class="space-y-6">
                    @foreach($jobOffers as $offer)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">

                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <div class="flex items-center gap-3">
                                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                                {{ $offer->titre }}
                                            </h3>
                                            @if($offer->closed)
                                                <span class="px-3 py-1 text-xs rounded-full bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                                    Clôturée
                                                </span>
                                            @else
                                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200">
                                                    Ouverte
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-gray-600 dark:text-gray-400 mt-1">
                                            {{ $offer->entreprise }} • {{ $offer->type_contrat }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">
                                            Publiée le {{ $offer->created_at->format('d/m/Y') }}
                                        </p>
                                    </div>
                                    <div class="flex flex-wrap gap-2 items-center">
                                        <a href="{{ route('job.edit', $offer) }}"
                                           class="text-sm px-3 py-1 rounded bg-blue-100 text-blue-700 hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-200">
                                            Modifier
                                        </a>
                                        <form method="POST" action="{{ route('job.toggle_close', $offer) }}" class="inline">
                                            @csrf
                                            <button type="submit"
                                                    class="text-sm px-3 py-1 rounded
                                                    @if($offer->closed)
                                                        bg-green-100 text-green-700 hover:bg-green-200 dark:bg-green-900 dark:text-green-200
                                                    @else
                                                        bg-orange-100 text-orange-700 hover:bg-orange-200 dark:bg-orange-900 dark:text-orange-200
                                                    @endif">
                                                {{ $offer->closed ? 'Réouvrir' : 'Clôturer' }}
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('job.destroy', $offer) }}" class="inline"
                                              onsubmit="return confirm('Supprimer cette offre ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-sm px-3 py-1 rounded bg-red-100 text-red-700 hover:bg-red-200 dark:bg-red-900 dark:text-red-200">
                                                Supprimer
                                            </button>
                                        </form>
                                        <a href="{{ route('job.show', $offer) }}"
                                           class="text-blue-600 hover:text-blue-800 text-sm">
                                            Voir l'offre
                                        </a>
                                    </div>
                                </div>

                                <div class="border-t dark:border-gray-700 pt-4">
                                    <h4 class="font-semibold text-lg mb-3 text-gray-900 dark:text-gray-100">
                                        Candidatures ({{ $offer->applications->count() }})
                                    </h4>

                                    @if($offer->applications->count() > 0)
                                        <div class="space-y-3">
                                            @foreach($offer->applications as $application)
                                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg flex justify-between items-center">
                                                    <div class="flex items-center gap-4">
                                                        <img src="{{ $application->user->photo ? asset('storage/' . $application->user->photo) : 'https://via.placeholder.com/50' }}"
                                                             class="w-12 h-12 rounded-full object-cover" alt="">
                                                        <div>
                                                            <h5 class="font-semibold text-gray-900 dark:text-gray-100">
                                                                {{ $application->user->name }}
                                                            </h5>
                                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                                {{ $application->user->specialite ?? 'Pas de spécialité' }}
                                                            </p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-500">
                                                                Postulé le {{ $application->created_at->format('d/m/Y à H:i') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center gap-3">
                                                        <span class="px-3 py-1 text-xs rounded-full
                                                            @if($application->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                            @elseif($application->status === 'accepted') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                            @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                                            @endif">
                                                            {{ ucfirst($application->status) }}
                                                        </span>
                                                        <a href="{{ route('profile.show', $application->user->id) }}"
                                                           class="text-blue-600 hover:text-blue-800 text-sm">
                                                            Voir profil
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500 dark:text-gray-400 italic py-4">
                                            Aucune candidature pour le moment
                                        </p>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-900 dark:text-gray-100">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium">Aucune offre d'emploi</h3>
                        <p class="mt-1 text-gray-500 dark:text-gray-400">Commencez par créer votre première offre d'emploi</p>
                        <div class="mt-6">
                            <a href="{{ route('job.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md">
                                Créer une offre
                            </a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
