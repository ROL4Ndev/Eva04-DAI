<?php
require_once __DIR__ . '/../connection/Conexion.php';

class Consola {
    public $id_consola;
    public $descripcion;

    public static function getAll() {
        $db = Conexion::getConexion();
        $stmt = $db->query("SELECT id_consola, descripcion FROM 
        consolas ORDER BY descripcion ASC");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Consola');
    }
}