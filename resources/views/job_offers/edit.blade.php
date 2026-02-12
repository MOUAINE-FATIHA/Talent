<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier l\'offre') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('job.update', $jobOffer) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="titre" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Titre du poste <span class="text-red-500">*</span>
                            </label>
                            <input
                                id="titre"
                                type="text"
                                name="titre"
                                value="{{ old('titre', $jobOffer->titre) }}"
                                placeholder="Ex: Développeur Full Stack Senior"
                                required
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
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
                                value="{{ old('entreprise', $jobOffer->entreprise) }}"
                                placeholder="Nom de votre entreprise"
                                required
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
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
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Sélectionner un type</option>
                                <option value="CDI" {{ old('type_contrat', $jobOffer->type_contrat) == 'CDI' ? 'selected' : '' }}>CDI</option>
                                <option value="CDD" {{ old('type_contrat', $jobOffer->type_contrat) == 'CDD' ? 'selected' : '' }}>CDD</option>
                                <option value="Stage" {{ old('type_contrat', $jobOffer->type_contrat) == 'Stage' ? 'selected' : '' }}>Stage</option>
                                <option value="Freelance" {{ old('type_contrat', $jobOffer->type_contrat) == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                <option value="Alternance" {{ old('type_contrat', $jobOffer->type_contrat) == 'Alternance' ? 'selected' : '' }}>Alternance</option>
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
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $jobOffer->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="image" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                Image de l'offre (laisser vide pour conserver l'actuelle)
                            </label>
                            @if($jobOffer->image)
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Image actuelle :</p>
                                <img src="{{ asset('storage/' . $jobOffer->image) }}" alt="" class="w-32 h-32 object-cover rounded mb-2">
                            @endif
                            <input
                                id="image"
                                type="file"
                                name="image"
                                accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100
                                    dark:file:bg-blue-900 dark:file:text-blue-200">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">PNG, JPG, GIF jusqu'à 2MB</p>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('job.my_offers') }}"
                               class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">
                                Annuler
                            </a>
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
