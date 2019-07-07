<?php

$query = rtrim( $_SERVER['QUERY_STRING'], '/' );


define( 'WWW', __DIR__ );
define( 'CORE', dirname(__DIR__ ) . '/vendor/core');
define( 'ROOT', dirname(__DIR__ ));
define( 'APP', dirname(__DIR__ ) . '/app');

require_once '../vendor/core/Router.php';
require_once '../vendor/libs/functions.php';

//  User routes
Router::add('^pages/?(?P<action>[a-z-]+)?$', ['controller' => 'Posts', 'action' => 'index']);

// Default routes
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

spl_autoload_register( function( $class ) {
    $file = APP . "/controllers/$class.php";
    if ( is_file( $file ) ) {
        require_once $file;
    }
});


debug(Router::getRoutes());

Router::dispatch( $query );