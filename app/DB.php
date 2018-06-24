<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.06.18
 * Time: 13:24
 */

namespace App;

/**
 * Class DB
 *
 * @package App
 */
class DB extends \MysqliDb
{
    /**
     * DB constructor.
     */
    public function __construct()
    {
        $host = 'localhost';
        $port = null;
        $charset = 'utf8';
        $socket = null;
        $username = getenv('DB_USER');
        $password = getenv('DB_PASS');
        $db = getenv('DB_NAME');
        parent::__construct($host, $username, $password, $db, $port, $charset, $socket);
    }
}