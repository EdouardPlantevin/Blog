<?php 

namespace App\Core;

use PDO;
use PDOException;

class Db extends PDO
{
    private static $instance;

    private const DBHOST = '127.0.0.1:3306';
    private const DBUSER = 'root';
    private const DBPASS = 'root';
    private const DBNAME= 'demo_poo';

    private function __construct()
    {
        $_dsn = 'mysql:host=' . self::DBHOST . ';dbname=' . self::DBNAME;

        try 
        {
            parent::__construct($_dsn, self::DBUSER, self::DBPASS);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e){}
    }

    public static function getInstance(): self
    {
        if(self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
}