<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si hay un mensaje en la URL
$mensaje = $_GET['mensaje'] ?? '';
$tipo_mensaje = $_GET['tipo_mensaje'] ?? '';

// Consultar la base de datos para obtener todos los usuarios
$sql = "SELECT * FROM usuarios";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Registros</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
          <a class="navbar-brand" href="index.php">
              <img src="images/tampico.png" alt="Escudo de Tampico" width="30" height="30" class="d-inline-block align-text-top">
              Tampico
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="Index.php">Registro</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="consulta.php">Consulta</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="eliminar_registros.php">Eliminar Registros</a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
    <div class="container mt-5">
        <h2>Eliminar Registros</h2>
        <?php if ($mensaje): ?>
            <div class="alert alert-<?php echo $tipo_mensaje === 'success' ? 'success' : ($tipo_mensaje === 'error' ? 'danger' : 'warning'); ?>" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        <form id="eliminarForm" method="post" action="procesar_eliminacion.php">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido Materno</th>
                        <th>Apellido Paterno</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($usuario = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?php echo $usuario['id']; ?>"></td>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo $usuario['nombre']; ?></td>
                            <td><?php echo $usuario['apellido_materno']; ?></td>
                            <td><?php echo $usuario['apellido_paterno']; ?></td>
                            <td><?php echo $usuario['telefono']; ?></td>
                            <td><?php echo $usuario['correo']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-danger">Eliminar Seleccionados</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
