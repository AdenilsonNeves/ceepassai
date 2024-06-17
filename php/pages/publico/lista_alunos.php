<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img/logoCeep.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../css/lista_alunos.css">
    <title>Lista de Alunos</title>
</head>
<body>
<nav>
        <a href="../../../index.html"><strong>Home</strong></a>
        <a href="lista_alunos.php"><strong>HUB RH</strong></a>
        <a href="../../../html/publico/institucional.html"><strong>Institucional</strong></a>
 </nav>
        <header>
            <div class="logo">
                <img class="img-fluid" src="../../../img/logoCeep.png" alt="Logo Ceep">
                <p class="h2">System</p>
            </div>
        </header>


        <main class="container">
            <form method="GET" action="lista_alunos.php" class="filtro">
                <div class="filtro-container">
                    <label class="h4" for="curso">Selecione o Curso:</label>
                    <select class="selecao-caixa" name="curso" id="curso">
                 <option value="NÃO COLOQUE NENHUMA INFO MAS NÃO DEIXE VAZIO">Selecione o Curso</option>
                        <option value="">Todos os Cursos</option>
                        <option value="3º Agronegócio">3º Agronegócio</option>
                        <option value="3º Análise e Desenvolvimento de Sistemas">3º Análise e Desenvolvimento de Sistemas</option>
                        <option value="3º Edificações">3º Edificações</option>
                        <option value="3º Eletroeletrônica">3º Eletroeletrônica</option>
                        <option value="3º Mecânica A">3º Mecânica A</option>
                        <option value="3º Mecânica B">3º Mecânica B</option>
                        <option value="4º Agronegócio">4º Agronegócio</option>
                        <option value="4º Edificações">4º Edificações</option>
                        <option value="4º Eletroeletrônica">4º Eletroeletrônica</option>
                        <option value="Técnico em Enfermagem">Técnico em Enfermagem</option>
                    </select>
                    <input type="submit" value="Filtrar">
                </div>
            </form>

            <?php
            // Inclui o arquivo de conexão com o banco de dados
            include '../../config/db_connection.php';

            try {
                // Obter o valor do filtro de curso
                $curso = isset($_GET['curso']) ? $_GET['curso'] : '';

                // Construir a consulta SQL com base no filtro
                $sql = "SELECT nome, curso, link FROM alunos";
                if (!empty($curso)) {
                    $sql .= " WHERE curso = :curso";
                }
                $sql .= " ORDER BY nome"; // Ordenar por nome

                $stmt = $conn->prepare($sql);
                
                // Vincular o parâmetro se o curso estiver definido
                if (!empty($curso)) {
                    $stmt->bindParam(':curso', $curso, PDO::PARAM_STR);
                }

                $stmt->execute();

                // Verificação de erros na consulta
                if ($stmt->rowCount() > 0) {
                    echo "<ul class='student-list'>";
                    
                    // Saída dos dados de cada linha
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<li class='student-item'>
                                <a href='" . htmlspecialchars($row["link"]) . "' target='_blank'>
                                    <span>" . htmlspecialchars($row["nome"]) . "</span>
                                </a>
                            </li>";
                    }
                    echo "</ul>";
                } else {
                    echo "Selecione um curso";
                }
            } catch (PDOException $e) {
                echo "Erro na consulta SQL: " . $e->getMessage();
            }

            // Fechando a conexão
            $conn = null;
            ?>
        </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer>
</footer>
</html>