function showContent(section) {
    // Oculta todas as seções
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(sec => sec.style.display = 'none');

    // Exibe a seção selecionada
    document.getElementById(section).style.display = 'block';
}

function carregarAlunos() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../../config/buscar_alunos.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const alunos = JSON.parse(xhr.responseText);
            mostrarAlunos(alunos);
        } else {
            console.error('Erro ao carregar alunos:', xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Erro na solicitação AJAX');
    };
    xhr.send();
}

function mostrarAlunos(alunos) {
    const listaAlunos = document.getElementById("listaAlunos");
    listaAlunos.innerHTML = "";
    alunos.forEach(aluno => {
        console.log("Dados do aluno:", aluno); // Adicionado para depuração
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${aluno.nome}</td>
            <td>${aluno.curso}</td>
            <td><a href="${aluno.link}" target="_blank">${aluno.link}</a></td>
            <td><button onclick="editarAluno('${aluno.id}', '${aluno.nome}', '${aluno.curso}', '${aluno.link}')">Editar</button></td>
            <td><button onclick="excluirAluno('${aluno.id}')">Excluir</button></td>
        `;
        listaAlunos.appendChild(tr);
    });
}



function editarAluno(id, nome, curso, link) {
    console.log("Editar aluno - ID:", id); // Adicionado para depuração
    document.getElementById("editId").value = id;
    document.getElementById("editNome").value = nome;
    document.getElementById("editCurso").value = curso;
    document.getElementById("editLinkedIn").value = link;
    document.getElementById("editModal").style.display = "flex";
}



function fecharModal() {
    document.getElementById("editModal").style.display = "none";
}

function salvarEdicao() {
    const id = document.getElementById("editId").value;
    const nome = document.getElementById("editNome").value;
    const curso = document.getElementById("editCurso").value;
    const link = document.getElementById("editLinkedIn").value;
    
    console.log("Salvar edição:", id, nome, curso, link); // Adicionado para depuração

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../config/editar_aluno.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('Resposta do servidor:', xhr.responseText); // Adicionado para depuração
            fecharModal();
            carregarAlunos(); // Recarrega a lista de alunos após a edição
        } else {
            console.error('Erro ao salvar edição:', xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Erro na solicitação AJAX');
    };
    
    const params = `id=${encodeURIComponent(id)}&nome=${encodeURIComponent(nome)}&curso=${encodeURIComponent(curso)}&link=${encodeURIComponent(link)}`;
    console.log("Enviando parâmetros:", params); // Adicionado para depuração
    xhr.send(params);
}




function excluirAluno(id) {
    if (confirm("Tem certeza que deseja excluir este aluno?")) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../../config/excluir_aluno.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status === 200) {
                carregarAlunos(); // Recarrega a lista de alunos após a exclusão
            } else {
                console.error('Erro ao excluir aluno:', xhr.statusText);
            }
        };
        xhr.onerror = function() {
            console.error('Erro na solicitação AJAX');
        };
        xhr.send(`id=${id}`);
    }
}

function filtrarAlunos() {
    const filtroCurso = document.getElementById("filtroCurso").value;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../../config/buscar_alunos.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const alunos = JSON.parse(xhr.responseText);
            const alunosFiltrados = alunos.filter(aluno => filtroCurso === "" || aluno.curso === filtroCurso);
            mostrarAlunos(alunosFiltrados);
        } else {
            console.error('Erro ao filtrar alunos:', xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Erro na solicitação AJAX');
    };
    xhr.send();
}
