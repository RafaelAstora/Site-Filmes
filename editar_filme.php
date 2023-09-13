<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Filme</title>
</head>
<body>
    <h1>Editar Filme</h1>

    <?php
    // Conecta ao banco de dados (substitua as informações de conexão)
    $conexao = new mysqli("localhost:3306", "root", "", "crud_filmes");

    // Verifica a conexão
    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera os dados do formulário
        $id = $_POST["id"];
        $titulo = $_POST["titulo"];
        $genero = $_POST["genero"];
        $ano_lancamento = $_POST["ano_lancamento"];

        $foto = $_POST["foto"];

        // Atualiza o registro do filme no banco de dados
        $atualizacao_sql = "UPDATE filmes SET titulo = '$titulo', genero = '$genero', ano_lancamento = $ano_lancamento, foto = '$foto' WHERE id = $id";

        if ($conexao->query($atualizacao_sql) === TRUE) {
            echo "Filme atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar o filme: " . $conexao->error;
        }
    }

    // Recupera o ID do filme da URL
    $id_filme = $_GET["id"];

    // Consulta SQL para selecionar os dados do filme a ser editado
    $consulta_sql = "SELECT * FROM filmes WHERE id = $id_filme";
    $resultado = $conexao->query($consulta_sql);

    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        ?>

        <form action="editar_filme.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $linha["id"]; ?>">
            
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $linha["titulo"]; ?>" required><br>

            <label for="genero">Gênero:</label>
            <input type="text" id="genero" name="genero" value="<?php echo $linha["genero"]; ?>" required><br>

            <label for="ano_lancamento">Ano de Lançamento:</label>
            <input type="number" id="ano_lancamento" name="ano_lancamento" value="<?php echo $linha["ano_lancamento"]; ?>" required><br>

            

            <label for="foto">URL da Foto:</label>
            <input type="text" id="foto" name="foto" value="<?php echo $linha["foto"]; ?>" required><br>

            <input type="submit" value="Salvar Alterações">
        </form>
        <?php
    } else {
        echo "Filme não encontrado.";
    }

    // Fecha a conexão
    $conexao->close();
    ?>
</body>
</html>