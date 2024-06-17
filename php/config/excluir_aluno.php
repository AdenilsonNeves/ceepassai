<?php

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if ($id) {
        try {
            // Exclui o aluno do banco de dados
            $sql = "DELETE FROM alunos WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "Aluno excluído com sucesso";
            } else {
                error_log("Erro ao excluir aluno: " . implode(", ", $stmt->errorInfo()));
                http_response_code(500);
                echo "Erro ao excluir aluno.";
            }
        } catch (PDOException $e) {
            error_log("Erro na execução da query: " . $e->getMessage());
            http_response_code(500);
            echo "Erro na execução da query: " . $e->getMessage();
        }
    } else {
        error_log("Dados inválidos recebidos.");
        http_response_code(400);
        echo "Dados inválidos.";
    }
} else {
    error_log("Método de solicitação inválido.");
    http_response_code(405);
    echo "Método de solicitação inválido.";
}
?>