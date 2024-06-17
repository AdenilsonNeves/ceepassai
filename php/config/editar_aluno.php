<?php

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $curso = isset($_POST['curso']) ? $_POST['curso'] : null;
    $link = isset($_POST['link']) ? $_POST['link'] : null;

    // Log para depuração
    error_log("Recebido: id = $id, nome = $nome, curso = $curso, link = $link");

    if ($id && $nome && $curso && $link) {
        try {
            // Atualiza os dados do aluno no banco de dados
            $sql = "UPDATE alunos SET nome = :nome, curso = :curso, link = :link WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':curso', $curso);
            $stmt->bindParam(':link', $link);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "Aluno atualizado com sucesso";
            } else {
                error_log("Erro ao atualizar aluno: " . implode(", ", $stmt->errorInfo()));
                http_response_code(500);
                echo "Erro ao atualizar aluno.";
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
