<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Review</title>
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
    <h1><?= $localization->get('edit_review') ?></h1>
    <form method="post">
        <label><?= $localization->get('rating') ?>:
            <select name="rating">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?= $i ?>" <?= $review['rating'] == $i ? 'selected' : '' ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </label><br>
        <label><?= $localization->get('comment') ?>:<br><textarea name="comment" required><?= htmlspecialchars($review['comment']) ?></textarea></label><br>
        <button type="submit"><?= $localization->get('update_review') ?></button>
    </form>
    <a href="/games/show/<?= urlencode($review['game_id']) ?>" class="back-btn">&larr; <?= $localization->get('back_to_game') ?></a>
</body>
</html>
