<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $dataEvento = $_POST['dataEvento'];
    $nomeEvento = $_POST['nomeEvento'];
    $horarioEvento = $_POST['horarioEvento'];
    $descricaoEvento = $_POST['descricaoEvento'];

    // Preparar e executar a query para inserir os dados no banco de dados
    $query = "INSERT INTO eventos (data, nome, horario, descricao) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $dataEvento, $nomeEvento, $horarioEvento, $descricaoEvento);

    if ($stmt->execute()) {
        // Sucesso ao salvar no banco de dados
        echo "Evento salvo com sucesso!";
    } else {
        // Erro ao salvar no banco de dados
        echo "Erro ao salvar o evento: " . $conn->error;
    }
} else {
    // Se o método da requisição não for POST, retorne uma mensagem de erro
    echo "Método inválido. Use o método POST para enviar dados.";
}
?>
