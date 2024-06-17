<?php
// Incluir o arquivo de conexão
include 'db_connection.php';

// Capturar dados do formulário
$nome = $_POST['nome'];
$curso = $_POST['curso'];
$link = $_POST['link'];

try {
    // Preparar a consulta SQL
    $stmt = $conn->prepare("INSERT INTO alunos (nome, curso, link) VALUES (:nome, :curso, :link)");
    
    // Bind dos parâmetros
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':curso', $curso);
    $stmt->bindParam(':link', $link);
    
    // Executar a consulta
    $stmt->execute();
    
    header("Location: ../pages/restrito/index.php");

} catch (PDOException $e) {
    // Se ocorrer um erro, enviar uma resposta de erro
    echo json_encode(array('status' => 'error', 'message' => 'Erro: ' . $e->getMessage()));
}

// Fechar a conexão
$conn = null;
?>
