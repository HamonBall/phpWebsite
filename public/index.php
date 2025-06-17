<?php
// UTF-8 encoding
header('Content-Type: text/html; charset=utf-8');

// Composer autoload (if used)
// require_once __DIR__ . '/../vendor/autoload.php';

// Simple autoloader for app classes
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Load config
$config = require __DIR__ . '/../config/config.php';

// Initialize DB connection
use App\Core\Database;
$db = Database::connect($config['db']);

// Start session
session_start();

// Language switcher logic
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'ru'])) {
    $_SESSION['lang'] = $_GET['lang'];
    // Redirect to remove lang param from URL
    $redirect = strtok($_SERVER['REQUEST_URI'], '?');
    header('Location: ' . $redirect);
    exit;
}
$lang = $_SESSION['lang'] ?? 'en';

// Initialize Localization
use App\Core\Localization;
$localization = new Localization($lang);

// Initialize router
use App\Core\Router;
$router = new Router();

// Define routes (example)
$router->add('/', 'GameController@index');
$router->add('/login', 'AuthController@login');
$router->add('/logout', 'AuthController@logout');
$router->add('/register', 'AuthController@register');
// Dynamic routes for games
$router->add('/games/show/{id}', 'GameController@show');
$router->add('/games/edit/{id}', 'GameController@edit');
$router->add('/games/delete/{id}', 'GameController@delete');
$router->add('/games/update/{id}', 'GameController@update');
$router->add('/games/add', 'GameController@add');
$router->add('/games/store', 'GameController@store');
// Dynamic routes for reviews
$router->add('/reviews/add/{gameId}', 'ReviewController@add');
$router->add('/reviews/edit/{id}', 'ReviewController@edit');
$router->add('/reviews/delete/{id}', 'ReviewController@delete');
// ...add more routes as needed

// Dispatch request
$uri = strtok($_SERVER['REQUEST_URI'], '?');
$router->dispatch($uri);
