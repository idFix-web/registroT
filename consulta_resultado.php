<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener el nombre del formulario
$nombre = $_POST["nombre"] ?? '';

// Inicializar el mensaje
$mensaje = "";

// Verificar si el nombre está vacío
if (!empty($nombre)) {
    // Consultar la base de datos
    $sql = "SELECT * FROM usuarios WHERE nombre LIKE '%$nombre%'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);
    } else {
        $mensaje = "No se encontraron resultados";
        $usuarios = [];
    }
} else {
    $mensaje = "Por favor ingresa un nombre para consultar";
    $usuarios = [];
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Consulta</title>
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
        <h2>Resultados de la Consulta</h2>

        <?php if ($mensaje): ?>
            <div class="alert alert-info">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($usuarios)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido Materno</th>
                        <th>Apellido Paterno</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Código Postal</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>País</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>

                            <td><img src="data:image/jpeg;base64,<?php echo base64_encode($usuario['foto']); ?>" alt="Foto" style="width: 100px; height: auto;"></td>
                            <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['apellido_materno']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['apellido_paterno']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['telefono']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['correo']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['direccion']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['codigo_postal']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['ciudad']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['estado']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['pais']); ?></td>
                            </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- Botón para realizar otra búsqueda -->
        <a href="consulta.php" class="btn btn-secondary mt-3">Realizar otra búsqueda</a>

        <!-- Botón para descargar en Excel -->
        <?php if (!empty($usuarios)): ?>
            <a href="descargar_excel.php?nombre=<?php echo urlencode($nombre); ?>" class="btn btn-success mt-3">Descargar en Excel</a>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
