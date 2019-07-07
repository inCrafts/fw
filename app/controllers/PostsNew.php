<?php

namespace app\controllers;


class PostsNew extends \vendor\core\base\Controller {

    public function indexAction() {

        echo 'PostsNew::index';
    }

    public function testAction() {

        echo 'PostsNew::test';
    }

    public function testPageAction() {

        echo 'PostsNew::testPage';
    }

    public function before() {

        echo 'PostsNew::before';

    }
}