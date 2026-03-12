<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Blog Sublime</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>

    <header>
        <nav>
            <div class="logo">Mon<span>Blog</span></div>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Articles</a></li>
                <li><a href="#">À propos</a></li>
                <li><a href="#" class="btn-nav">S'abonner</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Explorez des récits qui inspirent.</h1>
            <p>Découvrez des articles passionnants sur la technologie, le design et le futur.</p>
            <a href="#articles" class="btn-main">Lire le blog</a>
        </section>

        <section id="articles" class="articles-grid">
            <div class="card">
                <div class="card-img" style="background-color: #e0e7ff;"></div>
                <div class="card-content">
                    <span>Technologie</span>
                    <h3>L'avenir du développement web</h3>
                    <p>Découvrez les tendances qui vont transformer le code en 2026.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-img" style="background-color: #fef3c7;"></div>
                <div class="card-content">
                    <span>Design</span>
                    <h3>Pourquoi le minimalisme gagne</h3>
                    <p>L'art de l'essentiel dans vos interfaces modernes.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-img" style="background-color: #d1fae5;"></div>
                <div class="card-content">
                    <span>Productivité</span>
                    <h3>Coder plus vite et mieux</h3>
                    <p>Mes astuces pour rester concentré et efficace au quotidien.</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Mon Blog Sublime. Créé avec passion.</p>
    </footer>

</body>
</html>