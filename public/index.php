<?php

use vendor\core\Router;

error_reporting(-1);

//echo $test;

$query = rtrim( $_SERVER['QUERY_STRING'], '/' );


define( 'WWW', __DIR__ );
define( 'CORE', dirname(__DIR__ ) . '/vendor/core' );
define( 'ROOT', dirname(__DIR__ ));
define( 'APP', dirname(__DIR__ ) . '/app' );

require_once '../vendor/libs/functions.php';
debug( $_GET);

spl_autoload_register( function( $class ) {
    $file = ROOT . '/' . str_replace('\\', '/', $class ) . '.php';
    if ( is_file( $file ) ) {
        require_once $file;
    }
});

//  User routes
Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

// Default routes
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');


debug(Router::getRoutes());

Router::dispatch( $query );

