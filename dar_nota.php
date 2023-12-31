<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dar Nota</title>
</head>
<body>
    <h1>Dar Nota</h1>

    <?php
    session_start();

    // Verifica se o usuário está logado como admin
    $admin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;

    // Verifica se o ID do filme foi passado via GET
    if (isset($_GET['id'])) {
        $filme_id = $_GET['id'];

        // Verifica se o formulário foi enviado
        if (isset($_POST['nota'])) {
// Conecta ao banco de dados (substitua as informações de conexão caso seja diferente do meu)
$conexao = new mysqli("localhost", "root", "", "crud_filmes");

            // Verifica a conexão
            if ($conexao->connect_error) {
                die("Erro na conexão: " . $conexao->connect_error);
            }

            // Obtem a nota do formulário
            $nota = $_POST['nota'];

            // Insere a nota na tabela de avaliações
            $inserir_sql = "INSERT INTO avaliacoes (filme_id, nota) VALUES (?, ?)";
            $stmt = $conexao->prepare($inserir_sql);
            $stmt->bind_param("ii", $filme_id, $nota);

            if ($stmt->execute()) {
                echo "Nota adicionada com sucesso!";
            } else {
                echo "Erro ao adicionar nota: " . $stmt->error;
            }

            // Fecha a conexão
            $stmt->close();
            $conexao->close();
        }

        // Exibe o formulário para dar nota
        echo "<form action='dar_nota.php?id=$filme_id' method='POST'>";
        echo "Nota (de 1 a 10): <input type='number' name='nota' min='1' max='10' required><br><br>";
        echo "<input type='submit' value='Dar Nota'>";
        echo "</form>";
    } else {
        echo "ID do filme não especificado.";
    }


    if ($admin) {
        echo "<br><a href='Listar_Filmes.php'>Voltar para a Lista de Filmes</a>";
    }
    ?>
    <a href="listar_filmes.php">Cancelar</a>
</body>
</html>
