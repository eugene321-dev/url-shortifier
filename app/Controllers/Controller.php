<?php

namespace Controllers;

class Controller
{

    protected ?string $viewsDir = null;

    public function __construct(array $config){
        $this->viewsDir = $config['views_dir'];
    }

    protected function render(string $view, array $data = []){
        $viewFile = $this->viewsDir . '/' . $view . '.php';
        if (file_exists($viewFile)) {
            extract($data);
            require $viewFile;
        } else {
            throw new \Exception('View file not found: ' . $viewFile);
        }
    }

}
