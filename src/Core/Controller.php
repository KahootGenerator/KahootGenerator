<?php

namespace App\Core;

abstract class Controller
{

    private string $pageTitle = "Kahoot Generator";

    public function getPageTitle(): string
    {
        return $this->pageTitle;
    }

    public function setPageTitle($pageTitle): void
    {
        $this->pageTitle = $pageTitle;
    }

    public function loadModelManager(string $model)
    {
        $modelManagerPath = "App\Database\Managers\\$model";

        return new $modelManagerPath;
    }

    public function render(string $path, array $data = []): void
    {
        if (!isset($data['title'])) {
            $data['title'] = $this->getPageTitle();
        }

        extract($data);

        ob_start();

        require "../src/Views/$path.php";

        $content = ob_get_clean();

        require_once '../src/Views/layout/layout.php';
    }
}
