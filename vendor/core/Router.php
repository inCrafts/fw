<?php


class Router {

//    public function __construct() {
//
//        echo 'Привет!';
//
//    }

    protected static $routes = [];      // таблица маршрутов
    protected static $route = [];       // текущий маршрут
    // добавляет маршрут в таблицу в случае совпадения по регурярному выражэеннию выражению в виде ключа
    public static function add( $regexp, $route = [] ) {
        self::$routes[$regexp] = $route;
    }
    // распечатка таблицы маршрутов
    public static function getRoutes() {
        return self::$routes;
    }
    // распечатка текущего маршрута
    public static function getRoute() {
        return self::$route;
    }
    //  ищет совпадение с запросом в таблице маршрутов
    public static function matchRoute( $url ) {

        foreach( self::$routes as $pattern => $route ) {
            if ( $url === $pattern ) {
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
}