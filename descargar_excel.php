<?php
require 'lib/vendor/autoload.php'; // Incluir el autoloader de Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Incluir el archivo de conexión
include 'conexion.php';

// Obtener el nombre del formulario
$nombre = $_GET["nombre"] ?? '';

// Consultar la base de datos
$sql = "SELECT * FROM usuarios WHERE nombre LIKE '%$nombre%'";
$resultado = $conn->query($sql);

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Resultados');

// Encabezados de columnas
$columnTitles = [
    'ID', 'Nombre', 'Apellido Materno', 'Apellido Paterno', 'Teléfono',
    'Correo', 'Dirección', 'Código Postal', 'Ciudad', 'Estado', 'País'
];

// Agregar los encabezados
$column = 'A';
foreach ($columnTitles as $title) {
    $sheet->setCellValue($column . '1', $title);
    $column++;
}

// Agregar los datos
$row = 2;
while ($usuario = $resultado->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $usuario['id']);
    $sheet->setCellValue('B' . $row, $usuario['nombre']);
    $sheet->setCellValue('C' . $row, $usuario['apellido_materno']);
    $sheet->setCellValue('D' . $row, $usuario['apellido_paterno']);
    $sheet->setCellValue('E' . $row, $usuario['telefono']);
    $sheet->setCellValue('F' . $row, $usuario['correo']);
    $sheet->setCellValue('G' . $row, $usuario['direccion']);
    $sheet->setCellValue('H' . $row, $usuario['codigo_postal']);
    $sheet->setCellValue('I' . $row, $usuario['ciudad']);
    $sheet->setCellValue('J' . $row, $usuario['estado']);
    $sheet->setCellValue('K' . $row, $usuario['pais']);
    $row++;
}

// Cerrar la conexión
$conn->close();

// Crear el archivo Excel
$writer = new Xlsx($spreadsheet);
$filename = 'resultado_consulta.xlsx';

// Enviar encabezados para descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Enviar el archivo al navegador
$writer->save('php://output');
exit;
