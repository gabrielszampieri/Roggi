<?php
session_start();
// ... (require 'conexao.php' em alguns) ...

// Esta linha checa se o usuário NÃO está logado OU se ele NÃO é um Cliente
if (!isset($_SESSION['usuario_id']) || $_SESSION['servidor'] != 0) { 
    // Se for um prestador (ou visitante), ele é expulso.
    header("Location: login.php?erro=acesso_negado_cliente");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8"/>
        <title>Serviços</title>
        <link href="https://fonts.googleapis.com" rel="preconnect"/>
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous"/>
        <link href="assets/style.css" rel="stylesheet">
        <link rel="icon" href="assets/logo_small.png" type="image/png">
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
                <a href="index.php">
                    <h2 id="menu_text_selected">início</h2>
                </a>
                <a href="servicos.php">
                    <h2 class="menu_text">serviços</h2>
                </a>
                <a onclick="comunidade()">
                    <h2 class="menu_text">comunidade</h2>
                </a>
                <a href="sobre.php">
                    <h2 class="menu_text">sobre nós</h2>
                </a>
            </div>

            <div class="menu_imgs">
                <!-- <div class="menu_imgs">
                    <a id="bnt_login" onclick="toggleDropdown_act()">
                        <svg class="menu_icon" height="2rem" viewBox="0 -960 960 960" fill="var(--main_text)">
                            <path d="M109.91-240Q81-240 60.5-260.59 40-281.18 40-310.09t20.49-49.41q20.5-20.5 49.28-20.5 5.23 0 10.23.5t13 2.5l200-200q-2-8-2.5-13t-.5-10.23q0-28.78 20.59-49.28Q371.18-670 400.09-670t49.41 20.63q20.5 20.64 20.5 49.61 0 1.76-3 22.76l110 110q8-2 13-2.5t10-.5q5 0 10 .5t13 2.5l160-160q-2-8-2.5-13t-.5-10.23q0-28.78 20.59-49.28Q821.18-720 850.09-720t49.41 20.59q20.5 20.59 20.5 49.5t-20.49 49.41q-20.5 20.5-49.28 20.5-5.23 0-10.23-.5t-13-2.5L667-423q2 8 2.5 13t.5 10.23q0 28.78-20.59 49.28Q628.82-330 599.91-330t-49.41-20.49q-20.5-20.5-20.5-49.28 0-5.23.5-10.23t2.5-13L423-533q-8 2-13 2.5t-10.25.5q-1.75 0-22.75-3L177-333q2 8 2.5 13t.5 10.23q0 28.78-20.59 49.28Q138.82-240 109.91-240Z"/>
                        </svg>
                    </a>
                </div> -->
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
                            <svg class="menu_icon" height="2rem" viewBox="0 -960 960 960" fill="var(--main_text)">
                                <path
                                    d="M222-255q63-44 125-67.5T480-346q71 0 133.5 23.5T739-255q44-54 62.5-109T820-480q0-145-97.5-242.5T480-820q-145 0-242.5 97.5T140-480q0 61 19 116t63 109Zm257.81-195q-57.81 0-97.31-39.69-39.5-39.68-39.5-97.5 0-57.81 39.69-97.31 39.68-39.5 97.5-39.5 57.81 0 97.31 39.69 39.5 39.68 39.5 97.5 0 57.81-39.69 97.31-39.68 39.5-97.5 39.5Zm.66 370Q398-80 325-111.5t-127.5-86q-54.5-54.5-86-127.27Q80-397.53 80-480.27 80-563 111.5-635.5q31.5-72.5 86-127t127.27-86q72.76-31.5 155.5-31.5 82.73 0 155.23 31.5 72.5 31.5 127 86t86 127.03q31.5 72.53 31.5 155T848.5-325q-31.5 73-86 127.5t-127.03 86Q562.94-80 480.47-80Zm-.47-60q55 0 107.5-16T691-212q-51-36-104-55t-107-19q-54 0-107 19t-104 55q51 40 103.5 56T480-140Zm0-370q34 0 55.5-21.5T557-587q0-34-21.5-55.5T480-664q-34 0-55.5 21.5T403-587q0 34 21.5 55.5T480-510Zm0-77Zm0 374Z" />
                            </svg>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </nav>
            
            </header>

    <main>

        <div class="filter-container">
             <input type="text" id="service-filter" placeholder="buscar serviço ou profissional...">
            <button type="button">Buscar</button>
        </div>
    
        <div id="servicos">
            <a class="link-bola baba" href="profissionais.php?servico=baba">babá</a>
            <a class="link-bola cuidador-de-pet" href="profissionais.php?servico=cuidador-de-pet">cuidador de pet</a>
            <a class="link-bola diarista" href="profissionais.php?servico=diarista">diarista</a>
            <a class="link-bola eletricista" href="profissionais.php?servico=eletricista">eletricista</a>
            <a class="link-bola encanador" href="profissionais.php?servico=encanador">encanador</a>
            <a class="link-bola jardineiro" href="profissionais.php?servico=jardineiro">jardineiro</a>
            <a class="link-bola marceneiro" href="profissionais.php?servico=marceneiro">marceneiro</a>
            <a class="link-bola montador-de-moveis" href="profissionais.php?servico=montador-de-moveis">montador de móveis</a>
            <a class="link-bola pintor" href="profissionais.php?servico=pintor">pintor</a>
            <a class="link-bola serralheiro" href="profissionais.php?servico=serralheiro">serralheiro</a>
            <a class="link-bola diversas-funcoes" href="profissionais.php?servico=diversas-funcoes">funções diversas</a>
            <a class="link-bola servicos-terceirizados" href="profissionais.php?servico=servicos-terceirizados">serviços terceirizados</a>
        </div>
    
        </main>

    <footer>
        <div class="footer_div">
            <div>
                <p class="footer_text">Criado e desenvolvido por Henrique, João e Mariana. ©️</p>
            </div>
            <div>
                <p class="footer_text">2024</p>
            </div>
        </div>

    </footer>

    <script>
        // function filtrarServicos() { ... } 
    </script>

    <script src="assets/script.js"></script>
    
    </body>
</html>