<?php
// Conectar ao banco de dados (substitua as informações de conexão)
$conexao = new mysqli("localhost", "root", "", "crud_filmes");

// Verificar a conexão
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Obter os dados do formulário
$titulo = $_POST["titulo"];
$genero = $_POST["genero"];
$ano_lancamento = $_POST["ano_lancamento"];
$nota = $_POST["nota"];

// Inserir o novo filme no banco de dados
$inserir_sql = "INSERT INTO filmes (titulo, genero, ano_lancamento, nota) VALUES ('$titulo', '$genero', $ano_lancamento, $nota)";

if ($conexao->query($inserir_sql) === TRUE) {
    echo "Filme adicionado com sucesso!";
} else {
    echo "Erro ao adicionar filme: " . $conexao->error;
}

// Fechar a conexão
$conexao->close();
?>