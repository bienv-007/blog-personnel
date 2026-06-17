<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../classes/Auth.php';
require_once __DIR__ . '/../classes/Article.php';

Auth::requireLogin();

$articleModel = new Article();
$articles = $articleModel->getAll();
$publishedCount = count(array_filter($articles, fn(array $a): bool => (int)$a['is_published'] === 1));

$pageTitle = 'Tableau de bord';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-1">Tableau de bord</h1>
            <p class="text-muted mb-0">Bienvenue, <?= e($_SESSION['user_name'] ?? 'Admin') ?>.</p>
        </div>
        <a class="btn btn-primary" href="<?= e(BASE_URL . '/admin/article-create.php') ?>">Nouvel article</a>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-1">Articles</p>
                    <p class="display-6 mb-0"><?= count($articles) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-1">Publiés</p>
                    <p class="display-6 mb-0"><?= $publishedCount ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-1">Brouillons</p>
                    <p class="display-6 mb-0"><?= count($articles) - $publishedCount ?></p>
                </div>
            </div>
        </div>
    </div>

    <a class="btn btn-outline-primary mt-4" href="<?= e(BASE_URL . '/admin/articles.php') ?>">Gérer les articles</a>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
