# Blog personnel PHP POO

Projet de blog personnel en PHP orienté objet, sans framework. Il utilise PDO pour communiquer avec MySQL, une petite administration protégée par session, et un CRUD complet pour gérer les articles.

## Fonctionnalités

- Liste publique des articles publiés
- Recherche d'articles par titre
- Pagination de la page d'accueil
- Page détail pour lire un article
- Connexion administrateur
- Tableau de bord d'administration
- Ajout, modification, suppression et liste des articles
- Upload d'image en JPG, PNG ou WEBP
- Thème automatique, clair et sombre avec préférence sauvegardée dans le navigateur
- Requêtes préparées PDO
- Mots de passe vérifiés avec `password_verify`

## Installation avec XAMPP/LAMPP

1. Placez le dossier dans `htdocs`, par exemple:

```text
/opt/lampp/htdocs/blog_personnel
```

2. Démarrez Apache et MySQL depuis XAMPP/LAMPP.

3. Importez la base de données:

```bash
mysql -u root < database.sql
```

Si votre utilisateur MySQL a un mot de passe:

```bash
mysql -u root -p < database.sql
```

4. Vérifiez les constantes dans `config/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_blog_personnel');
define('DB_USER', 'root');
define('DB_PASS', '');
define('BASE_URL', '/blog_personnel');
```

5. Ouvrez le site:

```text
http://localhost/blog_personnel/
```

## Compte administrateur

```text
Email: admin@example.com
Mot de passe: admin123
```

Dans un vrai projet, changez ce mot de passe après l'installation.

## Structure du projet

```text
blog_personnel/
├── admin/
├── assets/
│   └── css/
├── classes/
├── config/
├── includes/
├── public/
├── uploads/
├── database.sql
├── index.php
├── login.php
├── logout.php
└── README.md
```

## Rôle des dossiers

`config/`
Contient la configuration globale du projet. Le fichier `config/config.php` démarre la session, définit les accès à la base de données, définit `BASE_URL`, le dossier d'upload, et fournit quelques fonctions utiles comme `e()`, `excerpt()` et `formatDate()`.

`classes/`
Contient la logique PHP orientée objet. Ces classes évitent de mettre toutes les requêtes SQL directement dans les pages.

`includes/`
Contient les morceaux d'interface réutilisables. `header.php` ouvre la page HTML, affiche la navbar et applique le thème. `footer.php` ferme la page, charge Bootstrap JS et gère le changement de thème. `admin-header.php` protège les pages d'administration avant d'inclure le header.

`admin/`
Contient les pages réservées à l'administrateur: tableau de bord, liste des articles, création, modification et suppression. Ces pages passent par `Auth::requireLogin()` pour empêcher l'accès sans connexion.

`public/`
Contient les pages publiques secondaires. Par exemple, `public/article.php` affiche le détail d'un article publié.

`assets/`
Contient les fichiers statiques du site. Pour l'instant, `assets/css/style.css` centralise le style personnalisé, dont les couleurs du thème et la navbar.

`uploads/`
Reçoit les images envoyées lors de la création ou modification d'un article. Ce dossier doit être accessible en écriture par PHP.

## Rôle des fichiers principaux

`index.php`
Page d'accueil publique. Elle récupère les articles publiés, applique la recherche, calcule la pagination et affiche les cartes d'articles.

`login.php`
Page de connexion administrateur. Elle vérifie les champs du formulaire et appelle `Auth::login()`.

`logout.php`
Déconnecte l'utilisateur en détruisant la session, puis redirige.

`database.sql`
Décrit la structure initiale de la base de données: table `users`, table `articles`, compte administrateur de départ et articles de démonstration.

## Rôle des classes

`Database`
Centralise la connexion PDO. Les autres classes l'utilisent pour exécuter leurs requêtes SQL.

`Article`
Gère les articles: récupération des articles publiés, comptage, recherche, lecture d'un article, création, modification et suppression.

`User`
Gère la récupération d'un utilisateur par email. Cette classe est utilisée par l'authentification.

`Auth`
Gère la connexion, la vérification de session, la protection des pages admin et la déconnexion.

## Fonctionnement général

1. Une page inclut `config/config.php` pour charger la session, la configuration et les fonctions communes.
2. La page instancie une classe métier, par exemple `Article`.
3. La classe utilise `Database` pour parler à MySQL avec PDO.
4. La page prépare ses données, puis inclut `includes/header.php`.
5. Le contenu HTML est affiché.
6. La page inclut `includes/footer.php`.

## Administration

Les pages dans `admin/` ne doivent pas être accessibles directement sans session. Pour cela, `includes/admin-header.php` charge `Auth`, appelle `Auth::requireLogin()`, puis inclut le header normal.

Si l'utilisateur n'est pas connecté, il est redirigé vers:

```text
/blog_personnel/login.php
```

## Thèmes

Le bouton dans la navbar permet de passer entre trois modes:

- `auto`: suit le thème du système de l'utilisateur
- `clair`: force le thème clair
- `sombre`: force le thème sombre

Le choix est sauvegardé dans `localStorage`, donc le navigateur le conserve entre les pages et les visites. Bootstrap reçoit le thème via l'attribut `data-bs-theme` sur la balise `<html>`.

## Sécurité et bonnes pratiques utilisées

- Les mots de passe ne sont pas comparés en clair: `Auth` utilise `password_verify`.
- Les requêtes SQL passent par PDO et des requêtes préparées.
- Les textes affichés dans le HTML passent par `e()` pour limiter les risques XSS.
- Les pages d'administration sont protégées par session.
- Les uploads sont limités aux images JPG, PNG et WEBP.

## Points à améliorer pour un vrai projet

- Ajouter un système de rôles si plusieurs types d'utilisateurs sont nécessaires.
- Ajouter une protection CSRF sur les formulaires d'administration.
- Renommer les images uploadées avec une stratégie plus robuste.
- Ajouter une validation plus complète des contenus.
- Ajouter une page de gestion du profil administrateur pour changer le mot de passe.
