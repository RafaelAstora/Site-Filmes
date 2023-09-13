<?php
// Conecta ao banco de dados (substitua as informações de conexão caso seja diferente do meu)
$conexao = new mysqli("localhost", "root", "", "crud_filmes");

// Verifica a conexão
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Obtem os dados do formulário
$titulo = $_POST["titulo"];
$genero = $_POST["genero"];
$ano_lancamento = $_POST["ano_lancamento"];
$nota = $_POST["nota"];

// Insere o novo filme no banco de dados
$inserir_sql = "INSERT INTO filmes (titulo, genero, ano_lancamento, nota) VALUES ('$titulo', '$genero', $ano_lancamento, $nota)";

if ($conexao->query($inserir_sql) === TRUE) {
    echo "Filme adicionado com sucesso!";
} else {
    echo "Erro ao adicionar filme: " . $conexao->error;
}

// Fecha a conexão
$conexao->close();
?>