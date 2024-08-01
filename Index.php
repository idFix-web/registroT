<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Inicializar variables para mensajes
$mensaje = "";
$tipo_mensaje = "";

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido_materno = $_POST["apellidoMaterno"];
    $apellido_paterno = $_POST["apellidoPaterno"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $direccion = $_POST["direccion"];
    $codigo_postal = $_POST["codigoPostal"];
    $ciudad = $_POST["ciudad"];
    $estado = $_POST["estado"];

    // Manejar la subida de la foto
    $foto = $_FILES["foto"]["tmp_name"];
    $foto_contenido = addslashes(file_get_contents($foto));

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellido_materno, apellido_paterno, telefono, correo, direccion, codigo_postal, ciudad, estado, pais, foto)
            VALUES ('$nombre', '$apellido_materno', '$apellido_paterno', '$telefono', '$correo', '$direccion', '$codigo_postal', '$ciudad', '$estado', 'México', '$foto_contenido')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Registro exitoso";
        $tipo_mensaje = "success";
    } else {
        $mensaje = "Error: " . $sql . "<br>" . $conn->error;
        $tipo_mensaje = "error";
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script>
        // Mostrar mensaje de alerta si existe
        window.onload = function() {
            var mensaje = "<?php echo $mensaje; ?>";
            var tipo_mensaje = "<?php echo $tipo_mensaje; ?>";
            if (mensaje) {
                if (tipo_mensaje === "success") {
                    alert(mensaje);
                } else if (tipo_mensaje === "error") {
                    alert("Error: " + mensaje);
                }
            }
        }
    </script>
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
                        <a class="nav-link" href="eliminar_registros.php">Eliminar Registos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Formulario de Registro</h2>
        <form id="registroForm" enctype="multipart/form-data" method="post" action="">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre(s)</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
                <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" required>
            </div>
            <div class="mb-3">
                <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
                <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Número de Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="mb-3">
                <label for="codigoPostal" class="form-label">Código Postal</label>
                <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" required>
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <select class="form-select" id="ciudad" name="ciudad" required>
                    <option value="">Selecciona una ciudad</option>
                    <option value="Tampico">Tampico</option>
                    <option value="Altamira">Altamira</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado" required>
                    <option value="">Selecciona un estado</option>
                    <option value="AGS">Aguascalientes</option>
                    <option value="BC">Baja California</option>
                    <option value="BCS">Baja California Sur</option>
                    <option value="CAMP">Campeche</option>
                    <option value="COAH">Coahuila</option>
                    <option value="COL">Colima</option>
                    <option value="CHP">Chiapas</option>
                    <option value="CHH">Chihuahua</option>
                    <option value="CDMX">Ciudad de México</option>
                    <option value="DUR">Durango</option>
                    <option value="EDOMEX">Estado de México</option>
                    <option value="GUA">Guanajuato</option>
                    <option value="GRO">Guerrero</option>
                    <option value="HID">Hidalgo</option>
                    <option value="JAL">Jalisco</option>
                    <option value="MIC">Michoacán</option>
                    <option value="MOR">Morelos</option>
                    <option value="NAY">Nayarit</option>
                    <option value="NL">Nuevo León</option>
                    <option value="OAX">Oaxaca</option>
                    <option value="PUE">Puebla</option>
                    <option value="QRO">Querétaro</option>
                    <option value="ROO">Quintana Roo</option>
                    <option value="SLP">San Luis Potosí</option>
                    <option value="SIN">Sinaloa</option>
                    <option value="SON">Sonora</option>
                    <option value="TAB">Tabasco</option>
                    <option value="TAM">Tamaulipas</option>
                    <option value="TLAX">Tlaxcala</option>
                    <option value="VER">Veracruz</option>
                    <option value="YUC">Yucatán</option>
                    <option value="ZAC">Zacatecas</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="pais" class="form-label">País</label>
                <input type="text" class="form-control" id="pais" value="México" disabled>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Subir Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
