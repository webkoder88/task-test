<?php


namespace App\Models;


class Router
{
    private $routes;

    /**
     * Router constructor.
     * @param $routes_path
     */
    public function __construct($routes_path)
    {
        $this->routes = include($routes_path);
    }

    /**
     * @return string
     */
    public function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }

        if (!empty($_SERVER['PATH_INFO'])) {
            return trim($_SERVER['PATH_INFO'], '/');
        }

        if (!empty($_SERVER['QUERY_STRING'])) {
            return trim($_SERVER['QUERY_STRING'], '/');
        }

        return  '';
    }

    /**
     *
     */
    public function run()
    {

        $uri = $this->getURI();

        foreach ($this->routes as $pattern => $route) {

            if (preg_match("~$pattern~", $uri)) {

                $internal_route = preg_replace("~$pattern~", $route, $uri);
                $segments = explode('/', $internal_route);

                /** Controller */
                $controller = ucfirst(array_shift($segments)) . 'Controller';

                /** Controller action */
                $action = 'action' . ucfirst(array_shift($segments));

                /** Other params */
                $parameters = $segments;

                /** Check controller exist */
                $controller_class = "App\\Controller\\".$controller;


                if (!class_exists($controller_class) || !is_callable([$controller_class, $action])) {
                    header("Location: /404");
                    return;
                }

                /** Run controller with params */
                call_user_func_array([new $controller_class(), $action], $parameters);
                return;
            }
        }

        // Ничего не применилось. 404.
        header("Location: /404");
        return;
    }
}
