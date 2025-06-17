<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $localization->get('add_game') ?></title>
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
    <h1><?= $localization->get('add_game') ?></h1>
    <form method="post" action="/games/store">
        <label><?= $localization->get('title') ?>: <input type="text" name="title" required></label><br>
        <label><?= $localization->get('description') ?>:<br><textarea name="description" required></textarea></label><br>
        <label><?= $localization->get('release_year') ?>: <input type="number" name="release_year" min="1970" max="2100"></label><br>
        <label><?= $localization->get('developer') ?>: <input type="text" name="developer"></label><br>
        <button type="submit"><?= $localization->get('add_game') ?></button>
    </form>
    <a href="/" class="back-btn">&larr; <?= $localization->get('back_to_library') ?></a>
</body>
</html>
