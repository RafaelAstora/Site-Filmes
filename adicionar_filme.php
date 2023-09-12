<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Filme</title>
</head>
<body>
    <h1>Adicionar Novo Filme</h1>

    <form action="processar_adicao_filme.php" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br>

        <label for="genero">Gênero:</label>
        <input type="text" id="genero" name="genero" required><br>

        <label for="ano_lancamento">Ano de Lançamento:</label>
        <input type="number" id="ano_lancamento" name="ano_lancamento" required><br>

        <label for="nota">Nota:</label>
        <input type="number" id="nota" name="nota" step="0.01" min="0" max="5" required><br>

        <label for="foto">URL da Foto:</label>
        <input type="text" id="foto" name="foto" required><br>
        
        <input type="submit" value="Adicionar Filme">
    </form>
    <a href="listar_filmes.php">Cancelar</a>

</body>
</html>