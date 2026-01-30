<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-red-600 leading-tight">
            Modifier mon profil
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-8">

            {{-- Message success --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-6 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Name --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Nom</label>
                    <input type="text" name="name" value="{{ $user->name }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>

                {{-- Specialite --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Spécialité</label>
                    <input type="text" name="specialite" value="{{ $user->specialite }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>

                {{-- Bio --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Bio</label>
                    <textarea name="bio" rows="4"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">{{ $user->bio }}</textarea>
                </div>

                {{-- Photo --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Photo de profil</label>
                    <input type="file" name="photo" class="w-full">
                </div>

                {{-- Current photo --}}
                @if($user->photo)
                    <div class="mb-4">
                        <img src="{{ asset('storage/'.$user->photo) }}" class="w-24 h-24 rounded-full mx-auto">
                    </div>
                @endif

                <button type="submit"
                    class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 transition">
                    Enregistrer
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
