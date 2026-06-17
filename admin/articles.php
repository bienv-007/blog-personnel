<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../classes/Auth.php';
require_once __DIR__ . '/../classes/Article.php';

Auth::requireLogin();

$articleModel = new Article();
$articles = $articleModel->getAll();
$success = $_GET['success'] ?? '';

$pageTitle = 'Gestion des articles';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Articles</h1>
        <a class="btn btn-primary" href="<?= e(BASE_URL . '/admin/article-create.php') ?>">Ajouter</a>
    </div>

    <?php if ($success !== ''): ?>
        <div class="alert alert-success"><?= e($success) ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($articles)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Aucun article.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td>
                                <?php if (!empty($article['image'])): ?>
                                    <img class="rounded admin-table-image" src="<?= e(BASE_URL . '/uploads/' . $article['image']) ?>" alt="">
                                <?php else: ?>
                                    <span class="text-muted small">Aucune</span>
                                <?php endif; ?>
                            </td>
                            <td><?= e($article['title']) ?></td>
                            <td>
                                <span class="badge <?= (int)$article['is_published'] === 1 ? 'text-bg-success' : 'text-bg-secondary' ?>">
                                    <?= (int)$article['is_published'] === 1 ? 'Publié' : 'Brouillon' ?>
                                </span>
                            </td>
                            <td><?= e(formatDate($article['created_at'])) ?></td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="<?= e(BASE_URL . '/admin/article-edit.php?id=' . $article['id']) ?>">Modifier</a>
                                <a class="btn btn-sm btn-outline-danger" href="<?= e(BASE_URL . '/admin/article-delete.php?id=' . $article['id']) ?>" onclick="return confirm('Supprimer cet article ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
