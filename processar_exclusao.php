<?php
// Verificar se o ID do filme foi passado via POST
if (isset($_POST["id"])) {
    // Recupere o ID do filme da variável POST
    $id_filme = $_POST["id"];

    // Agora você pode usar $id_filme na sua consulta SQL para excluir as avaliações relacionadas.
    // Certifique-se de que a sua consulta SQL esteja correta.
    $conexao = new mysqli("localhost", "root", "", "crud_filmes");

    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }

    // Primeiro, exclua as avaliações relacionadas ao filme
    $query_avaliacoes = "DELETE FROM avaliacoes WHERE filme_id = $id_filme";

    if ($conexao->query($query_avaliacoes) === TRUE) {
        // Em seguida, exclua o filme
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
