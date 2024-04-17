<?php

class ArticleModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getArticleById(int $id): array
    {
        $stmt = $this->db->prepare('SELECT * FROM articles WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addArticle(string $title, string $description):void
    {
        $stmt = $this->db->prepare('INSERT INTO articles (title, description) VALUES (:title, :description)');
        $stmt->execute(['title' => $title, 'description' => $description]);
    }

    public function updateArticle(int $id, string $title, string $description):void
    {
        $stmt = $this->db->prepare('UPDATE articles SET title = :title, description = :description WHERE id = :id');
        $stmt->execute(['id' => $id, 'title' => $title, 'description' => $description]);
    }

    public function deleteArticle(int $id):void
    {
        $stmt = $this->db->prepare('DELETE FROM articles WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public function getAllArticles(): int
    {
        $query = $this->db->query('SELECT COUNT(*) as total FROM articles');
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return intval($result['total']);
    }
    public function getPostsPerPage(int $page, int $postsPerPage): array
    {
        $offset = ($page-1) * $postsPerPage;
        $stmt = $this->db->prepare('SELECT * FROM articles LIMIT :offset, :limit');
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $postsPerPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getTotalPages(int $totalPosts, int $postsPerPage): int
    {
        return ceil($totalPosts/$postsPerPage);
    }
}