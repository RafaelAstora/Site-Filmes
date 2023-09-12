<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de Filmes</title>
</head>
<body>
    <h1>Lista de Filmes</h1>

    <?php
    session_start();

    // Conectar ao banco de dados (substitua as informações de conexão)
    $conexao = new mysqli("localhost", "root", "", "crud_filmes");

    // Verificar a conexão
    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }

    // Consulta SQL para selecionar todos os filmes com média das notas
    $consulta_sql = "
        SELECT filmes.id, filmes.titulo, filmes.genero, filmes.ano_lancamento, filmes.foto,
               IFNULL(AVG(avaliacoes.nota), 0) AS media_notas
        FROM filmes
        LEFT JOIN avaliacoes ON filmes.id = avaliacoes.filme_id
        GROUP BY filmes.id, filmes.titulo, filmes.genero, filmes.ano_lancamento, filmes.foto;
    ";

    $resultado = $conexao->query($consulta_sql);

    if ($resultado->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Título</th><th>Gênero</th><th>Ano de Lançamento</th><th>Média de Notas</th><th>Foto</th></tr>";
        if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
            // Mostrar opções de adicionar, editar e excluir para o admin
            echo "<a href='adicionar_filme.php'><img src='https://cdn.discordapp.com/attachments/531215086640168970/1150742512701542440/753317.png' alt='Adicionar Filme' width='50px' height='50px'></a>";

        }
        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $linha["titulo"] . "</td>";
            echo "<td>" . $linha["genero"] . "</td>";
            echo "<td>" . $linha["ano_lancamento"] . "</td>";
            echo "<td>" . number_format($linha["media_notas"], 2) . "</td>"; // Formate a média com duas casas decimais
            echo "<td><img src='" . $linha["foto"] . "' width='100' height='125'></td>";
            echo "<td><a href='dar_nota.php?id=" . $linha["id"] . "'>Dar nota</a></td>";

            if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
                // Mostrar opções de adicionar, editar e excluir para o admin

                echo "<td><a href='editar_filme.php?id=" . $linha["id"] . "'>Editar</a></td>";
                echo "<td><a href='confirmar_exclusao.php?id=" . $linha["id"] . "'>Excluir</a></td>";
            }

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum filme encontrado.";
    }

    // Fechar a conexão
    $conexao->close();
    ?>
</body>
</html>
