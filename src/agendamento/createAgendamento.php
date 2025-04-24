<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connect();

    $medico_id = $_POST['medico_id'];
    $paciente_id = $_POST['paciente_id'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];

    // Verifica se já existe agendamento para o mesmo médico, data e hora
    $stmt = $conn->prepare("SELECT COUNT(*) FROM agendamentos WHERE medico_id = ? AND data = ? AND hora = ?");
    $stmt->execute([$medico_id, $data, $hora]);
    if ($stmt->fetchColumn() > 0) {
        header("Location: ../../public/agendamento.php?erro=Horário+indisponível");
        exit;
    }

    // Insere o agendamento
    $stmt = $conn->prepare("INSERT INTO agendamentos (medico_id, paciente_id, data, hora) VALUES (?, ?, ?, ?)");
    $stmt->execute([$medico_id, $paciente_id, $data, $hora]);

    header("Location: ../../public/agendamento.php?sucesso=Agendamento+realizado");
    exit;
} else {
    header("Location: ../../public/agendamento.php?erro=Requisição+inválida");
    exit;
}