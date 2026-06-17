<?php
declare(strict_types=1);

session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'db_blog_personnel');
define('DB_USER', 'root');
define('DB_PASS', '');

// Adaptez cette valeur si le dossier du projet change dans htdocs.
define('BASE_URL', '/blog_personnel');
define('UPLOAD_DIR', __DIR__ . '/../uploads/');

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function excerpt(string $text, int $limit = 150): string
{
    $cleanText = trim(strip_tags($text));

    if (mb_strlen($cleanText) <= $limit) {
        return $cleanText;
    }

    return mb_substr($cleanText, 0, $limit) . '...';
}

function formatDate(string $date): string
{
    return date('d/m/Y à H:i', strtotime($date));
}

function uploadImage(array $file, array &$errors): ?string
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

    if (!move_uploaded_file($file['tmp_name'], UPLOAD_DIR . $fileName)) {
        $errors[] = 'Impossible d\'enregistrer l\'image.';
        return null;
    }

    return $fileName;
}
