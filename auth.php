<?php
session_start();

// Conectar ao banco de dados (substitua as informações de conexão)
$conexao = new mysqli("localhost", "root", "", "crud_filmes");

// Verificar a conexão
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta SQL para verificar as credenciais no banco de dados
$consulta_sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
$resultado = $conexao->query($consulta_sql);

if ($resultado->num_rows == 1) {
    // Usuário é válido 
    $usuario = $resultado->fetch_assoc();

    if ($usuario['email'] === 'root@root.com') {
        // O administrador está logado
        $_SESSION['admin'] = true;
    } else {
        // Usuário comum está logado (não é admin)
        $_SESSION['admin'] = false;
    }

    header("Location: Listar_Filmes.php"); // Redireciona para a lista de filmes
} else {
    // Credenciais inválidas
    $_SESSION['admin'] = false;
    header("Location: Listar_Filmes.html"); // Redireciona de volta para a tela de login
}

// Fechar a conexão
$conexao->close();
?>
