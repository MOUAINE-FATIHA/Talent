# Plan de réparation – Projet Talent / JobConnect

Réparer le projet **une petite étape à la fois**. Cochez chaque case quand c’est fait.

---

## Phase 1 : Fondations (sans ça, rien ne tourne correctement)

### Step 1.1 – User : autoriser le rôle et les champs profil
- [ ] Ouvrir `app/Models/User.php`
- [ ] Dans `$fillable`, ajouter : `'role'`, `'photo'`, `'bio'`, `'specialite'`
- [ ] Sauvegarder et tester l’inscription (le rôle doit être enregistré)

### Step 1.2 – Route Dashboard
- [ ] Ouvrir `routes/web.php`
- [ ] Ajouter une route **avant** les routes `/dashboard/chercheur` et `/dashboard/recruteur` :
  - `GET /dashboard` qui redirige selon `Auth::user()->role` vers `/dashboard/chercheur` ou `/dashboard/recruteur`
  - Nom de la route : `->name('dashboard')`
- [ ] Tester : après login, cliquer sur "Dashboard" dans le menu → pas d’erreur

### Step 1.3 – Import JobOfferController dans web.php
- [ ] En haut de `routes/web.php`, ajouter :  
  `use App\Http\Controllers\JobOfferController;`
- [ ] Sauvegarder

### Step 1.4 – Corriger JobOfferController (typo + use + vue)
- [ ] Ouvrir `app/Http/Controllers/JobOfferController.php`
- [ ] Ajouter en haut : `use App\Models\JobOffer;`
- [ ] Remplacer `comppact` par `compact`
- [ ] Remplacer `view('job_offers.index', ...)` par `view('listeOffres', compact('jobOffers'))`
- [ ] Sauvegarder

### Step 1.5 – Modèle Recruteur (classe complète)
- [ ] Ouvrir `app/Models/Recruteur.php`
- [ ] Remplacer tout le contenu par une vraie classe Eloquent :
  - `namespace App\Models;`
  - `use Illuminate\Database\Eloquent\Model;` et `use Illuminate\Database\Eloquent\Relations\HasMany;`
  - Classe `Recruteur extends Model`
  - `$fillable = ['user_id'];` (si tu as une table recruteurs) OU laisser vide si recruteur = juste le rôle sur User
  - Relation `jobOffers()` : `return $this->hasMany(JobOffer::class, 'recruteur_id');`
  - Si recruteur = User : relation `user()` vers `User` et table `recruteurs` avec `user_id`
- [ ] Décider : soit table `recruteurs` (user_id), soit pas de table et tout sur `users` (role). Adapter le modèle en conséquence.

### Step 1.6 – Modèle JobOffer (colonne + relation)
- [ ] Ouvrir `app/Models/JobOffer.php`
- [ ] Ajouter en haut : `namespace App\Models;` et `use Illuminate\Database\Eloquent\Model;`
- [ ] Dans `$fillable`, remplacer `recruiter_id` par `recruteur_id`
- [ ] Remplacer `Recruiter::class` par `Recruteur::class` dans `belongsTo`
- [ ] Ajouter si besoin : `use App\Models\Recruteur;`
- [ ] Sauvegarder

### Step 1.7 – Vue listeOffres (afficher les offres)
- [ ] Ouvrir `resources/views/listeOffres.blade.php`
- [ ] Utiliser le layout app (ex. `<x-app-layout>`) et afficher une liste de `$jobOffers` avec titre, entreprise, type de contrat, lien vers détail (à faire plus tard)
- [ ] Tester la route `/offres` : la page s’affiche sans erreur

### Step 1.8 – Page Recherche (layout)
- [ ] Ouvrir `resources/views/search/results.blade.php`
- [ ] Remplacer `@extends('layouts.app')` + `@section('content')` par `<x-app-layout>` et mettre le contenu dans `<x-slot name="header">` (titre) et le reste dans le body du layout
- [ ] Ou bien ajouter dans `resources/views/layouts/app.blade.php` un `@yield('content')` dans le `<main>` et garder `@extends` + `@section`
- [ ] Tester la recherche : les résultats s’affichent

