<?php

namespace vendor\core;

/**
 * Class Router  Маршрутизатор
 */
class Router {

    /**
     *   Таблица маршрутов
     * @var array
     */
    protected static $routes = [];
    /**
     *   Текущий маршрут
     * @var array
     */
    protected static $route = [];

    /**
     *   Добавляет текущий маршрут в таблицу маршрутов
     * @param string $regexp Регулярное выражение маршрута
     * @param array $route Маршрут ([controller, action, params])
     */
    public static function add( $regexp, $route = [] ) {
        self::$routes[$regexp] = $route;
    }

    /**
     * Возвращает таблицу маршрутов
     * @return array
     */
    public static function getRoutes() {
        return self::$routes;
    }

    /**
     * Возвращает текущий маршрут ([controller, action, params])
     * @return array
     */
    public static function getRoute() {
        return self::$route;
    }

    /**
     *   Botn URL в таблице маршрутов
     * @param string $url Входящий маршрут
     * @return bool
     */
    public static function matchRoute( $url ) {

        foreach( self::$routes as $pattern => $route ) {
            if ( preg_match( "#$pattern#i", $url, $matches )) {
                foreach ( $matches as $key => $val ) {
                    if ( is_string( $key )) {
                        $route[$key] = $val;
                    }
                }
                if ( !isset( $route['action'] )) {
                    $route['action'] = 'index';
                }
                $route['controler'] = self::upperCamelCase( $route['controller'] );
                self::$route = $route;
                // debug( $route );
                return true;
            }
        }
        return false;
    }

    /**
     *  Перенаправляет URL по корректному маршруту
     * @param string $url Входящий URL
     * return void
     */
    public static function dispatch( $url ) {
        $url = self::removeQueryString($url);
        if ( self::matchRoute( $url )) {
            $controller = 'app\controllers\\' . self::upperCamelCase( self::$route['controller'] . 'Controller' );
            if ( class_exists( $controller )) {
                $cObj = new $controller( self::$route );

                $action = self::lowerCamelCase( self::$route['action'] ) . 'Action';
                if ( method_exists( $cObj, $action ) ) {
                    $cObj->$action();
                    $cObj->getView();
                } else {
                    echo "Метод <b>$controller::$action</b> не найден.";
                }
            } else {
                echo "Контроллер <b>$controller</b> не найден.";
            }
        } else {
            http_response_code( 404 );
            include '404.html';
        }
    }

    /**
     *  Приведит строку к верблюжьей нотации
     * @param $name Строка
     * @return измененная строка
     */
    protected static function upperCamelCase( $name ) {
        return str_replace(' ', '', ucwords( str_replace('-', ' ', $name )));
    }

    protected static function lowerCamelCase( $name ) {
        return lcfirst( self::upperCamelCase( $name ));
    }
    
    protected static function removeQueryString( $url ) {
        if ( $url ) {
            $params = explode( '&', $url, 2 );
            if ( false === strpos( $params[0], '=' )) {
                return rtrim( $params[0],'/' );
            } else {
                return '';
            }
        }
        
    }
}