<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Talent</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    {{-- Main Section --}}
    <section class="flex flex-col md:flex-row items-center justify-center min-h-screen px-6 md:px-20">
        
        {{-- Formulaire --}}
        <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md md:mr-12">
            <h2 class="text-2xl font-bold mb-6 text-red-600 text-center">Inscription</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block font-medium text-gray-700 mb-1">Nom</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block font-medium text-gray-700 mb-1">Mot de passe</label>
                    <input id="password" type="password" name="password" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block font-medium text-gray-700 mb-1">Vous êtes :</label>
                    <select id="role" name="role" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
                        <option value="chercheur" {{ old('role') == 'chercheur' ? 'selected' : '' }}>Chercheur d'emploi</option>
                        <option value="recruteur" {{ old('role') == 'recruteur' ? 'selected' : '' }}>Recruteur</option>
                    </select>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-red-600 underline">Déjà inscrit ?</a>
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition">S’inscrire</button>
                </div>
            </form>
        </div>
    </section>

</body>
</html>