---

## Phase 2 : Base de données (CV, formations, compétences)

### Step 2.1 – Migration : colonnes manquantes sur `cvs`
- [ ] Créer une migration :  
  `php artisan make:migration add_cv_columns_to_cvs_table --table=cvs`
- [ ] Dans `up()` : ajouter `$table->foreignId('user_id')->constrained()->cascadeOnDelete();` et `$table->string('title');`
- [ ] Dans `down()` : supprimer ces colonnes
- [ ] Exécuter : `php artisan migrate`

### Step 2.2 – Migration : colonnes sur `formations`
- [ ] Créer une migration pour ajouter les colonnes à `formations` :  
  `cv_id` (foreignId), `diplome`, `ecole`, `annee` (ou années)
- [ ] Exécuter la migration

### Step 2.3 – Migration : pivot `competence_cv`
- [ ] Créer une migration pour ajouter à la table `competence_cv` :  
  `$table->foreignId('competence_id')->constrained()->cascadeOnDelete();`  
  `$table->foreignId('cv_id')->constrained()->cascadeOnDelete();`
- [ ] Exécuter la migration

### Step 2.4 – Modèles Formation, Experience, Competence
- [ ] Créer `app/Models/Formation.php` (relation `belongsTo(Cv::class)`, fillable)
- [ ] Créer `app/Models/Experience.php` (table `experiences_cv`, relation `belongsTo(Cv::class)`, fillable : poste, entreprise, duree)
- [ ] Créer `app/Models/Competence.php` (fillable `name`, relation `belongsToMany(Cv::class)` via `competence_cv`)
- [ ] Dans `app/Models/CV.php` : ajouter `namespace App\Models;`, `use Illuminate\Database\Eloquent\Model;`, et les bons noms de table pour les relations (ex. `experiences_cv` pour Experience)

### Step 2.5 – CvController (index, create, store)
- [ ] Implémenter `index()` : récupérer le CV de l’utilisateur connecté (ou null), renvoyer `view('cv.show', compact('cv'))`
- [ ] Implémenter `create()` : renvoyer `view('cv.create')`
- [ ] Implémenter `store()` : validation (title, etc.), créer le CV pour `Auth::id()`, rediriger avec message succès
- [ ] Compléter les vues `cv/create.blade.php` et `cv/show.blade.php` (formulaire et affichage minimal)

---

## Phase 3 : Offres et candidatures

### Step 3.1 – Détail d’une offre
- [ ] Dans `JobOfferController`, ajouter une méthode `show(JobOffer $jobOffer)` (route model binding)
- [ ] Ajouter la route : `Route::get('/offres/{jobOffer}', [JobOfferController::class, 'show'])->name('job.show');`
- [ ] Créer la vue `resources/views/job_offers/show.blade.php` (ou une vue détail dans le même dossier que listeOffres) et afficher titre, description, entreprise, type de contrat, image

### Step 3.2 – Modèle Application
- [ ] Créer `app/Models/Application.php` (fillable : user_id, job_offer_id, status), relations `user()`, `jobOffer()`
- [ ] Dans `User` : `applications()` hasMany Application
- [ ] Dans `JobOffer` : `applications()` hasMany Application

### Step 3.3 – Postuler à une offre (chercheur)
- [ ] Route POST pour enregistrer une candidature (ex. `Route::post('/offres/{jobOffer}/postuler', ...)->name('job.apply');`)
- [ ] Contrôleur : vérifier que l’utilisateur est chercheur, qu’il n’a pas déjà postulé, créer Application, rediriger avec message
- [ ] Dans la vue détail de l’offre, ajouter un bouton "Postuler" qui envoie ce formulaire

