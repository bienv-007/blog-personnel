# Blog personnel PHP POO

Projet simple de blog personnel en PHP orienté objet, sans framework, avec PDO, administration et CRUD des articles.

## Fonctionnalités

- Liste publique des articles
- Recherche par titre
- Pagination
- Page détail d'un article
- Connexion administrateur
- Tableau de bord
- Ajout, modification, suppression et liste des articles
- Upload d'image JPG, PNG ou WEBP
- Requêtes préparées PDO
- Mots de passe sécurisés avec `password_hash` et `password_verify`

## Installation avec XAMPP/LAMPP

1. Placez le dossier dans `htdocs`, par exemple:

```text
/opt/lampp/htdocs/blog_personnel
```

2. Démarrez Apache et MySQL depuis XAMPP/LAMPP.

3. Importez la base de données:

```bash
mysql -u root -p < database.sql
```

Avec une installation XAMPP sans mot de passe MySQL, vous pouvez utiliser:

```bash
mysql -u root < database.sql
```

4. Vérifiez les identifiants dans `config/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'blog_personnel');
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

Changez ce mot de passe après l'installation dans un vrai projet.

## Structure

```text
config/      Configuration globale
classes/     Classes PHP orientées objet
includes/    Header, footer et protection admin
admin/       Pages d'administration
public/      Pages publiques secondaires
uploads/     Images envoyées
assets/      CSS
```

## Notes pédagogiques

- `Database` centralise la connexion PDO.
- `Article` contient les méthodes CRUD des articles.
- `User` recherche un administrateur par email.
- `Auth` gère la connexion, la session et la déconnexion.
- Les pages admin appellent `Auth::requireLogin()` pour empêcher l'accès non autorisé.
