<?php
class Conexion {
    private static $host = "localhost";
    private static $dbname = "eval04";
    private static $user = "root";
    private static $password = "";
    private static $conexion = null;

    public static function getConexion() {
        if (self::$conexion === null) {
            try {
                self::$conexion = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . 
                    self::$dbname . ";charset=utf8",
                    self::$user,
                    self::$password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                    ]
                );
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conexion;
    }
}