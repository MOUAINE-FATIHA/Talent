<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $jobOffer->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if($jobOffer->image)
                        <img src="{{ asset('storage/' . $jobOffer->image) }}"
                             alt="{{ $jobOffer->titre }}"
                             class="w-full h-64 object-cover rounded-lg mb-6">
                    @endif

                    <div class="mb-6">
                        <h1 class="text-3xl font-bold mb-2">{{ $jobOffer->titre }}</h1>
                        <div class="flex items-center gap-4 text-gray-600 dark:text-gray-400 mb-4">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                {{ $jobOffer->entreprise }}
                            </span>
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                {{ $jobOffer->type_contrat }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-3">Description</h2>
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $jobOffer->description }}</p>
                    </div>

                    @auth
                        @if(Auth::user()->hasRole('recruteur'))
                            @php
                                $recruteur = \App\Models\Recruteur::where('user_id', Auth::id())->first();
                                $isOwner = $recruteur && $jobOffer->recruteur_id === $recruteur->id;
                            @endphp
                            @if($isOwner)
                                <div class="border-t dark:border-gray-700 pt-6 flex flex-wrap gap-3">
                                    <a href="{{ route('job.edit', $jobOffer) }}"
                                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                                        Modifier l'offre
                                    </a>
                                    <form method="POST" action="{{ route('job.destroy', $jobOffer) }}" class="inline"
                                          onsubmit="return confirm('Supprimer cette offre ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">
                                            Supprimer l'offre
                                        </button>
                                    </form>
                                    <a href="{{ route('job.my_offers') }}"
                                       class="inline-block text-gray-600 dark:text-gray-400 hover:underline py-2">
                                        Voir mes offres et candidatures
                                    </a>
                                </div>
                            @endif
                        @elseif(Auth::user()->hasRole('chercheur'))
                            <div class="border-t dark:border-gray-700 pt-6">
                                @if($jobOffer->closed)
                                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                        <p class="text-gray-600 dark:text-gray-400 font-semibold">
                                            Cette offre est clôturée et n'accepte plus de candidatures.
                                        </p>
                                    </div>
                                @else
                                    <form method="POST" action="{{ route('job.apply', $jobOffer) }}">
                                        @csrf
                                        <button type="submit"
                                                class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-red-700 font-bold py-3 px-8 rounded-lg transition">
                                            Postuler
                                        </button>
                                    </form>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                        Assurez-vous d'avoir un CV à jour avant de postuler
                                    </p>
                                @endif
                            </div>
                        @endif
                    @else
                        <div class="border-t dark:border-gray-700 pt-6">
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                Vous devez être connecté en tant que chercheur pour postuler à cette offre.
                            </p>
                            <a href="{{ route('login') }}"
                               class="inline-block  text-red-700 bg-red-600 font-bold py-3 px-8 rounded-lg">
                                Se connecter
                            </a>
                        </div>
                    @endauth

                    <div class="mt-6">
                        <a href="{{ route('job.offers') }}"
                           class="text-blue-600 dark:text-blue-400 hover:underline">
                            la liste des offres
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
