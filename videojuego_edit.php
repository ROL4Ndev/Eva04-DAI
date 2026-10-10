<?php
require_once 'model/Videojuego.php';
require_once 'model/Consola.php';

$error = null;
$videojuego = null;
$consolas = Consola::getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $id = intval($_POST['id']);
    $videojuego = Videojuego::getById($id);
    if (!$videojuego) {
        $error = "El videojuego no existe.";
    }
} else {
    $error = "Acceso no válido. No se especificó el ID.";
}

require 'layout/header.php'; ?>
<h1 class="titulo mb-4">Editar Videojuego</h1>
<?php if ($error): ?><div class="alert alert-danger">
    <?= htmlspecialchars($error) ?></div><a href="index.php" 
    class="btn btn-secondary">Volver</a><?php else: ?>
    <div class="card">
        <div class="card-header text-center">
            <h2 class="h4 mb-0">Datos del videojuego</h2>
        </div>
        <div class="card-body">
            <form method="post" action="videojuego_update.php">
                <input type="hidden" name="id" value="
                <?= $videojuego->id_videojuego ?>">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" 
                    for="nombre">Nombre</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="nombre" 
                        name="nombre" value="
                        <?= htmlspecialchars($videojuego->nombre) ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="consola">Consola</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="consola" name="id_consola" required>
                            <option value="">Seleccione una consola</option>
                            <?php foreach ($consolas as $c): ?>
                                <option value="<?= $c->id_consola ?>" 
                                <?= $c->id_consola == $videojuego->id_consola ?
                                 'selected' : '' ?>>
                                    <?= htmlspecialchars($c->descripcion) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="precio">Precio</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" 
                        id="precio" name="precio" step="0.50" min="10" 
                        value="<?= $videojuego->precio_venta ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="stock">Stock</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" 
                        id="stock" name="stock" min="1" step="1" 
                        value="<?= $videojuego->stock ?>" required>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-outline-success" type="submit">Guardar</button>
                    <a class="btn btn-outline-danger" href="index.php">Cancelar</a>
                </div>
            </form>
        </div>
    </div><?php endif; ?>
<?php require 'layout/footer.php'; ?>