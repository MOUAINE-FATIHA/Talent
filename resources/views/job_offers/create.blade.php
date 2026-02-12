<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-red-500 leading-tight">
            {{ __('Créer un offre') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('job.store') }}">
                        @csrf

                        <!-- Titre -->
                        <div class="mb-6">
                            <label for="titre" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Titre du poste <span class="text-red-500">*</span>
                            </label>
                            <input
                                id="titre"
                                type="text"
                                name="titre"
                                value="{{ old('titre') }}"
                                placeholder="Ex: Développeur Full Stack Senior"
                                required
                                class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            @error('titre')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="entreprise" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Entreprise <span class="text-red-500">*</span>
                            </label>
                            <input
                                id="entreprise"
                                type="text"
                                name="entreprise"
                                value="{{ old('entreprise') }}"
                                placeholder="Nom de votre entreprise"
                                required
                                class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            @error('entreprise')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="type_contrat" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Type de contrat <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="type_contrat"
                                name="type_contrat"
                                required
                                class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                <option value="">Sélectionner un type</option>
                                <option value="CDI" {{ old('type_contrat') == 'CDI' ? 'selected' : '' }}>CDI</option>
                                <option value="CDD" {{ old('type_contrat') == 'CDD' ? 'selected' : '' }}>CDD</option>
                                <option value="Stage" {{ old('type_contrat') == 'Stage' ? 'selected' : '' }}>Stage</option>
                            </select>
                            @error('type_contrat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                rows="8"
                                required
                                placeholder="Décrivez le poste, les missions, les compétences requises..."
                                class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4 pb-2 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('job.my_offers') }}"
                               class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline">
                                Annuler
                            </a>
                            <button type="submit"
                                    class="inline-block bg-blue-600 text-red font-bold py-3 px-8">
                                Publier
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
