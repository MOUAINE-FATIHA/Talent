<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talent</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    {{-- Navbar --}}
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-red-600">Talent</h1>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="px-4 py-2 border rounded hover:bg-red-600 hover:text-white transition">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Register</a>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="flex flex-col md:flex-row items-center justify-center mt-16 px-6 md:px-20">
        
        {{-- Texte --}}
        <div class="md:w-1/2 text-center md:text-left">
            <h2 class="text-4xl font-bold mb-4 text-gray-800">Connectez recruteurs et chercheurs d’emploi</h2>
            <p class="text-gray-600 mb-6 text-lg">Notre plateforme vous permet de créez un profil, cherchez des candidats ou trouvez votre emploi idéal facilement et rapidement.</p>
            <a href="{{ route('register') }}" class="px-6 py-3 bg-red-600 text-white rounded hover:bg-red-700 transition">Commencer maintenant</a>
        </div>

        {{-- Image --}}
        <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center">
            <img src="{{ asset('img/welcome-illustration.png') }}" alt="Recrutement illustration" class="w-80 h-auto">
        </div>

    </section>

    {{-- Footer pro --}}
    <footer class="bg-gray-900 text-gray-300 mt-16">
        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">

            {{-- Colonne 1 --}}
            <div>
                <h3 class="text-white font-bold mb-4">JobConnect</h3>
                <p class="text-sm">La plateforme qui connecte les recruteurs et les chercheurs d’emploi pour faciliter le recrutement et trouver le job idéal.</p>
            </div>

            {{-- Colonne 2 --}}
            <div>
                <h3 class="text-white font-bold mb-4">Liens rapides</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('register') }}" class="hover:text-white transition">S’inscrire</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white transition">Se connecter</a></li>
                    <li><a href="#" class="hover:text-white transition">Rechercher un profil</a></li>
                </ul>
            </div>

            {{-- Colonne 3 --}}
            <div>
                <h3 class="text-white font-bold mb-4">À propos</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">Nos objectifs</a></li>
                    <li><a href="#" class="hover:text-white transition">Conditions d’utilisation</a></li>
                    <li><a href="#" class="hover:text-white transition">Politique de confidentialité</a></li>
                </ul>
            </div>

            {{-- Colonne 4 --}}
            <div>
                <h3 class="text-white font-bold mb-4">Contact</h3>
                <p class="text-sm">Email: contact@jobconnect.com</p>
                <p class="text-sm">Téléphone: +212 600 000 000</p>
                <p class="text-sm">Adresse: Casablanca, Maroc</p>
            </div>

        </div>

        <div class="border-t border-gray-700 mt-8 text-center py-4 text-sm">
            &copy; {{ date('Y') }} JobConnect. Tous droits réservés.
        </div>
    </footer>

</body>
</html>
