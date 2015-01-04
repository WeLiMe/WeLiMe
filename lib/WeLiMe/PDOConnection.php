<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 2:42 AM
 */

namespace WeLiMe;

use PDO;

class PDOConnection
{
    /**
     * Returns the *PDOConnection* instance of this class.
     *
     * @staticvar PDOConnection $instance The *PDOConnection* instances of this class.
     *
     * @return PDO The *PDOConnection* instance.
     */
    public static function getConnection()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new PDO('mysql:host=localhost;dbname=3270_3277_3269_3312_3441;charset=utf8', 'root', '');
            $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        return $instance;
    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * *PDOConnection* via the `new` operator from outside of this class.
     */
    private function __construct()
    {
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *PDOConnection* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }
}
