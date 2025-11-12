<?php
session_start();    // Inicia a sessão
session_unset();    // Limpa todas as variáveis da sessão
session_destroy();  // Destrói a sessão
header("Location: index.php"); // Redireciona de volta para a página inicial
exit;
?>