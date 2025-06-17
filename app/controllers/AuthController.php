<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $userModel = new User();
            $user = $userModel->findByUsername($username);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role_id'] = $user['role_id'];
                header('Location: /');
                exit;
            } else {
                $error = 'Invalid username or password.';
            }
        }
        $this->view('auth/login', ['error' => $error ?? null]);
    }

    public function logout() {
        $this->requireLogin();
        session_destroy();
        header('Location: /login');
        exit;
    }

    public function register() {
        // Open registration: anyone can register
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $userModel = new User();
            if ($userModel->findByUsername($username)) {
                $error = 'Username already exists.';
            } else {
                $userModel->create($username, $password);
                header('Location: /login');
                exit;
            }
        }
        $this->view('auth/register', ['error' => $error ?? null]);
    }
}
