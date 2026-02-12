<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Offres d'emploi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($jobOffers as $offer)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        @if($offer->image)
                            <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ $offer->titre }}" class="w-full h-40 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100">
                                <a href="{{ route('job.show', $offer) }}" class="hover:underline">{{ $offer->titre }}</a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">{{ $offer->entreprise }} · {{ $offer->type_contrat }}</p>
                            <a href="{{ route('job.show', $offer) }}" class="inline-block mt-3 text-red-600 dark:text-red-400 hover:underline">Voir l'offre →</a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-gray-500 dark:text-gray-400">Aucune offre pour le moment.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $jobOffers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
