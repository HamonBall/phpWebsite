<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($game['title']) ?> - Game Details</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<div class="container">
    <?php if (isset($_SESSION['user_id'])): ?>
        <p style="text-align:right;"><a href="/logout">Logout</a></p>
    <?php endif; ?>
    <h1><?= $localization->get('game_details') ?>: <?= htmlspecialchars($game['title']) ?></h1>
    <?php if (!empty($game['image'])): ?>
        <img src="/images/games/<?= htmlspecialchars($game['image']) ?>" alt="<?= htmlspecialchars($game['title']) ?>" style="max-width:200px;display:block;margin-bottom:12px;">
    <?php endif; ?>
    <p><strong><?= $localization->get('developer') ?>:</strong> <?= htmlspecialchars($game['developer']) ?></p>
    <p><strong><?= $localization->get('release_year') ?>:</strong> <?= htmlspecialchars($game['release_year']) ?></p>
    <p><strong><?= $localization->get('description') ?>:</strong><br><?= nl2br(htmlspecialchars($game['description'])) ?></p>
    <hr>
    <h2><?= $localization->get('reviews') ?></h2>
    <?php
    // Load reviews for this game
    $reviewModel = new \App\Models\Review();
    $reviews = $reviewModel->getByGame($game['id']);
    ?>
    <?php if (!empty($reviews)): ?>
        <ul>
            <?php foreach ($reviews as $review): ?>
                <li>
                    <strong><?= htmlspecialchars($review['username']) ?></strong>:
                    <?= $localization->get('rating') ?>: <?= htmlspecialchars($review['rating']) ?>/10<br>
                    <?= nl2br(htmlspecialchars($review['comment'])) ?><br>
                    <small><?= htmlspecialchars($review['created_at']) ?></small>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $review['user_id']): ?>
                        | <a href="/reviews/edit/<?= urlencode($review['id']) ?>"><?= $localization->get('edit') ?></a>
                        | <form action="/reviews/delete/<?= urlencode($review['id']) ?>" method="post" style="display:inline;">
                            <button type="submit" onclick="return confirm('<?= $localization->get('delete_review_confirm') ?>');"><?= $localization->get('delete') ?></button>
                          </form>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p><?= $localization->get('no_reviews') ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['user_id'])): ?>
        <p><a href="/reviews/add/<?= urlencode($game['id']) ?>"><?= $localization->get('add_review') ?></a></p>
    <?php else: ?>
        <p><a href="/login"><?= $localization->get('login_to_review') ?></a></p>
    <?php endif; ?>
    <a href="/" class="back-btn">&larr; <?= $localization->get('back_to_library') ?></a>
</div>
</body>
</html>
