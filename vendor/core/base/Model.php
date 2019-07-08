<?php


namespace vendor\core\base;

use vendor\core\Db;

/**
 * Class Model
 * @package vendor\core\base
 */
abstract class Model {

    /**
     *  Данные подклчения
     * @var
     */
    protected $pdo;

    /**
     *  Таблица для работы модели
     * @var
     */
    protected $table;

    public function __construct() {

        $this->pdo = Db::instance();
    }

    public function query( $sql ) {

        return $this->pdo->execute( $sql );
    }

    public function findAll() {

        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query( $sql );

    }

}