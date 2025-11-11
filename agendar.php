<?php
session_start();
require 'conexao.php';
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?erro=restrito");
    exit;
}
// Pegar o ID do prestador pela URL
$id_prestador = $_GET['id_prestador'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Solicitar Agendamento</title>
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>
    <main>
        <section class="section_1" id="section_form">
            <form method="POST" action="salvar_agendamento.php">
                <div class="div_2">
                    <h2 class="sobre_h2">Solicitar Agendamento</h2>
                    <div class="form_group">
                        <div class="form">
                            <label class="form_text" for="data">Data Desejada:</label>
                            <input type="date" id="data" name="data" required>
                        </div>
                    </div>
                    <div class="form_group">
                        <div class="form">
                            <label class="form_text" for="horario">Horário Desejado:</label>
                            <input type="time" id="horario" name="horario" required>
                        </div>
                    </div>
                    <input type="hidden" name="id_prestador" value="<?php echo $id_prestador; ?>">
                </div>
                <div class="div_2">
                    <button type="submit">Enviar Solicitação</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>