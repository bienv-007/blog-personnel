<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/classes/Article.php';

$articleModel = new Article();

$search = trim($_GET['q'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 6;
$offset = ($page - 1) * $perPage;

$totalArticles = $articleModel->countPublished($search);
$articles = $articleModel->getPublished($perPage, $offset, $search);
$totalPages = (int)ceil($totalArticles / $perPage);

$pageTitle = 'Accueil';
require_once __DIR__ . '/includes/header.php';
?>

<section class="py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 align-items-md-center mb-4">
        <div>
            <h1 class="h2 mb-1">Blog personnel</h1>
            <p class="text-muted mb-0">Articles, idées et notes personnelles.</p>
        </div>
        <form class="d-flex search-form" method="get" action="index.php">
            <input class="form-control" type="search" name="q" value="<?= e($search) ?>" placeholder="Rechercher un titre">
            <button class="btn btn-primary ms-2" type="submit">Rechercher</button>
        </form>
    </div>

    <?php if (empty($articles)): ?>
        <div class="alert alert-info">Aucun article trouvé.</div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($articles as $article): ?>
                <div class="col-md-6 col-lg-4">
                    <article class="card h-100 shadow-sm">
                        <?php if (!empty($article['image'])): ?>
                            <img src="<?= e(BASE_URL . '/uploads/' . $article['image']) ?>" class="card-img-top article-image" alt="<?= e($article['title']) ?>">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <p class="small text-muted mb-2">
                                Publié le <?= e(formatDate($article['created_at'])) ?>
                            </p>
                            <h2 class="h5 card-title"><?= e($article['title']) ?></h2>
                            <p class="card-text text-muted">
                                <?= e(excerpt($article['content'], 140)) ?>
                            </p>
                            <a class="btn btn-outline-primary mt-auto" href="<?= e(BASE_URL . '/public/article.php?id=' . $article['id']) ?>">
                                Lire l'article
                            </a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($totalPages > 1): ?>
        <nav class="mt-4" aria-label="Pagination">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&q=<?= urlencode($search) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
