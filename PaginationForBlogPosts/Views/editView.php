<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Views/css/style.css">
    <title>Edit Article</title>
</head>
<body>
<form method="post" action="index.php?action=updateArticle&updateArticle=<?= $article['id']; ?>">
    <input type="hidden" name="id" value="<?= $article['id']; ?>">
    <input type="text" name="title" placeholder="Title" value="<?= $article['title']; ?>"><br>
    <input type="text" name="description" placeholder="Description" value="<?= $article['description']; ?>"><br>
    <button type="submit" name="updateArticle" class="btn">Update</button>
</form>
</body>
</html>
