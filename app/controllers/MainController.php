<?php

namespace app\controllers;

use app\models\Main;

/**
 * Class MainController
 * @package app\controllers
 */
class MainController extends AppController {

    public $layout = 'default';

    public function indexAction() {
      // $this->layout = false;       // Для отключения шаблона

        $model = new Main();
//        $res = $model->query( "CREATE TABLE posts");
        $posts = $model->findAll();
        $posts2 = $model->findAll();
        $title = 'Main layout';
        $this->set( compact('title', 'posts' ));
    }
}