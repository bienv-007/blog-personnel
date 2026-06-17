<?php
$pageTitle = 'Ajouter un article';
require_once __DIR__ . '/../includes/admin-header.php';
require_once __DIR__ . '/../classes/Article.php';

$articleModel = new Article();
$errors = [];
$title = '';
$content = '';
$isPublished = 1;

function uploadArticleImage(array $file, array &$errors): ?string
{
    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Erreur pendant l\'upload de l\'image.';
        return null;
    }

    $allowedTypes = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    $mimeType = mime_content_type($file['tmp_name']);

    if (!isset($allowedTypes[$mimeType])) {
        $errors[] = 'Format image autorisé: JPG, PNG ou WEBP.';
        return null;
    }

    if ($file['size'] > 2 * 1024 * 1024) {
        $errors[] = 'L\'image ne doit pas dépasser 2 Mo.';
        return null;
    }

    $fileName = uniqid('article_', true) . '.' . $allowedTypes[$mimeType];
    $destination = UPLOAD_DIR . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        $errors[] = 'Impossible d\'enregistrer l\'image.';
        return null;
    }

    return $fileName;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $isPublished = isset($_POST['is_published']) ? 1 : 0;
    $image = uploadArticleImage($_FILES['image'] ?? ['error' => UPLOAD_ERR_NO_FILE], $errors);

    if ($title === '') {
        $errors[] = 'Le titre est obligatoire.';
    }

    if ($content === '') {
        $errors[] = 'Le contenu est obligatoire.';
    }

    if (empty($errors)) {
        $articleModel->create([
            'title' => $title,
            'content' => $content,
            'image' => $image,
            'is_published' => $isPublished,
        ]);

        header('Location:' . BASE_URL . '/admin/articles.php?success=' . urlencode('Article ajouté avec succès.'));
        exit;
    }
}
?>

<section class="py-4">
    <div class="card shadow-sm mx-auto form-card">
        <div class="card-body p-4">
            <h1 class="h3 mb-4">Ajouter un article</h1>

            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger"><?= e($error) ?></div>
            <?php endforeach; ?>

            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label" for="title">Titre</label>
                    <input class="form-control" type="text" id="title" name="title" value="<?= e($title) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="content">Contenu</label>
                    <textarea class="form-control" id="content" name="content" rows="8" required><?= e($content) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="image">Image</label>
                    <input class="form-control" type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp">
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published" <?= $isPublished ? 'checked' : '' ?>>
                    <label class="form-check-label" for="is_published">Publier l'article</label>
                </div>

                <button class="btn btn-primary" type="submit">Enregistrer</button>
                <a class="btn btn-outline-secondary" href="<?= e(BASE_URL . '/admin/articles.php') ?>">Annuler</a>
            </form>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>