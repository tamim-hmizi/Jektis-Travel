<?php
class Connexion
{
    private static $pdo = null;
    private static $host = 'localhost';
    private static $db = 'LetsTravel';
    private static $user = 'root';
    private static $pass = '';
    private static $charset = 'utf8mb4';

    private function __construct()
    {
    }

    public static function getPDO()
    {
        if (self::$pdo === null) {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                self::$pdo = new PDO($dsn, self::$user, self::$pass, $options);
            } catch (PDOException $e) {
                throw new Exception('Database connection error: ' . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
