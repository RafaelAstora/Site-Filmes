<?php
// Verifica se o ID do filme foi passado via POST
if (isset($_POST["id"])) {
    // Recupera o ID do filme da variável POST
    $id_filme = $_POST["id"];

    // usa $id_filme na consulta SQL para excluir as avaliações relacionadas.
    $conexao = new mysqli("localhost", "root", "", "crud_filmes");

    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }

    // exclui as avaliações relacionadas ao filme
    $query_avaliacoes = "DELETE FROM avaliacoes WHERE filme_id = $id_filme";

    if ($conexao->query($query_avaliacoes) === TRUE) {
        // Em seguida, exclui o filme
        $query_filme = "DELETE FROM filmes WHERE id = $id_filme";

        if ($conexao->query($query_filme) === TRUE) {
            echo "Filme excluído com sucesso!";
        } else {
            echo "Erro ao excluir o filme: " . $conexao->error;
        }
    } else {
        echo "Erro ao excluir as avaliações: " . $conexao->error;
    }

    $conexao->close();
} else {
    echo "ID do filme não especificado.";
}
?>
