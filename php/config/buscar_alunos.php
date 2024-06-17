<?php
include 'db_connection.php';

$sql = "SELECT id, nome, curso, link FROM alunos ORDER BY nome ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();

$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($alunos);
?>
