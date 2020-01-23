<?php
namespace src;

class Controller
{
    protected $template = null;

    public function render($view, $options = [])
    {
        $viewInstance = new View();
        $viewInstance->template = $this->template;
        $className = get_called_class();
        $viewDirectory = strtolower(str_replace('Controller', '', str_replace('src\Controllers\\', '', $className)));
        return $viewInstance->render($view, $viewDirectory, $options);
    }
}
