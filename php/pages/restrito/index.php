<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../../html/restrito/login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../../img/logoCeep.png" type="image/x-icon">
    <title>Área do Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../css/admin.css">
</head>
<body>
    <header>
        <div class="header-logo">
           <a href="../../../index.html"><img class="img-fluid" src="../../../img/logoCeep.png" alt="Logo Ceep"></a>
        </div>
    </header>

    <div class="main-content">
    <div class="navbar-bottom">
    <nav class="nav flex-row">
        <a class="nav-link" onclick="showContent('inseriraluno')">Inserir Aluno</a>
        <a class="nav-link" onclick="showContent('registrarusuario')">Novo Administrador</a>
        <a class="nav-link" onclick="showContent('alunosinseridos')">Visualizar Alunos</a>
        <a class="nav-link" onclick="showContent('logout')">Outras Ações</a>
    </nav>
</div>

        <div class="container">
            <div class="content">
                <div id="inseriraluno" class="content-section">
                    <form class="formulario" action="../../config/salvar_aluno.php" method="post">
                        <label for="nome">Nome Completo:</label>
                        <input type="text" name="nome" id="nome">
                        <label for="turma">Turma e Curso</label>
                        <select id="curso" name="curso" multiple size="10">
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
                        <label for="link">Link do LinkedIn:</label>
                        <input type="text" name="link" id="link">
                        <button class="botaoEnviar" type="submit">Enviar</button>
                    </form>
                </div>

                <div id="registrarusuario" class="content-section" style="display:none;">
                    <form class="formulario" action="../../config/registro.php" method="post">
                        <label for="nome">Usuário:</label>
                        <input type="text" id="username" name="username" required>
                        <label for="turma">Senha:</label>
                        <input type="password" id="password" name="password" required>
                        <button class="botaoEnviar" type="submit">Enviar</button>
                    </form>
                </div>

                <div id="alunosinseridos" class="content-section" style="display:none;">
    <h2 class="titulo">Alunos Inseridos</h2>
    <div class="filtroContainer">
    <label for="filtroCurso">Filtrar por Curso:</label>
    <select id="filtroCurso" onchange="filtrarAlunos()">
        <option value="#">Selecione o Curso</option>
        <option value="">Todos</option>
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
    </div>

    <div class="tabelaTamanho">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Curso</th>
                    <th>LinkedIn</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody id="listaAlunos">
                <!-- Os dados dos alunos serão inseridos aqui dinamicamente -->
            </tbody>
        </table>
    </div>
</div>

<div id="editModal" class="modal" style="display:none;">
    <div class="modal-content">
        <h2>Editar Aluno</h2>
        <form id="editForm">
            <input type="hidden" id="editId" name="id">
            <label for="editNome">Nome:</label>
            <input type="text" id="editNome" name="nome" required>
            <label for="editCurso">Curso:</label>
            <input type="text" id="editCurso" name="curso" required>
            <label for="editLinkedIn">LinkedIn:</label>
            <input type="url" id="editLinkedIn" name="link" required>
            <button type="button" onclick="salvarEdicao()">Salvar</button>
            <button type="button" onclick="fecharModal()">Cancelar</button>
        </form>
    </div>
</div>

                <div id="logout" class="content-section" style="display:none;">
                    <h2>Logout</h2>
                    <p><a href="../../config/logout.php">Clique aqui para sair</a></p>
                    <p><a href="../publico/lista_alunos.php">Clique aqui para ver a página oficial de alunos</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="../../../js/admin.js"></script>
</body>
</html>
