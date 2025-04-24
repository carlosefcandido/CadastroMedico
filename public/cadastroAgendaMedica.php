<?php
require_once '../src/db.php';
$conn = connect();

// Busca médicos cadastrados
$medicos = $conn->query("SELECT id, nome, numero_crm FROM medicos")->fetchAll(PDO::FETCH_ASSOC);

$dias_semana = [
    'segunda' => 'Segunda-feira',
    'terca'   => 'Terça-feira',
    'quarta'  => 'Quarta-feira',
    'quinta'  => 'Quinta-feira',
    'sexta'   => 'Sexta-feira',
    'sabado'  => 'Sábado',
    'domingo' => 'Domingo'
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Agenda Médica</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
    <h2>Cadastro de Agenda Médica</h2>
    <form method="POST" action="../src/agenda/createAgenda.php">
        <label for="medico_id">Médico:</label>
        <select name="medico_id" id="medico_id" required>
            <option value="">Selecione</option>
            <?php foreach ($medicos as $med): ?>
                <option value="<?= $med['id'] ?>">
                    <?= htmlspecialchars($med['nome']) ?> (CRM: <?= htmlspecialchars($med['numero_crm']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <label for="duracao_consulta">Duração da consulta (minutos):</label>
        <input type="number" name="duracao_consulta" id="duracao_consulta" min="5" max="180" step="5" required>
        <fieldset>
            <legend>Dias e horários de atendimento</legend>
            <?php foreach ($dias_semana as $key => $label): ?>
                <div style="margin-bottom:10px; border-bottom:1px solid #eee;">
                    <input type="checkbox" name="dias[<?= $key ?>][ativo]" id="dia_<?= $key ?>">
                    <label for="dia_<?= $key ?>"><strong><?= $label ?></strong></label>
                    <div style="margin-left:20px;">
                        <label>Início: <input type="time" name="dias[<?= $key ?>][inicio]"></label>
                        <label>Almoço (início): <input type="time" name="dias[<?= $key ?>][almoco_inicio]"></label>
                        <label>Almoço (fim): <input type="time" name="dias[<?= $key ?>][almoco_fim]"></label>
                        <label>Fim: <input type="time" name="dias[<?= $key ?>][fim]"></label>
                    </div>
                </div>
            <?php endforeach; ?>
        </fieldset>
        <button type="submit">Salvar Agenda</button>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>