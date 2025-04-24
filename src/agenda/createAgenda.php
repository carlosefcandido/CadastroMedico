<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connect();

    $medico_id = $_POST['medico_id'];
    $duracao_consulta = $_POST['duracao_consulta'];
    $dias = $_POST['dias'] ?? [];

    // Remove agendas antigas desse médico (opcional, se for sobrescrever)
    $stmt = $conn->prepare("DELETE FROM agenda_medica WHERE medico_id = ?");
    $stmt->execute([$medico_id]);

    // Salva nova agenda
    foreach ($dias as $dia_semana => $info) {
        if (isset($info['ativo'])) {
            $inicio         = $info['inicio'] ?? null;
            $almoco_inicio  = $info['almoco_inicio'] ?? null;
            $almoco_fim     = $info['almoco_fim'] ?? null;
            $fim            = $info['fim'] ?? null;

            $stmt = $conn->prepare("INSERT INTO agenda_medica 
                (medico_id, dia_semana, inicio, almoco_inicio, almoco_fim, fim, duracao_consulta) 
                VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $medico_id,
                $dia_semana,
                $inicio,
                $almoco_inicio,
                $almoco_fim,
                $fim,
                $duracao_consulta
            ]);
        }
    }

    header("Location: ../../public/cadastroAgendaMedica.php?sucesso=1");
    exit;
} else {
    header("Location: ../../public/cadastroAgendaMedica.php?erro=1");
    exit;
}