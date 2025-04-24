<?php
require_once '../src/db.php';

// Busca especialidades e médicos para os filtros
$conn = connect();
$especialidades = $conn->query("SELECT DISTINCT especialidades FROM medicos")->fetchAll(PDO::FETCH_COLUMN);
$medicos = $conn->query("SELECT id, nome, especialidades FROM medicos")->fetchAll(PDO::FETCH_ASSOC);

// Função para buscar horários vagos
function buscarHorariosVagos($conn, $especialidade = '', $medico_id = '', $data_inicio = '', $data_fim = '') {
    $horarios_vagos = [];

    // Filtra médicos pela especialidade ou médico específico
    $query = "SELECT m.id, m.nome, m.especialidades FROM medicos m WHERE 1=1";
    $params = [];
    if ($especialidade) {
        $query .= " AND m.especialidades = ?";
        $params[] = $especialidade;
    }
    if ($medico_id) {
        $query .= " AND m.id = ?";
        $params[] = $medico_id;
    }
    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    $medicos_filtrados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mapeamento dos dias da semana em inglês para português (ajuste conforme o que está no banco)
    $mapa_dias = [
        'monday'    => 'segunda',
        'tuesday'   => 'terca',
        'wednesday' => 'quarta',
        'thursday'  => 'quinta',
        'friday'    => 'sexta',
        'saturday'  => 'sabado',
        'sunday'    => 'domingo'
    ];

    foreach ($medicos_filtrados as $medico) {
        // Busca agenda do médico
        $agenda = $conn->prepare("SELECT * FROM agenda_medica WHERE medico_id = ?");
        $agenda->execute([$medico['id']]);
        $dias = $agenda->fetchAll(PDO::FETCH_ASSOC);

        foreach ($dias as $dia) {
            // Gera datas dentro do período para o dia da semana
            $inicio_periodo = $data_inicio ?: date('Y-m-d');
            $fim_periodo = $data_fim ?: date('Y-m-d', strtotime('+14 days'));
            $data = $inicio_periodo;
            while ($data <= $fim_periodo) {
                $dia_php = strtolower(date('l', strtotime($data))); // ex: monday
                if (isset($mapa_dias[$dia_php]) && $mapa_dias[$dia_php] == strtolower($dia['dia_semana'])) {
                    $inicio = $dia['inicio'];
                    $fim = $dia['fim'];
                    $duracao = $dia['duracao_consulta'];
                    $almoco_inicio = $dia['almoco_inicio'];
                    $almoco_fim = $dia['almoco_fim'];
                    $hora_atual = $inicio;
                    while ($hora_atual < $fim) {
                        if ($almoco_inicio && $almoco_fim && $hora_atual >= $almoco_inicio && $hora_atual < $almoco_fim) {
                            $hora_atual = $almoco_fim;
                            continue;
                        }
                        $agendado = $conn->prepare("SELECT COUNT(*) FROM agendamentos WHERE medico_id = ? AND data = ? AND hora = ?");
                        $agendado->execute([$medico['id'], $data, $hora_atual]);
                        if ($agendado->fetchColumn() == 0) {
                            $horarios_vagos[] = [
                                'medico' => $medico['nome'],
                                'especialidade' => $medico['especialidades'],
                                'data' => $data,
                                'hora' => $hora_atual
                            ];
                        }
                        $hora_atual = date('H:i', strtotime("+$duracao minutes", strtotime($hora_atual)));
                    }
                }
                $data = date('Y-m-d', strtotime('+1 day', strtotime($data)));
            }
        }
    }
    return $horarios_vagos;
}

