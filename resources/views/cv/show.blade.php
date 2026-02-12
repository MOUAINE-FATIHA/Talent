<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mon CV') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('info'))
                <div class="mb-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
                    {{ session('info') }}
                </div>
            @endif

            @if($cv)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        
                        <!-- CV Header -->
                        <div class="border-b dark:border-gray-700 pb-4 mb-6">
                            <h3 class="text-2xl font-bold">{{ $cv->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ Auth::user()->name }}</p>
                        </div>

                        <!-- Formations Section -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-semibold">Formations</h4>
                                <button class="text-blue-600 hover:text-blue-800 text-sm">+ Ajouter une formation</button>
                            </div>
                            
                            @if($cv->formations->count() > 0)
                                <div class="space-y-4">
                                    @foreach($cv->formations as $formation)
                                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                            <h5 class="font-semibold">{{ $formation->diplome }}</h5>
                                            <p class="text-gray-600 dark:text-gray-300">{{ $formation->ecole }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $formation->annee }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400 italic">Aucune formation ajoutée</p>
                            @endif
                        </div>

                        <!-- Experiences Section -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-semibold">Expériences</h4>
                                <button class="text-blue-600 hover:text-blue-800 text-sm">+ Ajouter une expérience</button>
                            </div>
                            
                            @if($cv->experiences->count() > 0)
                                <div class="space-y-4">
                                    @foreach($cv->experiences as $experience)
                                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                            <h5 class="font-semibold">{{ $experience->poste }}</h5>
                                            <p class="text-gray-600 dark:text-gray-300">{{ $experience->entreprise }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $experience->duree }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400 italic">Aucune expérience ajoutée</p>
                            @endif
                        </div>

                        <!-- Competences Section -->
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-semibold">Compétences</h4>
                                <button class="text-blue-600 hover:text-blue-800 text-sm">+ Ajouter des compétences</button>
                            </div>
                            
                            @if($cv->competences->count() > 0)
                                <div class="flex flex-wrap gap-2">
                                    @foreach($cv->competences as $competence)
                                        <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm">
                                            {{ $competence->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400 italic">Aucune compétence ajoutée</p>
                            @endif
                        </div>

                    </div>
                </div>
            @else
                <!-- No CV yet -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium">Vous n'avez pas encore de CV</h3>
                        <p class="mt-1 text-gray-500 dark:text-gray-400">Créez votre CV pour commencer à postuler aux offres d'emploi</p>
                        <div class="mt-6">
                            <a href="{{ route('cv.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md">
                                Créer mon CV
                            </a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>