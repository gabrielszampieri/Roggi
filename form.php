<?php
// 1. Incluir o arquivo de conexão
require 'conexao.php';
// 2. Iniciar a sessão
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 4. Pegar TODOS os dados do formulário
    $servidor = mysqli_real_escape_string($conexao, $_POST['servidor']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $sobrenome = mysqli_real_escape_string($conexao, $_POST['sobrenome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
    $genero = mysqli_real_escape_string($conexao, $_POST['genero']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
    $numero = mysqli_real_escape_string($conexao, $_POST['numero']);
    $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
    $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $estado = mysqli_real_escape_string($conexao, $_POST['estado']);
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    
    $servicos = "";
    if ($servidor == 1 && isset($_POST['servicos'])) {
        $servicos = mysqli_real_escape_string($conexao, $_POST['servicos']);
    }

    
    // 5. VERIFICAR SE E-MAIL OU USUÁRIO JÁ EXISTEM
    $sql_check = "SELECT * FROM usuarios WHERE email = '$email' OR usuario = '$usuario'";
    $result_check = mysqli_query($conexao, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Se encontrou, pega o resultado para saber qual duplicou
        $dados = mysqli_fetch_assoc($result_check);
        if ($dados['email'] == $email) {
            // Erro de e-mail duplicado
            header("Location: cadastro.php?erro=email");
            exit;
        } else {
            // Erro de usuário duplicado
            header("Location: cadastro.php?erro=usuario");
            exit;
        }
    }


    // 6. Criptografar a senha
    $senha = $_POST['senha'];
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // 7. Criar o comando SQL INSERT
    $sql_insert = "INSERT INTO usuarios (servidor, nome, sobrenome, email, telefone, data_nascimento, genero, endereco, numero, complemento, bairro, cidade, estado, servicos, usuario, senha) 
            VALUES ('$servidor', '$nome', '$sobrenome', '$email', '$telefone', '$data_nascimento', '$genero', '$endereco', '$numero', '$complemento', '$bairro', '$cidade', '$estado', '$servicos', '$usuario', '$senha_hash')";

    // 8. Executar o SQL no banco
    if (mysqli_query($conexao, $sql_insert)) {
        // Se der certo, redireciona para o login
        header("Location: login.php?status=cadastrado");
        exit;
    } else {
        // Se der um erro inesperado
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }

    // 9. Fechar a conexão
    mysqli_close($conexao);
} else {
    header("Location: cadastro.php");
    exit;
}
?>