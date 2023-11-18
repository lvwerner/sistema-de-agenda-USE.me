<?php
// Incluindo o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verificando se os dados foram submetidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os dados do formulário
    $nomeEvento = $_POST['evento'];
    $horario = $_POST['horario'];
    $descricao = $_POST['descricao'];
    $acao = $_POST['acao'];

    // Query para inserir os dados no banco de dados (usando prepared statement)
    $sql = "INSERT INTO eventos (nome_evento, horario, descricao, acao) VALUES (?, ?, ?, ?)";
    
    // Preparando a declaração SQL
    $stmt = $conn->prepare($sql);
    
    // Vinculando parâmetros e executando a declaração
    $stmt->bind_param("ssss", $nomeEvento, $horario, $descricao, $acao);
    
    // Executando a query
    if ($stmt->execute()) {
        // Redirecionando para a página index.php
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao inserir os dados: " . $conn->error;
    }

    // Fechando a declaração e a conexão
    $stmt->close();
    $conn->close();
}
?>
