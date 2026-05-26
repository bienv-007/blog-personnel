<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../classes/Auth.php';
require_once __DIR__ . '/../classes/Article.php';

Auth::requireLogin();

$articleModel = new Article();
$id = (int)($_GET['id'] ?? 0);
$article = $articleModel->find($id);

if ($article) {
    $articleModel->delete($id);

    if (!empty($article['image']) && file_exists(UPLOAD_DIR . $article['image'])) {
        unlink(UPLOAD_DIR . $article['image']);
    }
}

header('Location: ' . BASE_URL . '/admin/articles.php?success=' . urlencode('Article supprimé avec succès.'));
exit;
