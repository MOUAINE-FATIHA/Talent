<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Talent</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    {{-- Main Section --}}
    <section class="flex flex-col md:flex-row items-center justify-center min-h-screen px-6 md:px-20">
        
        {{-- Formulaire --}}
        <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md md:mr-12">
            <h2 class="text-2xl font-bold mb-6 text-red-600 text-center">Connexion</h2>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-red-600">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block font-medium text-gray-700 mb-1">Mot de passe</label>
                    <input id="password" type="password" name="password" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-2">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-600">
                        <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                    </label>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center justify-between mt-4">
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-red-600 underline">Mot de passe oublié ?</a>
                    @endif
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition">Connexion</button>
                </div>
            </form>
        </div>

    </section>

</body>
</html>
