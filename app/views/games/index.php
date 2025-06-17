<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Library</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<div class="container">
    <h1><?= $localization->get('welcome') ?> | Game Library by Ulykbek</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
        <p style="text-align:right;"><a href="/logout"><?= $localization->get('logout') ?></a></p>
    <?php endif; ?>
    <div style="text-align:right; margin-bottom: 16px;">
        <a href="?lang=en" class="back-btn" style="margin-right:8px;">English</a>
        <a href="?lang=ru" class="back-btn">Русский</a>
    </div>
    <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>
        <p><a href="/games/add" class="back-btn" style="margin-bottom:24px;">+ <?= $localization->get('submit') ?> Game</a></p>
    <?php endif; ?>
    <ul>
        <?php if (!empty($games)): ?>
            <?php foreach ($games as $game): ?>
                <li>
                    <?php if (!empty($game['image'])): ?>
                        <img src="/images/games/<?= htmlspecialchars($game['image']) ?>" alt="<?= htmlspecialchars($game['title']) ?>">
                    <?php endif; ?>
                    <div>
                        <strong><?= htmlspecialchars($game['title']) ?></strong>
                        (<?= htmlspecialchars($game['release_year']) ?>)
                        <br>
                        <?= nl2br(htmlspecialchars($game['description'])) ?>
                        <br>
                        <a href="/games/show/<?= urlencode($game['id']) ?>">View details</a>
                        <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>
                            | <a href="/games/edit/<?= urlencode($game['id']) ?>">Edit</a>
                            | <form action="/games/delete/<?= urlencode($game['id']) ?>" method="post" style="display:inline;">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this game?');">Delete</button>
                              </form>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No games found.</li>
        <?php endif; ?>
    </ul>
</div>
</body>
</html>
