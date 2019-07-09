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
        $posts = $model->findAll();
//        $posts2 = $model->findAll();
//        $post = $model->findOne('Рыбный текст', 'title' );
//        $data = $model->findBySql("SELECT * FROM posts ORDER BY id DESC LIMIT 2");
//        $data = $model->findBySql("SELECT * FROM {$model->table} WHERE title LIKE ?", ['%во%']);
        $data = $model->findLike('ыб', 'title');
        debug($data);
//        debug($post);
        $title = 'Main layout';
        $this->set( compact('title', 'posts' ));
    }
}