<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Exclusão</title>
</head>
<body>
    <h1>Confirmar Exclusão</h1>

    <?php
    // Verificar se o ID do filme foi passado na URL
    if (isset($_GET["id"])) {
        $id_filme = $_GET["id"];
        
        echo "Tem certeza de que deseja excluir este filme?";

        echo "<form action='processar_exclusao.php' method='POST'>";
        echo "<input type='hidden' name='id' value='$id_filme'>";
        echo "<input type='submit' value='Confirmar Exclusão'>";
        echo "</form>";
    } else {
        echo "ID do filme não especificado.";
    }
    ?>

    <a href="listar_filmes.php">Cancelar</a>
</body>
</html>
