<?php
namespace App\Core;

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data); // Convert array keys to variables

        $file = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            die("Error: View file not found - {$file}");
        }
    }
}
