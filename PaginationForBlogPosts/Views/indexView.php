<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link rel="stylesheet" href="Views/css/style.css">
</head>
<body>
<?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?= $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif; ?>
<form method="post" action="index.php?action=addArticle">
    <input type="text" name="title" placeholder="Title"><br>
    <input name="description" placeholder="Description"><br>
    <input type="hidden" name="action" value="addArticle">
    <button type="submit" name="addArticle" class="btn">Save</button>
</form>
<div class="blogPosts">
    <?php
    $counter = 0;
    foreach ($articles as $article):
        if ($counter % 4 == 0) {
            echo '<div class="postRow">';
        }
        ?>
        <div class="post">
            <h2><?= $article['title'] ?></h2>
            <p><?= $article['description'] ?></p>
            <p>
                <a href="index.php?action=viewArticle&id=<?= $article['id']; ?>">View</a>
            </p>
            <p>
                <a href="index.php?action=editArticle&id=<?= $article['id']; ?>">Edit</a>
            </p>
            <p>
                <a href="index.php?action=deleteArticle&id=<?= $article['id']; ?>">Delete</a>
            </p>
        </div>
        <?php
        $counter++;
        if ($counter % 4 == 0) {
            echo '</div>';
        }
    endforeach;
    if ($counter % 4 != 0) {
        echo '</div>';
    }
    ?>
</div>
<div class="pagination">
    <?php if ($currentPage > 1): ?>
        <a href="index.php?page=<?= $currentPage - 1 ?>">« Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="index.php?page=<?= $i ?>" <?= ($i == $currentPage) ? 'class="active"' : '' ?>><?= $i ?></a>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages): ?>
        <a href="index.php?page=<?= $currentPage + 1 ?>">Next »</a>
    <?php endif; ?>
</div>
</body>
</html>
