<?php
session_start();

include('Controllers/ArticleController.php');
include('DBConnection.php');
require_once 'Models/ArticleModel.php';


$dbConnection = DBConnection::getInstance();
$db = $dbConnection->getConnection();

$articleController = new ArticleController($db);

$action = $_GET['action'] ?? null;

switch ($action) {
    case 'editArticle':
        $articleController->editArticle($_GET['id']);
        break;
    case 'deleteArticle':
        $articleController->deleteArticle($_GET['id']);
        break;
    case 'viewArticle':
        $articleController->viewArticle($_GET['id']);
        break;
    case 'addArticle':
        $articleController->addArticle($_POST['title'], $_POST['description']);
        break;
    case 'updateArticle':
        $articleController->updateArticle($_POST['id'], $_POST['title'], $_POST['description']);
        break;
    default:
        $articleController->getArticles();
}
