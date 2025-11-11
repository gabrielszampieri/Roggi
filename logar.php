<?php
// 1. Iniciar a sessão SEMPRE no topo
session_start();
// 2. Incluir a conexão
require 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_digitado = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha_digitada = $_POST['senha'];

    // 3. Buscar o usuário no banco
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario_digitado'";
    $resultado = mysqli_query($conexao, $sql);

    // 4. Checar se o usuário existe (se encontrou 1 linha)
    if (mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);

        // 5. Verificar a senha criptografada
        if (password_verify($senha_digitada, $usuario['senha'])) {
            // Senha correta!
            
            // 6. Salvar dados na sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['servidor'] = $usuario['servidor']; // 0 = Cliente, 1 = Prestador

            // 7. O REDIRECIONAMENTO (A LÓGICA PRINCIPAL)
            if ($usuario['servidor'] == 1) {
                // É um Prestador
                header("Location: painel_prestador.php");
                exit;
            } else {
                // É um Cliente
                header("Location: servicos.php");
                exit;
            }

        } else {
            // Senha incorreta
            header("Location: login.php?erro=senha");
            exit;
        }
    } else {
        // Usuário não encontrado
        header("Location: login.php?erro=usuario");
        exit;
    }
    mysqli_close($conexao);
} else {
    header("Location: login.php");
    exit;
}
?>