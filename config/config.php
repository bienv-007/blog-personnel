<?php
declare(strict_types=1);

session_start();

define('DB_HOST', 'sql309.infinityfree.com');
define('DB_NAME', 'db_blog_personnel');
define('DB_USER', 'if0_42040014');
define('DB_PASS', 'oQVp2MHsbeUSVd');

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
