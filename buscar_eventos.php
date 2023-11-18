<?php
include 'conexao.php';

// Consulta para buscar os eventos
$query = "SELECT data, nome, horario, descricao FROM eventos";
$result = $conn->query($query);

$eventos = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $eventos[] = $row;
    }
}

echo json_encode($eventos); // Retorna os resultados como JSON
?>
