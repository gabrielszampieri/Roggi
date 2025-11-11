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
                        <img id="menu_logo_img" src="assets\logo_normal.png" loading="lazy" alt="logo_normal"/>
                    </a>
                    <h2 id="menu_text_logo">ROGGi</h2>
                </div>
    
                <div class="menu_buttons">
                    <a href="index.php">
                        <h2 class="menu_text">início</h2>
                    </a>
                    <a href="servicos.php">
                        <h2 id="menu_text_selected">Serviços</h2>
                    </a>
                    <a href="comunidade.php"> <h2 class="menu_text">Comunidade</h2>
                    </a>
                    <a href="sobre.php">
                        <h2 class="menu_text">Sobre nós</h2>
                    </a>
                </div>
    
                <div class="menu_imgs">
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