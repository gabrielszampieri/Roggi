<?php
session_start();
require 'conexao.php';
// Proteção dupla: checa se está logado E se é um prestador
if (!isset($_SESSION['usuario_id']) || $_SESSION['servidor'] != 1) {
    header("Location: login.html?erro=negado");
    exit;
}

$id_agendamento = $_GET['id'];
$status_novo = $_GET['status']; // 'aprovado' ou 'recusado'

// Segurança: garantir que o status seja um dos dois
if ($status_novo == 'aprovado' || $status_novo == 'recusado') {
    
    // Atualiza o status no banco
    $sql = "UPDATE agendamentos SET status = '$status_novo' WHERE id = '$id_agendamento'";
    
    if (mysqli_query($conexao, $sql)) {
        // Sucesso, volta pro painel
        header("Location: painel_prestador.php?status=atualizado");
        exit;
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conexao);
    }
}
mysqli_close($conexao);
?>