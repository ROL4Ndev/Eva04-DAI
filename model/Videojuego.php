<?php
require_once __DIR__ . '/../connection/Conexion.php';
class Videojuego {
    public $id_videojuego;
    public $nombre;
    public $id_consola;
    public $precio_venta;
    public $stock;
    public $consola;

    public static function getAll() {
        $db = Conexion::getConexion();
        $sql = "SELECT v.id_videojuego, v.nombre, v.id_consola,
         v.precio_venta, v.stock, c.descripcion AS consola 
                FROM videojuegos v 
                INNER JOIN consolas c ON v.id_consola = c.id_consola 
                ORDER BY v.nombre ASC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Videojuego');
    }

    public static function searchByNombre($nombre) {
        $db = Conexion::getConexion();
        $sql = "SELECT v.id_videojuego, v.nombre, v.id_consola, 
        v.precio_venta, v.stock, c.descripcion AS consola 
                FROM videojuegos v 
                INNER JOIN consolas c ON v.id_consola = c.id_consola 
                WHERE v.nombre LIKE :nombre
                ORDER BY v.nombre ASC";
        $stmt = $db->prepare($sql);
        $stmt->execute(['nombre' => "%$nombre%"]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Videojuego');
    }

    public static function getById($id) {
        $db = Conexion::getConexion();
        $sql = "SELECT * FROM videojuegos WHERE id_videojuego = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject('Videojuego');
    }

    public function update() {
        $db = Conexion::getConexion();
        $sql = "UPDATE videojuegos 
                SET nombre = :nombre, id_consola = :id_consola, 
                precio_venta = :precio_venta, stock = :stock 
                WHERE id_videojuego = :id_videojuego";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':nombre' => $this->nombre,
            ':id_consola' => $this->id_consola,
            ':precio_venta' => $this->precio_venta,
            ':stock' => $this->stock,
            ':id_videojuego' => $this->id_videojuego
        ]);
    }
}
