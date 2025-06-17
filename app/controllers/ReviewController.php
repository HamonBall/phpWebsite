<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Review;

class ReviewController extends Controller {
    public function add($gameId) {
        global $localization;
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rating = $_POST['rating'] ?? 5;
            $comment = $_POST['comment'] ?? '';
            $userId = $_SESSION['user_id'];
            $reviewModel = new Review();
            $reviewModel->create($userId, $gameId, $rating, $comment);
            header('Location: /games/show/' . urlencode($gameId));
            exit;
        }
        $this->view('reviews/add', ['game_id' => $gameId, 'localization' => $localization]);
    }

    public function edit($id) {
        $this->requireLogin();
        $reviewModel = new Review();
        $review = $reviewModel->find($id);
        if (!$review || $review['user_id'] != $_SESSION['user_id']) {
            http_response_code(403);
            echo 'Forbidden';
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rating = $_POST['rating'] ?? 5;
            $comment = $_POST['comment'] ?? '';
            $reviewModel->update($id, $rating, $comment);
            header('Location: /games/show/' . urlencode($review['game_id']));
            exit;
        }
        $this->view('reviews/edit', ['review' => $review]);
    }

    public function delete($id) {
        $this->requireLogin();
        $reviewModel = new Review();
        $review = $reviewModel->find($id);
        if ($review && $review['user_id'] == $_SESSION['user_id']) {
            $reviewModel->delete($id);
            header('Location: /games/show/' . urlencode($review['game_id']));
            exit;
        }
        http_response_code(403);
        echo 'Forbidden';
        exit;
    }
}
