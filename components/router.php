<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . DS . 'config' . DS . 'routes.php';
        $this->routes = include($routesPath);
    }

    // Метод возвращает строку запроса
    private function getUri()
    {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        //получаем строку запроса
        $uri = $this->getUri();

        //Проверить есть ли такой запрос в routes.php
        foreach ($this->routes as $uriPattern => $path){

            if(preg_match("~$uriPattern~", $uri)) {
                //Получаем внутренний путь из внешнего согласно правилу

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                //Определить какой контроллер и экшн обрабатывают запросю Определяем параметры

                $segment = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segment)) . 'Controller';
                $actionName = 'action' . ucfirst(array_shift($segment));
                $parameters = $segment;
                //Создать объект и вызвать метод

                $controllerObject = new $controllerName();

                //print_r($actionName);

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters); //параметры передаются как переменные
                //если контроллер и экшн найден, то выходим из цикла
                if($result != null) {
                    break;
                }
            }
        }


    }
}