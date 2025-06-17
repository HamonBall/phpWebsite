<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Database;

class Review extends Model {
    public function __construct() {
        $config = require __DIR__ . '/../../config/config.php';
        $db = Database::connect($config['db']);
        parent::__construct($db);
    }

    public function getByGame($gameId) {
        $stmt = $this->db->prepare('SELECT r.*, u.username FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.game_id = ? ORDER BY r.created_at DESC');
        $stmt->execute([$gameId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare('SELECT * FROM reviews WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($userId, $gameId, $rating, $comment) {
        $stmt = $this->db->prepare('INSERT INTO reviews (user_id, game_id, rating, comment) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$userId, $gameId, $rating, $comment]);
    }

    public function update($id, $rating, $comment) {
        $stmt = $this->db->prepare('UPDATE reviews SET rating = ?, comment = ? WHERE id = ?');
        return $stmt->execute([$rating, $comment, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare('DELETE FROM reviews WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
