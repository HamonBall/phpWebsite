<?php
namespace App\Core;

use PDO;

class Model {
    protected $db;
    public function __construct($db) {
        $this->db = $db;
    }
}