### Step 3.4 – Création d’offres (recruteur)
- [ ] Routes : `get /offres/create`, `post /offres` (middleware auth)
- [ ] Dans le contrôleur : `create()` (formulaire), `store()` (validation, image obligatoire, enregistrer avec `recruteur_id` = user recruteur)
- [ ] Définir qui est le “recruteur” : soit `user_id` dans une table `recruteurs`, soit l’utilisateur connecté a le rôle recruteur et tu utilises son `id` comme `recruteur_id` dans `job_offers`. Adapter la migration `job_offers` si besoin (ex. `user_id` au lieu de `recruteur_id` si pas de table recruteurs)
- [ ] Vue formulaire création d’offre (titre, description, type de contrat, entreprise, image)

### Step 3.5 – Liste des candidatures (recruteur)
- [ ] Route type : `GET /mes-offres` ou `GET /offres/mes-candidatures`
- [ ] Afficher les offres du recruteur avec, pour chaque offre, la liste des candidatures (Application avec user)
- [ ] Vue dédiée

### Step 3.6 – Clôturer une offre
- [ ] Ajouter une colonne `closed` (boolean) ou `status` (open/closed) à `job_offers` (migration)
- [ ] Route + action pour passer l’offre en "clôturée"
- [ ] Dans les listes, ne plus proposer "Postuler" si l’offre est clôturée

---

## Phase 4 : Permissions et rôles (Spatie)

### Step 4.1 – Installer Spatie
- [ ] `composer require spatie/laravel-permission`
- [ ] `php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"`
- [ ] Migrer : `php artisan migrate`

### Step 4.2 – Utiliser Spatie dans User
- [ ] Dans `User.php`, ajouter le trait `HasRoles`
- [ ] Créer les rôles dans un Seeder : `Role::create(['name' => 'chercheur']);`, `Role::create(['name' => 'recruteur']);`
- [ ] À l’inscription, assigner le rôle : `$user->assignRole($request->role);`

### Step 4.3 – Middleware / politiques
- [ ] Sur les routes de création d’offres : middleware ou politique "recruteur uniquement"
- [ ] Sur la route "postuler" : "chercheur uniquement"
- [ ] Utiliser `@can` ou `$user->hasRole()` dans les vues si besoin

---

## Phase 5 : Amitiés

### Step 5.1 – Table et modèle
- [ ] Migration : table `friendships` ou `friend_user` (user_id, friend_id, status: pending/accepted/refused)
- [ ] Modèle `Friendship` (ou relation many-to-many sur User avec pivot)
- [ ] Relations sur User : demandes envoyées, reçues, amis acceptés

### Step 5.2 – Envoyer / accepter / refuser
- [ ] Routes et contrôleur : envoyer demande, accepter, refuser
- [ ] Vues : bouton "Ajouter en ami", liste des demandes reçues avec accepter/refuser

---

## Phase 6 : Livewire et performance

### Step 6.1 – Installer Livewire
- [ ] `composer require livewire/livewire`
- [ ] Inclure les scripts Livewire dans le layout (voir doc Livewire)

### Step 6.2 – Liste des offres en Livewire
- [ ] Créer un composant Livewire pour la liste des offres
- [ ] Mettre en place le lazy loading (pagination ou chargement à la demande) dans ce composant
- [ ] Remplacer l’appel actuel à la liste d’offres par ce composant

---

## Phase 7 : Seeders et factories

### Step 7.1 – Factories
- [ ] Factory pour `User` (avec rôle), `JobOffer`, `CV`, `Formation`, `Experience`, `Competence`, `Application`
- [ ] Utiliser Faker pour données réalistes

### Step 7.2 – DatabaseSeeder
- [ ] Créer des rôles (si Spatie), des utilisateurs (chercheurs + recruteurs), des offres, des CV, quelques candidatures
- [ ] `php artisan db:seed` pour vérifier

---

## Ordre recommandé (résumé)

1. Phase 1 (Steps 1.1 à 1.8) – sans délai  
2. Phase 2 (Steps 2.1 à 2.5) – pour que le CV fonctionne  
3. Phase 3 (Steps 3.1 à 3.6) – offres et candidatures  
4. Phase 4 – Spatie  
5. Phase 5 – Amitiés  
6. Phase 6 – Livewire  
7. Phase 7 – Seeders / factories  

Tu peux avancer **une étape à la fois** et revenir vers ce fichier pour cocher et choisir la prochaine.
