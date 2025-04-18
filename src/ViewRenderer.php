<?php

namespace Rohmat\CrudTest;

class ViewRenderer
{
    public function __construct(
        private string $viewsPath = __DIR__ . '/../views/',
    ) {}

    public function render(string $view, array $data = [])
    {
        $viewFile = $this->viewsPath . $view . '.php';

        if (!file_exists($viewFile)) {
            throw new \Exception("View file not found: $viewFile");
        }

        extract([...$data, 'errors' => FlashMessage::get('errors')]);
        include $viewFile;
    }
}
