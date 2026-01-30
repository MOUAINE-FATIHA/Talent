<x-guest-layout>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mot de passe oublié - Talent</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-50 font-sans">
            

            {{-- Formulaire --}}
            <div class=" rounded-lg p-8 w-full max-w-md">
                <h2 class="text-2xl font-bold mb-4 text-red-600 text-center">Mot de passe oublié ?</h2>
                
                <p class="mb-6 text-sm text-gray-600 text-center">
                    Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
                </p>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block font-medium text-gray-700 mb-1">Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Bouton --}}
                    <div class="flex items-center justify-center mt-4">
                        <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition">
                            Envoyer le lien de réinitialisation
                        </button>
                    </div>

                    {{-- Lien retour à connexion --}}
                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-red-600 underline">
                            Retour à la connexion
                        </a>
                    </div>
                </form>
            </div>

        </section>

    </body>
    </html>
</x-guest-layout>
