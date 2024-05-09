<?php
include 'scripts/conexion.php';

// Recuperar variables del formulario
$nombre_proyecto = isset($_POST['titulo']) ? $_POST['titulo'] : '';
$fecha = isset($_POST['fecha_publicacion']) ? $_POST['fecha_publicacion'] : '';
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
$ano_carrera = isset($_POST['anyo']) ? $_POST['anyo'] : '';
$valoracion = isset($_POST['valoracion']) ? $_POST['valoracion'] : '';

// Empezar a construir la consulta
$queryParts = [];
if (!empty($nombre_proyecto)) {
    $queryParts[] = "titulo LIKE '%$nombre_proyecto%'";
}
if (!empty($fecha)) {
    $queryParts[] = "fecha_publicacion = '$fecha'";
}
if (!empty($tipo)) {
    $queryParts[] = "tipo = '$tipo'";
}
if (!empty($ano_carrera)) {
    $queryParts[] = "ano_carrera = $ano_carrera";
}
if (!empty($valoracion)) {
    $queryParts[] = "valoracion = $valoracion";
}

// Construir la consulta final
$sql = "SELECT * FROM trabajos";
if (!empty($queryParts)) {
    $sql .= " WHERE " . join(" AND ", $queryParts);
}

$resultado = $conn->query($sql);

$response = [];
while ($row = $resultado->fetch_assoc()) {
    $response[] = $row;
}

echo json_encode($response);
?>