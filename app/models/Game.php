<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Database;

class Game extends Model {
    public function __construct() {
        $config = require __DIR__ . '/../../config/config.php';
        $db = Database::connect($config['db']);
        parent::__construct($db);
    }

    public function getAll() {
        $stmt = $this->db->query('SELECT * FROM games ORDER BY created_at DESC');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create($title, $description, $release_year, $developer) {
        $stmt = $this->db->prepare('INSERT INTO games (title, description, release_year, developer) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$title, $description, $release_year, $developer]);
    }

    public function find($id) {
        $stmt = $this->db->prepare('SELECT * FROM games WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $description, $release_year, $developer) {
        $stmt = $this->db->prepare('UPDATE games SET title = ?, description = ?, release_year = ?, developer = ? WHERE id = ?');
        return $stmt->execute([$title, $description, $release_year, $developer, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare('DELETE FROM games WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
