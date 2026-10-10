<?php
require_once 'model/Videojuego.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nombre = trim($_POST['nombre'] ?? '');
    $id_consola = filter_input(INPUT_POST, 'id_consola', FILTER_VALIDATE_INT);
    $precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);

    if ($id && !empty($nombre) && $id_consola && $precio !== false && 
    $precio >= 10 && $stock !== false && $stock >= 1) {
        $videojuego = new Videojuego();
        $videojuego->id_videojuego = $id;
        $videojuego->nombre = $nombre;
        $videojuego->id_consola = $id_consola;
        $videojuego->precio_venta = $precio;
        $videojuego->stock = $stock;

        if ($videojuego->update()) {
            header("Location: index.php?mensaje=" . urlencode
            ("Videojuego actualizado correctamente."));
            exit();
        }
    }
}

header("Location: index.php");
exit();
?>