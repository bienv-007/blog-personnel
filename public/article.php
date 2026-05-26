<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../classes/Article.php';

$articleModel = new Article();
$id = (int)($_GET['id'] ?? 0);
$article = $articleModel->find($id);

if (!$article || (int)$article['is_published'] !== 1) {
    http_response_code(404);
    $pageTitle = 'Article introuvable';
    require_once __DIR__ . '/../includes/header.php';
    ?>
    <div class="alert alert-warning mt-4">Article introuvable.</div>
    <a class="btn btn-primary" href="<?= e(BASE_URL . '/index.php') ?>">Retour à l'accueil</a>
    <?php
    require_once __DIR__ . '/../includes/footer.php';
    exit;
}

$pageTitle = $article['title'];
require_once __DIR__ . '/../includes/header.php';
?>

<article class="py-4">
    <a class="btn btn-sm btn-outline-secondary mb-3" href="<?= e(BASE_URL . '/index.php') ?>">Retour</a>
    <h1 class="mb-2"><?= e($article['title']) ?></h1>
    <p class="text-muted">Publié le <?= e(formatDate($article['created_at'])) ?></p>

    <?php if (!empty($article['image'])): ?>
        <img src="<?= e(BASE_URL . '/uploads/' . $article['image']) ?>" class="img-fluid rounded article-detail-image mb-4 w-100" alt="<?= e($article['title']) ?>">
    <?php endif; ?>

    <div class="article-content bg-white rounded shadow-sm p-4">
        <?= nl2br(e($article['content'])) ?>
    </div>
</article>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
