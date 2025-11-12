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
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .profile-box {
            background-color: white;
            border: 2px solid #FFA12B;
            border-radius: 10px;
            width: 300px;
            margin: 15px;
            padding: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-box h2 {
            color: #FFA12B;
            margin-bottom: 10px;
        }

        .profile-info p {
            margin: 5px 0;
        }

        .profile-info {
            font-size: 14px;
        }

        .profile-info a {
            color: green;
            text-decoration: none;
            font-weight: bold;
            margin-right: 10px;
        }

        .profile-info a.recusar {
            color: red;
        }
    </style>
</head>

<body>
    <header>
        <div class="menu_background"></div>

        <nav class="menu">
            <div class="menu_imgs" id="logo">
                <a href="#" onclick="dark_mode()">
                    <img id="menu_logo_img" src="assets\logo_normal.png" loading="lazy" alt="logo_normal" />
                </a>
                <h2 id="menu_text_logo">ROGGi</h2>
            </div>

            <div class="menu_buttons">
                <a href="painel_prestador.php">
                    <h2 class="menu_text">início</h2>
                </a>
                <a href="comunidade.php">
                    <h2 class="menu_text">comunidade</h2>
                </a>
                <a href="sobre.php">
                    <h2 class="menu_text">sobre nós</h2>
                </a>
            </div>

            <div class="menu_imgs">

                <?php if (isset($_SESSION['usuario_id'])) { ?>

                    <?php if ($_SESSION['servidor'] == 1) { ?>
                        <a href="painel_prestador.php" title="Meu Painel">
                            <h2 class="menu_text">Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?></h2>
                        </a>
                    <?php } else { ?>
                        <a href="servicos.php" title="Meus Serviços">
                            <h2 class="menu_text">Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?></h2>
                        </a>
                    <?php } ?>

                    <a href="logout.php" title="Sair" style="margin-left: 10px;">
                        <svg class="menu_icon" height="2rem" viewBox="0 -960 960 960" fill="var(--main_text)">
                            <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v60H200v560h280v60H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                        </svg>
                    </a>

                <?php } else { ?>

                    <a href="login.php" title="Fazer Login">
                        <svg class="menu_icon" ...> ... </svg>
                    </a>
                <?php } ?>
            </div>

        </nav>
    </header>
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