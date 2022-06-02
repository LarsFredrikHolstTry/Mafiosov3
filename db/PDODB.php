<?php

// include 'db.php';

$db_host = "localhost"; //localhost server 
$db_user = "root"; //database username
$db_password = ""; //database password   
$db_name = "mafiosov3"; //database name

define('DB_HOST', $db_host);
define('DB_NAME', $db_name);
define('DB_USER', $db_user);
define('DB_PASS', $db_password);
define('DB_CHAR', 'utf8');

/**
 *
 * Update database
 *
 * Visit link to see how to use this class
 *
 * @link    https://phpdelusions.net/pdo/pdo_wrapper
 * @author  phpdelusions
 *
 */
class DB
{
    protected static $instance = null;

    protected function __construct()
    {
    }
    protected function __clone()
    {
    }

    public static function instance()
    {
        if (self::$instance === null) {
            $opt  = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => FALSE,
            );
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR;
            self::$instance = new PDO($dsn, DB_USER, DB_PASS, $opt);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function run($sql, $args = [])
    {
        if (!$args) {
            return self::instance()->query($sql);
        }
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
