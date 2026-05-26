<?php
require_once __DIR__ . '/Database.php';

class Article
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function countPublished(string $search = ''): int
    {
        $sql = 'SELECT COUNT(*) FROM articles WHERE is_published = 1';
        $params = [];

        if ($search !== '') {
            $sql .= ' AND title LIKE :search';
            $params['search'] = '%' . $search . '%';
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (int)$stmt->fetchColumn();
    }

    public function getPublished(int $limit, int $offset, string $search = ''): array
    {
        $sql = 'SELECT * FROM articles WHERE is_published = 1';
        $params = [];

        if ($search !== '') {
            $sql .= ' AND title LIKE :search';
            $params['search'] = '%' . $search . '%';
        }

        $sql .= ' ORDER BY created_at DESC LIMIT :limit OFFSET :offset';
        $stmt = $this->db->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value, PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM articles ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM articles WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $article = $stmt->fetch();

        return $article ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO articles (title, content, image, is_published, created_at)
             VALUES (:title, :content, :image, :is_published, NOW())'
        );

        return $stmt->execute([
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $data['image'],
            'is_published' => $data['is_published'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE articles
             SET title = :title, content = :content, image = :image, is_published = :is_published, updated_at = NOW()
             WHERE id = :id'
        );

        return $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $data['image'],
            'is_published' => $data['is_published'],
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM articles WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
