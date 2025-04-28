<?php
// Este arquivo processa o cadastro/atualização da agenda médica de um profissional.
// Ele recebe os dados do formulário de agenda, remove agendas antigas do médico e salva a nova configuração de dias e horários.

require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connect();

    $medico_id = $_POST['medico_id']; // ID do médico selecionado
    $duracao_consulta = $_POST['duracao_consulta']; // Duração padrão da consulta em minutos
    $dias = $_POST['dias'] ?? []; // Array com os dias da semana e horários

    // Remove agendas antigas desse médico (opcional, se for sobrescrever)
    $stmt = $conn->prepare("DELETE FROM agenda_medica WHERE medico_id = ?");
    $stmt->execute([$medico_id]);

    // Salva nova agenda para cada dia da semana selecionado
    foreach ($dias as $dia_semana => $info) {
        if (isset($info['ativo'])) {
            $inicio         = $info['inicio'] ?? null; // Horário inicial do atendimento
            $almoco_inicio  = $info['almoco_inicio'] ?? null; // Início do intervalo de almoço
            $almoco_fim     = $info['almoco_fim'] ?? null; // Fim do intervalo de almoço
            $fim            = $info['fim'] ?? null; // Horário final do atendimento

            // Insere a configuração de agenda para o dia da semana
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

    // Redireciona para a tela de cadastro de agenda com mensagem de sucesso
    header("Location: ../../public/cadastroAgendaMedica.php?sucesso=1");
    exit;
} else {
    // Redireciona para a tela de cadastro de agenda com mensagem de erro se não for POST
    header("Location: ../../public/cadastroAgendaMedica.php?erro=1");
    exit;
}