<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Game;

class GameController extends Controller {
    public function index() {
        global $localization;
        $gameModel = new Game();
        $games = $gameModel->getAll();
        $this->view('games/index', ['games' => $games, 'localization' => $localization]);
    }

    // Only admin can access
    public function manage() {
        $this->requireLogin();
        $this->requireRole('admin');
        // ...admin management logic here...
        $this->view('games/manage');
    }

    // Only admin can add a game (show form)
    public function add() {
        $this->requireLogin();
        $this->requireRole('admin');
        $this->view('games/add');
    }

    // Only admin can store a new game (handle form submission)
    public function store() {
        $this->requireLogin();
        $this->requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $release_year = $_POST['release_year'] ?? null;
            $developer = $_POST['developer'] ?? '';
            $gameModel = new Game();
            $gameModel->create($title, $description, $release_year, $developer);
            header('Location: /');
            exit;
        }
        header('Location: /games/add');
        exit;
    }

    // Only admin can edit a game (show form)
    public function edit($id) {
        $this->requireLogin();
        $this->requireRole('admin');
        $gameModel = new Game();
        $game = $gameModel->find($id);
        if (!$game) {
            http_response_code(404);
            echo 'Game not found';
            exit;
        }
        $this->view('games/edit', ['game' => $game]);
    }

    // Only admin can update a game (handle form submission)
    public function update($id) {
        $this->requireLogin();
        $this->requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $release_year = $_POST['release_year'] ?? null;
            $developer = $_POST['developer'] ?? '';
            $gameModel = new Game();
            $gameModel->update($id, $title, $description, $release_year, $developer);
            header('Location: /games/show/' . urlencode($id));
            exit;
        }
        header('Location: /games/edit/' . urlencode($id));
        exit;
    }

    // Only admin can delete a game
    public function delete($id) {
        $this->requireLogin();
        $this->requireRole('admin');
        $gameModel = new Game();
        $gameModel->delete($id);
        header('Location: /');
        exit;
    }

    // Only logged-in users can add a game to their library
    public function addToLibrary($gameId) {
        $this->requireLogin();
        // ...add to library logic...
    }

    // Only logged-in users can add a review
    public function addReview($gameId) {
        $this->requireLogin();
        // ...add review logic...
    }

    // Show details of a single game
    public function show($id) {
        global $localization;
        $gameModel = new Game();
        $game = $gameModel->find($id);
        if (!$game) {
            http_response_code(404);
            echo 'Game not found';
            exit;
        }
        $this->view('games/show', ['game' => $game, 'localization' => $localization]);
    }
}