// Busca paciente se CPF informado
$paciente = null;
if (isset($_GET['cpf'])) {
    $stmt = $conn->prepare("SELECT * FROM pacientes WHERE cpf = ?");
    $stmt->execute([$_GET['cpf']]);
    $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendamento Médico</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
    <h2>Agendamento Médico</h2>
    <!-- Filtro por especialidade ou médico -->
    <form method="GET" action="agendamento.php">
        <label for="especialidade">Especialidade:</label>
        <select name="especialidade" id="especialidade">
            <option value="">Todas</option>
            <?php foreach ($especialidades as $esp): ?>
                <option value="<?= htmlspecialchars($esp) ?>" <?= (isset($_GET['especialidade']) && $_GET['especialidade'] == $esp) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($esp) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="medico">Médico:</label>
        <select name="medico" id="medico">
            <option value="">Todos</option>
            <?php foreach ($medicos as $med): ?>
                <option value="<?= $med['id'] ?>" <?= (isset($_GET['medico']) && $_GET['medico'] == $med['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($med['nome']) ?> (<?= htmlspecialchars($med['especialidades']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <label for="data_inicio">De:</label>
        <input type="date" name="data_inicio" id="data_inicio" value="<?= isset($_GET['data_inicio']) ? htmlspecialchars($_GET['data_inicio']) : '' ?>">

        <label for="data_fim">Até:</label>
        <input type="date" name="data_fim" id="data_fim" value="<?= isset($_GET['data_fim']) ? htmlspecialchars($_GET['data_fim']) : '' ?>">
        <button type="submit">Filtrar</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && (isset($_GET['especialidade']) || isset($_GET['medico']))) {
        $especialidade = $_GET['especialidade'] ?? '';
        $medico_id = $_GET['medico'] ?? '';
        $data_inicio = $_GET['data_inicio'] ?? '';
        $data_fim = $_GET['data_fim'] ?? '';
        $horarios_vagos = buscarHorariosVagos($conn, $especialidade, $medico_id, $data_inicio, $data_fim);

        echo '<h3>Horários disponíveis:</h3>';
        if (count($horarios_vagos) > 0) {
            echo '<table border="1" id="tabelaHorarios" style="cursor:pointer">';
            echo '<tr><th>Data</th><th>Hora</th><th>Médico</th><th>Especialidade</th></tr>';
            foreach ($horarios_vagos as $h) {
                $data_formatada = (new DateTime($h['data']))->format('d/m/Y');
                $hora_formatada = substr($h['hora'], 0, 5); // hh:mm

                echo '<tr class="linha-horario" 
                    data-medico="'.htmlspecialchars($h['medico']).'" 
                    data-medicoid="'.htmlspecialchars(array_search($h['medico'], array_column($medicos, 'nome')) !== false ? $medicos[array_search($h['medico'], array_column($medicos, 'nome'))]['id'] : '').'" 
                    data-data="'.htmlspecialchars($h['data']).'" 
                    data-hora="'.htmlspecialchars($h['hora']).'">';
                echo '<td>'.htmlspecialchars($data_formatada).'</td>';
                echo '<td>'.htmlspecialchars($hora_formatada).'</td>';
                echo '<td>'.htmlspecialchars($h['medico']).'</td>';
                echo '<td>'.htmlspecialchars($h['especialidade']).'</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>Nenhum horário disponível encontrado.</p>';
        }
    }
    ?>

    <!-- Busca paciente por CPF -->
    <form method="GET" action="agendamento.php" style="margin-top:20px;">
        <label for="cpf">Buscar paciente por CPF:</label>
        <input type="text" name="cpf" id="cpf" placeholder="000.000.000-00" value="<?= isset($_GET['cpf']) ? htmlspecialchars($_GET['cpf']) : '' ?>">
        <!-- Mantém os filtros ao buscar paciente -->
        <input type="hidden" name="especialidade" value="<?= isset($_GET['especialidade']) ? htmlspecialchars($_GET['especialidade']) : '' ?>">
        <input type="hidden" name="medico" value="<?= isset($_GET['medico']) ? htmlspecialchars($_GET['medico']) : '' ?>">
        <input type="hidden" name="data_inicio" value="<?= isset($_GET['data_inicio']) ? htmlspecialchars($_GET['data_inicio']) : '' ?>">
        <input type="hidden" name="data_fim" value="<?= isset($_GET['data_fim']) ? htmlspecialchars($_GET['data_fim']) : '' ?>">
        <button type="submit">Buscar</button>
    </form>

    <?php if ($paciente): ?>
        <p><strong>Paciente encontrado:</strong> <?= htmlspecialchars($paciente['nome_completo']) ?> (<?= htmlspecialchars($paciente['cpf']) ?>)</p>
    <?php elseif (isset($_GET['cpf'])): ?>
        <p style="color:red;">Paciente não encontrado. Preencha os dados abaixo para cadastrar.</p>
    <?php endif; ?>

    <!-- Formulário de agendamento -->
    <form method="POST" action="../src/agendamento/createAgendamento.php" style="margin-top:20px;">
        <fieldset>
            <legend>Dados do Paciente</legend>
            <input type="hidden" name="paciente_id" value="<?= $paciente['id'] ?? '' ?>">
            <label for="nome_completo">Nome completo:</label>
            <input type="text" id="nome_completo" name="nome_completo" required value="<?= $paciente['nome_completo'] ?? '' ?>">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required value="<?= $paciente['cpf'] ?? ($_GET['cpf'] ?? '') ?>">
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" required value="<?= $paciente['telefone_principal'] ?? '' ?>">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?= $paciente['email'] ?? '' ?>">
        </fieldset>
        <fieldset>
            <legend>Agendamento</legend>
            <label for="medico_id">Médico:</label>
            <select name="medico_id" id="medico_id" required>
                <option value="">Selecione</option>
                <?php foreach ($medicos as $med): ?>
                    <option value="<?= $med['id'] ?>" <?= (isset($_GET['medico']) && $_GET['medico'] == $med['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($med['nome']) ?> (<?= htmlspecialchars($med['especialidades']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="data">Data:</label>
            <input type="date" name="data" id="data" required>
            <label for="hora">Hora:</label>
            <input type="time" name="hora" id="hora" required>
            <!-- Aqui você pode implementar via JS/AJAX a busca de horários livres conforme médico/data -->
        </fieldset>
        <button type="submit">Agendar</button>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.linha-horario').forEach(function(row) {
            row.addEventListener('click', function() {
                document.getElementById('data').value = this.getAttribute('data-data');
                document.getElementById('hora').value = this.getAttribute('data-hora');
                document.getElementById('medico_id').value = this.getAttribute('data-medicoid');
                window.scrollTo({ top: document.getElementById('data').offsetTop - 100, behavior: 'smooth' });
            });
        });
    });
    </script>
    
</div>
<?php include 'footer.php'; ?>
</body>
</html>