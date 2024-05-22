<?php
include 'conexion.php';

$id_trabajo = isset($_GET['id_trabajo']) ? intval($_GET['id_trabajo']) : 0;

if ($id_trabajo > 0) {
    $stmt = $conn->prepare("SELECT titulo, descripcion, ruta FROM pdf WHERE id_proyecto = ?");
    $stmt->bind_param('i', $id_trabajo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="document-item">';
            echo '<span class="document-icon"><img src="img/pdf.png"></span>';
            echo '<div class="document-info">';
            echo '<p class="document-title">' . htmlspecialchars($row['titulo']) . '</p>';
            echo '<p class="document-description">' . htmlspecialchars($row['descripcion']) . '</p>';
            echo '</div>';
            echo '<a href="' . htmlspecialchars($row['ruta']) . '" class="download-button" download>Descargar</a>';
            echo '</div>';
            echo '<hr>';

        }
    } else {
        echo 'No hay documentos asociados a este proyecto.';
    }

    $stmt->close();
} else {
    echo 'ID de proyecto no válido.';
}

$conn->close();
?>
