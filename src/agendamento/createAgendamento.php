<?php
// Este arquivo processa o agendamento de uma consulta médica.
// Recebe os dados do formulário, verifica se o horário está disponível e salva o agendamento.

require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connect();

    $medico_id = $_POST['medico_id']; // ID do médico selecionado
    $paciente_id = $_POST['paciente_id']; // ID do paciente selecionado ou cadastrado
    $data = $_POST['data']; // Data do agendamento
    $hora = $_POST['hora']; // Hora do agendamento

    // Verifica se já existe agendamento para o mesmo médico, data e hora
    $stmt = $conn->prepare("SELECT COUNT(*) FROM agendamentos WHERE medico_id = ? AND data = ? AND hora = ?");
    $stmt->execute([$medico_id, $data, $hora]);
    if ($stmt->fetchColumn() > 0) {
        // Se já houver agendamento, redireciona com mensagem de erro
        header("Location: ../../public/agendamento.php?erro=Horário+indisponível");
        exit;
    }

    // Insere o agendamento no banco de dados
    $stmt = $conn->prepare("INSERT INTO agendamentos (medico_id, paciente_id, data, hora) VALUES (?, ?, ?, ?)");
    $stmt->execute([$medico_id, $paciente_id, $data, $hora]);

    // Redireciona para a tela de agendamento com mensagem de sucesso
    header("Location: ../../public/agendamento.php?sucesso=Agendamento+realizado");
    exit;
} else {
    // Redireciona para a tela de agendamento com mensagem de erro se não for POST
    header("Location: ../../public/agendamento.php?erro=Requisição+inválida");
    exit;
}