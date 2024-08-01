<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta por Nombre</title>
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
        <h2>Consulta por Nombre</h2>
        <form method="post" action="consulta_resultado.php">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre(s)</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <button type="submit" class="btn btn-primary">Consultar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
