<?php

class TestController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function viewArticle(int $id): array
    {
        $article = $this->model->getArticleById($id);
        include 'Views/articleView.php';
        return $article;
    }

    public function editArticle(int $id): array
    {
        $article = $this->model->getArticleById($id);
        include 'Views/articleEdit.php';
        return $article;
    }

    public function addArticle(string $title, string $description): void
    {
        if (empty($title) || empty($description)) {
            $_SESSION['errorMessage'] = "Title and description can't be empty";
            header('Location: index.php');
            exit();
        }

        $this->model->addArticle($title, $description);
        $_SESSION['successMessage'] = "Article added successfully";
        header('Location: index.php');
        exit();
    }

    public function updateArticle(int $id, string $title, string $description): void
    {
        $this->model->updateArticle($id, $title, $description);
        $_SESSION['successMessage'] = "Article updated successfully";
        header('Location: index.php');
        exit();
    }

    public function deleteArticle(int $id): void
    {
        $this->model->deleteArticle($id);
        $_SESSION['successMessage'] = "Article deleted successfully";
        header('Location: index.php');
        exit();
    }

    public function getArticles(): void
    {
        $totalPosts = $this->model->getAllArticles();
        $postsPerPage = 8;
        $totalPages = $this->model->getTotalPages($totalPosts, $postsPerPage);
        $currentPage = isset($_GET['page']) ? (int)$_GET(['page']) : 1;
        $articles = $this->model->getPostsPerPage($currentPage, $postsPerPage);
    }
}