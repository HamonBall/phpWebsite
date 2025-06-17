<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $localization->get('add_review') ?></title>
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
    <h1><?= $localization->get('add_review') ?></h1>
    <form method="post">
        <label><?= $localization->get('rating') ?>:
            <select name="rating">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </label><br>
        <label><?= $localization->get('comment') ?>:<br><textarea name="comment" required></textarea></label><br>
        <button type="submit"><?= $localization->get('submit_review') ?></button>
    </form>
    <a href="/games/show/<?= urlencode($game_id) ?>" class="back-btn">&larr; <?= $localization->get('back_to_game') ?></a>
</body>
</html>
