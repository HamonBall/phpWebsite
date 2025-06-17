<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Database;

class User extends Model {
    public function __construct() {
        $config = require __DIR__ . '/../../config/config.php';
        $db = Database::connect($config['db']);
        parent::__construct($db);
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($username, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $roleId = 2; // default to 'user' role
        $stmt = $this->db->prepare('INSERT INTO users (username, password, role_id) VALUES (?, ?, ?)');
        return $stmt->execute([$username, $hash, $roleId]);
    }
}
