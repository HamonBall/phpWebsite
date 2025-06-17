<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Game</title>
    <link rel="stylesheet" href="/style.css">
    <style>
        .back-btn {
            display: inline-block;
            padding: 6px 16px;
            margin: 10px 0;
            background: #eee;
            color: #333;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }
        .back-btn:hover {
            background: #ddd;
        }
    </style>
</head>
<body>
    <h1><?= $localization->get('edit_game') ?></h1>
    <form method="post" action="/games/update/<?= urlencode($game['id']) ?>">
        <label><?= $localization->get('title') ?>: <input type="text" name="title" value="<?= htmlspecialchars($game['title']) ?>" required></label><br>
        <label><?= $localization->get('description') ?>:<br><textarea name="description" required><?= htmlspecialchars($game['description']) ?></textarea></label><br>
        <label><?= $localization->get('release_year') ?>: <input type="number" name="release_year" min="1970" max="2100" value="<?= htmlspecialchars($game['release_year']) ?>"></label><br>
        <label><?= $localization->get('developer') ?>: <input type="text" name="developer" value="<?= htmlspecialchars($game['developer']) ?>"></label><br>
        <button type="submit"><?= $localization->get('update_game') ?></button>
    </form>
    <a href="/games/show/<?= urlencode($game['id']) ?>" class="back-btn">&larr; <?= $localization->get('back_to_details') ?></a>
</body>
</html>
