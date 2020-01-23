<?php
namespace src;

use Throwable;

class Route
{
    private $requestedRoute;

    public $defaulRoute = 'login/index';

    public function __construct()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $this->requestedRoute = preg_replace('/^' . preg_quote(str_replace('index.php', '', $scriptName), '/') . '/', '', $uri);
        $this->resolveRequest();
    }

    private function resolveRequest()
    {
        if ($this->requestedRoute == '') {
            $this->requestedRoute = $this->defaulRoute;
        }
        $defaultAction = 'index';
        $request = array_values(array_filter(explode('/', $this->requestedRoute)));
        if (count($request) < 2) {
            $request[1] = $defaultAction;
        }
        [$controller, $action] = $request;
        $action = 'action' . ucfirst($action);
        $controller = '\src\Controllers\\' . ucfirst($controller) . 'Controller';

        try {
            echo (new $controller)->{$action}();
        } catch(Throwable $e) {
            header("HTTP/1.0 404 Not Found");
            return;
        }
    }
}
