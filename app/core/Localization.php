<?php
namespace App\Core;

class Localization {
    private $lang;
    private $translations = [];
    public function __construct($lang = 'en') {
        $this->lang = $lang;
        $file = __DIR__ . '/../lang/' . $lang . '.php';
        if (file_exists($file)) {
            $this->translations = include $file;
        }
    }
    public function get($key) {
        return $this->translations[$key] ?? $key;
    }
}
