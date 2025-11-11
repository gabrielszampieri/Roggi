<?php
session_start();
require 'conexao.php';
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?erro=restrito");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_prestador = mysqli_real_escape_string($conexao, $_POST['id_prestador']);
    $data = mysqli_real_escape_string($conexao, $_POST['data']);
    $hora = mysqli_real_escape_string($conexao, $_POST['horario']);
    
    // Pegar o ID do cliente que está logado
    $id_cliente = $_SESSION['usuario_id'];
    
    // Salvar no banco com status 'pendente'
    $sql = "INSERT INTO agendamentos (id_cliente, id_prestador, data_solicitada, horario_solicitado, status) 
            VALUES ('$id_cliente', '$id_prestador', '$data', '$hora', 'pendente')";
            
    if (mysqli_query($conexao, $sql)) {
        // Sucesso
        header("Location: servicos.php?status=agendado");
        exit;
    } else {
        // Erro
        echo "Erro ao salvar agendamento: " . mysqli_error($conexao);
    }
    mysqli_close($conexao);
}
?>