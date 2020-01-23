<?php
namespace src;

use Exception;

class View
{
    const PATH_VIEWS = __DIR__ . DIRECTORY_SEPARATOR . 'Views';
    const DEFAULT_TEMPLATE = self::PATH_VIEWS . DIRECTORY_SEPARATOR . 'templates/main.php';

    public $template;
    public $title;

    public function render(string $file, string $viewDirectory, array $options)
    {
        $file = $file . '.php';
        if (empty($this->searchFile($file, $viewDirectory))) {
            throw new Exception('View not found');
        }

        ob_start();
        if (!empty($options)) {
            extract($options);
        }
        include self::PATH_VIEWS . DIRECTORY_SEPARATOR . $viewDirectory . DIRECTORY_SEPARATOR . $file;
        $content = ob_get_clean();

        ob_start();
        if ($this->template !== null) {
            // render template
        } else {
            require_once self::DEFAULT_TEMPLATE;
        }
        return ob_get_clean();
    }

    private function searchFile(string $file, string $viewDirectory) : ?string
    {
        $path = self::PATH_VIEWS . DIRECTORY_SEPARATOR . $viewDirectory;
        $files = scandir(self::PATH_VIEWS . DIRECTORY_SEPARATOR . $viewDirectory);
        return in_array($file, $files) ? $path : null;
    }
}
