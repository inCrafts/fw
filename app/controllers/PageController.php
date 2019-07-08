<?php


namespace app\controllers;

/**
 * Class PageController  Описание страницы
 * @package app\controllers
 */
class PageController extends AppController {

    public function viewAction() {

        debug( $this->route );
        debug($_GET);
        echo 'Page::view';
    }
}