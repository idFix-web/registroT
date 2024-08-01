<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Inicializar variables para mensajes
$mensaje = "";
$tipo_mensaje = "";

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ids']) && !empty($_POST['ids'])) {
        // Obtener los IDs seleccionados
        $ids = $_POST['ids'];
        $idsString = implode(",", $ids);

        // Crear la consulta de eliminación
        $sql = "DELETE FROM usuarios WHERE id IN ($idsString)";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Registros eliminados exitosamente.";
            $tipo_mensaje = "success";
        } else {
            $mensaje = "Error al eliminar registros: " . $conn->error;
            $tipo_mensaje = "error";
        }
    } else {
        $mensaje = "No se seleccionaron registros para eliminar.";
        $tipo_mensaje = "warning";
    }
}

// Cerrar la conexión
$conn->close();

// Redirigir de nuevo al formulario con un mensaje de estado
header("Location: eliminar_registros.php?mensaje=$mensaje&tipo_mensaje=$tipo_mensaje");
exit();
?>
