<?php
namespace App\Core;

class Controller {
    public function view($view, $data = []) {
        extract($data);
        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    // Check if user is logged in
    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Get current user's role_id
    protected function getRoleId() {
        return $_SESSION['role_id'] ?? null;
    }

    // Check if user has a specific role (by name)
    protected function hasRole($roleName) {
        if (!isset($_SESSION['role_id'])) return false;
        // Simple role check: 1 = admin, 2 = user
        if ($roleName === 'admin' && $_SESSION['role_id'] == 1) return true;
        if ($roleName === 'user' && $_SESSION['role_id'] == 2) return true;
        return false;
    }

    // Require login (redirect if not logged in)
    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            header('Location: /login');
            exit;
        }
    }

    // Require specific role (redirect if not allowed)
    protected function requireRole($roleName) {
        if (!$this->hasRole($roleName)) {
            header('HTTP/1.1 403 Forbidden');
            echo '403 Forbidden';
            exit;
        }
    }
}
