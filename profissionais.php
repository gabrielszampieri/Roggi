<?php
// 1. INICIAR A SESSÃO E CONECTAR AO BANCO
session_start();
require 'conexao.php'; // <-- ESTA LINHA ESTAVA FALTANDO (CRIA O $conexao)

// 2. PROTEGER A PÁGINA (SÓ PARA CLIENTES)
// (Aqui já está a proteção que discutimos na mensagem anterior)
if (!isset($_SESSION['usuario_id']) || $_SESSION['servidor'] != 0) { 
    header("Location: login.php?erro=restrito");
    exit;
}

// 3. PEGAR O SERVIÇO DA URL (Ex: "baba")
// <-- ESTA LINHA ESTAVA FALTANDO
$servico_escolhido = $_GET['servico']; 

// 4. PREPARAR O TÍTULO
// <-- ESTA LINHA ESTAVA FALTANDO
$titulo_pagina = ucfirst($servico_escolhido);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?>s Disponíveis</title>
    
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { display: flex; flex-wrap: wrap; justify-content: space-around; }
        .profile-box { background-color: white; border: 2px solid #FFA12B; border-radius: 10px; width: 300px; margin: 15px; padding: 15px; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); }
        .profile-box h2 { color: #FFA12B; margin-bottom: 10px; }
        .profile-info p { margin: 5px 0; }
        .profile-info { font-size: 14px; }
        .profile-info a { color: #007bff; text-decoration: none; font-weight: bold; display: block; margin-top: 10px; }
        .profile-info a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1><?php echo $titulo_pagina; ?>s Disponíveis</h1>
    <div class="container">
        <?php
        // 6. BUSCAR OS PRESTADORES NO BANCO
        $servico_seguro = mysqli_real_escape_string($conexao, $servico_escolhido);
        $sql = "SELECT * FROM usuarios WHERE servidor = 1 AND servicos = '$servico_seguro'";
        $resultado = mysqli_query($conexao, $sql);

        // 7. VERIFICAR SE ACHOU ALGUÉM
        if (mysqli_num_rows($resultado) > 0) {
            
            // 8. O "LOOP" - Repetir o card para cada prestador encontrado
            while($prestador = mysqli_fetch_assoc($resultado)) {
                // 9. O "TEMPLATE" DO CARD (Copiado do seu baba.html)
                echo '<div class="profile-box">';
                echo '    <h2>' . htmlspecialchars($prestador['nome']) . ' ' . htmlspecialchars($prestador['sobrenome']) . '</h2>';
                echo '    <div class="profile-info">';
                echo '        <p>Telefone: ' . htmlspecialchars($prestador['telefone']) . '</p>';
                echo '        <p>Email: ' . htmlspecialchars($prestador['email']) . '</p>';
                
                // 10. O LINK PARA O AGENDAMENTO (Fase 4)
                echo '        <a href="agendar.php?id_prestador=' . $prestador['id'] . '">';
                echo '            Solicitar Agendamento';
                echo '        </a>';
                
                echo '    </div>';
                echo '</div>';
            }
        } else {
            echo '<p>Nenhum profissional encontrado para este serviço.</p>';
        }
        mysqli_close($conexao);
        ?>
    </div> </body>
</html>