<!doctype html>
<html lang="fr" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        (() => {
            const savedTheme = localStorage.getItem('theme-preference') || 'auto';
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.dataset.themePreference = savedTheme;
            document.documentElement.dataset.bsTheme = savedTheme === 'auto'
                ? (prefersDark ? 'dark' : 'light')
                : savedTheme;
        })();
    </script>
    <title><?= e($pageTitle ?? 'Blog personnel') ?> - Blog personnel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= e(BASE_URL . '/assets/css/style.css') ?>" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg app-navbar">
    <div class="container">
        <a class="navbar-brand" href="<?= e(BASE_URL . '/index.php') ?>">Blog personnel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="<?= e(BASE_URL . '/index.php') ?>">Accueil</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= e(BASE_URL . '/admin/dashboard.php') ?>">Administration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= e(BASE_URL . '/logout.php') ?>">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= e(BASE_URL . '/login.php') ?>">Connexion</a>
                    </li>
                <?php endif; ?>
            </ul>
            <button class="btn theme-toggle ms-lg-3 mt-3 mt-lg-0" type="button" data-theme-toggle aria-label="Changer le thème" title="Thème automatique">
                <svg class="theme-icon theme-icon-auto" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 5.75A2.75 2.75 0 0 1 6.75 3h10.5A2.75 2.75 0 0 1 20 5.75v7.5A2.75 2.75 0 0 1 17.25 16h-3.5v2.5h2.5a.75.75 0 0 1 0 1.5h-8.5a.75.75 0 0 1 0-1.5h2.5V16h-3.5A2.75 2.75 0 0 1 4 13.25v-7.5Zm2.75-1.25c-.69 0-1.25.56-1.25 1.25v7.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-7.5c0-.69-.56-1.25-1.25-1.25H6.75Z"/>
                </svg>
                <svg class="theme-icon theme-icon-light" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 4.25a.75.75 0 0 1-.75-.75v-1a.75.75 0 0 1 1.5 0v1a.75.75 0 0 1-.75.75Zm0 18a.75.75 0 0 1-.75-.75v-1a.75.75 0 0 1 1.5 0v1a.75.75 0 0 1-.75.75Zm9.5-9.5h-1a.75.75 0 0 1 0-1.5h1a.75.75 0 0 1 0 1.5Zm-18 0h-1a.75.75 0 0 1 0-1.5h1a.75.75 0 0 1 0 1.5Zm14.17-5.36a.75.75 0 0 1-.53-1.28l.7-.7a.75.75 0 0 1 1.06 1.06l-.7.7a.75.75 0 0 1-.53.22ZM5.63 19.43a.75.75 0 0 1-.53-1.28l.7-.7a.75.75 0 1 1 1.06 1.06l-.7.7a.75.75 0 0 1-.53.22Zm12.75 0a.75.75 0 0 1-.53-.22l-.7-.7a.75.75 0 0 1 1.06-1.06l.7.7a.75.75 0 0 1-.53 1.28ZM6.33 7.39a.75.75 0 0 1-.53-.22l-.7-.7a.75.75 0 0 1 1.06-1.06l.7.7a.75.75 0 0 1-.53 1.28ZM12 17a5 5 0 1 1 0-10 5 5 0 0 1 0 10Z"/>
                </svg>
                <svg class="theme-icon theme-icon-dark" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M20.3 14.4a.75.75 0 0 1 .83 1.02A9.75 9.75 0 1 1 8.58 2.87a.75.75 0 0 1 1.02.83 8.25 8.25 0 0 0 10.7 10.7Z"/>
                </svg>
            </button>
        </div>
    </div>
</nav>
<main class="container">
