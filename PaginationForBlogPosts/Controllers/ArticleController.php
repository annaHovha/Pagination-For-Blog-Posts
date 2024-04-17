<?php
class ArticleController
{
    private $model;
    public function __construct($db)
    {
        $this->model = new ArticleModel($db);
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
        include 'Views/editView.php';
        return $article;
    }

    public function addArticle(string $title, string $description): void
    {
        if (empty($title) || empty($description)) {
            $_SESSION['message'] = 'All Fields are required';
            header('location: index.php');
            exit();
        }

        $this->model->addArticle($title, $description);
        $_SESSION['message'] = 'Article added successfully';
        header('Location: index.php');
        exit();
    }

    public function updateArticle(int $id, string $title, string $description): void
    {
        $this->model->updateArticle($id, $title, $description);

        $_SESSION['message'] = 'Article updated successfully';
        header('Location: index.php');
        exit();
    }

    public function deleteArticle(int $id): void
    {
        $this->model->deleteArticle($id);
        $_SESSION['message'] = 'Article deleted successfully';
        header('Location: index.php');
        exit();
    }

    public function getArticles(): void
    {
        $totalPosts = $this->model->getAllArticles();
        $postsPerPage = 8;
        $totalPages = $this->model->getTotalPages($totalPosts, $postsPerPage);
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $articles = $this->model->getPostsPerPage($currentPage, $postsPerPage);
        include 'Views/indexView.php';
    }
}

