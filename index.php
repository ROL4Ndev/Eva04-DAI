<?php
require_once 'model/Videojuego.php';

$error = null;
$mensaje = $_GET['mensaje'] ?? '';
$termino = '';
$videojuegos = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
    $termino = trim($_POST['nombre'] ?? '');
    if (empty($termino)) {
        $error = "El nombre es obligatorio para realizar la búsqueda.";
        $videojuegos = Videojuego::getAll();
    } else {
        $videojuegos = Videojuego::searchByNombre($termino);
    }
} else {
    $videojuegos = Videojuego::getAll();
}

require 'layout/header.php'; ?>
<h1 class="titulo mb-4">Videojuegos</h1>
<?php if ($mensaje !== ''): ?><div class="alert alert-info">
  <?= htmlspecialchars($mensaje) ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert alert-danger">
  <?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post" action="index.php" class="bg-light p-3 rounded mb-3">
  <div class="row g-2">
    <div class="col-md-4">
      <label for="nombre" class="visually-hidden">Nombre del videojuego</label>
      <input class="form-control" id="nombre" name="nombre" value="
      <?= htmlspecialchars($termino) ?>" placeholder="Buscar por nombre">
    </div>
    <div class="col-auto"><button class="btn btn-success"
     name="buscar" value="1">Buscar</button></div>
    <div class="col-auto"><a class="btn btn-outline-secondary" 
    href="index.php">Limpiar</a></div>
  </div>
</form>
<div class="table-responsive">
  <table class="table table-striped align-middle">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Consola</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($videojuegos)): ?>
        <?php foreach ($videojuegos as $v): ?>
          <tr>
            <td><?= htmlspecialchars($v->nombre) ?></td>
            <td><?= htmlspecialchars($v->consola) ?></td>
            <td><?= number_format($v->precio_venta, 2) ?></td>
            <td><?= htmlspecialchars($v->stock) ?></td>
            <td>
              <form method="post" action="videojuego_edit.php" style="display:inline;">
                <input type="hidden" name="id" value="<?= $v->id_videojuego ?>">
                <button type="submit" class="btn btn-outline-success btn-sm">Editar</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="5" class="text-center text-muted">No se encontraron registros.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<?php require 'layout/footer.php'; ?>