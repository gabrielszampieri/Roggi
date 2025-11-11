<?php
session_start();
require 'conexao.php';
// Proteção dupla: checa se está logado E se é um prestador
if (!isset($_SESSION['usuario_id']) || $_SESSION['servidor'] != 1) {
    header("Location: login.html?erro=negado");
    exit;
}

// Pegar o ID do prestador logado
$id_prestador_logado = $_SESSION['usuario_id'];
$nome_prestador = $_SESSION['nome'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Painel do Prestador</title>
    <link href="assets/style.css" rel="stylesheet">
    <style>
        .container { display: flex; flex-wrap: wrap; justify-content: space-around; padding: 20px; }
        .profile-box { background-color: white; border: 2px solid #FFA12B; border-radius: 10px; width: 300px; margin: 15px; padding: 15px; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); }
        .profile-box h2 { color: #FFA12B; margin-bottom: 10px; }
        .profile-info p { margin: 5px 0; } .profile-info { font-size: 14px; }
        .profile-info a { color: green; text-decoration: none; font-weight: bold; margin-right: 10px; }
        .profile-info a.recusar { color: red; }
    </style>
</head>
<body>
    <main class="container">
        <h1>Boas-vindas, <?php echo htmlspecialchars($nome_prestador); ?>!</h1>
        <p>Aqui estão suas solicitações de agendamento pendentes:</p>
        
        <?php
        // Buscar agendamentos PENDENTES e juntar com o nome do cliente
        $sql = "SELECT ag.*, usr.nome AS cliente_nome, usr.telefone AS cliente_telefone
                FROM agendamentos AS ag
                JOIN usuarios AS usr ON ag.id_cliente = usr.id
                WHERE ag.id_prestador = '$id_prestador_logado' AND ag.status = 'pendente'";
                
        $resultado = mysqli_query($conexao, $sql);
        
        if (mysqli_num_rows($resultado) > 0) {
            while ($agendamento = mysqli_fetch_assoc($resultado)) {
                echo '<div class="profile-box">';
                echo '    <h2>Solicitação de: ' . htmlspecialchars($agendamento['cliente_nome']) . '</h2>';
                echo '    <div class="profile-info">';
                echo '        <p>Telefone do Cliente: ' . htmlspecialchars($agendamento['cliente_telefone']) . '</p>';
                echo '        <p>Data: ' . date('d/m/Y', strtotime($agendamento['data_solicitada'])) . '</p>';
                echo '        <p>Horário: ' . $agendamento['horario_solicitado'] . '</p>';
                echo '        <br>';
                // Links para Aprovar ou Recusar (o "U" do CRUD)
                echo '        <a href="atualizar_agendamento.php?id=' . $agendamento['id'] . '&status=aprovado">Aprovar</a>';
                echo '        <a class="recusar" href="atualizar_agendamento.php?id=' . $agendamento['id'] . '&status=recusado">Recusar</a>';
                echo '    </div>';
                echo '</div>';
            }
        } else {
            echo '<p>Nenhuma solicitação pendente no momento.</p>';
        }
        mysqli_close($conexao);
        ?>
    </main>
</body>
</html>