<?php
// Importa o arquivo com a função de conexão com o banco de dados
require_once '../src/db.php';

/**
 * Função para obter todos os registros médicos do banco de dados.
 *
 * Estabelece a conexão com o banco, executa a query para buscar os dados,
 * converte os resultados para um array associativo e libera os recursos.
 *
 * @return array Lista com os registros médicos.
 */
function getMedicalRecords() {
    // Estabelece a conexão com o banco utilizando a função connect() definida no db.php
    $conn = connect();
    // Define a query para selecionar todos os registros da tabela 'medicos'
    $sql = "SELECT * FROM medicos";
    // Executa a query e obtém o objeto PDOStatement
    $stmt = $conn->query($sql);
    
    // Converte todos os registros em um array associativo
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Libera os recursos da query
    $stmt->closeCursor();
    // Encerra a conexão com o banco (opcional, pois o objeto será descartado)
    $conn = null;
    
    // Retorna o array com os registros médicos
    return $records;
}

// Chama a função e armazena os registros em uma variável para uso no HTML
$medicalRecords = getMedicalRecords();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Define o conjunto de caracteres utilizado na página -->
    <meta charset="UTF-8">
    <!-- Configuração para responsividade da página -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título da página -->
    <title>Cadastro Médico - Lista de Registros</title>
    <!-- Link para o arquivo de estilos CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Cabeçalho da página com título e menu de navegação -->
    <?php include 'header.php'; ?>

    <!-- Container responsivo que envolve a tabela -->
    <div class="table-responsive">
        <!-- Tabela contendo os registros médicos -->
        <table>
            <!-- Cabeçalho da tabela com os nomes das colunas -->
            <thead>
                <tr>
                    <th>Nome Completo</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>Data de Nascimento</th>
                    <th>Gênero</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Endereço</th>
                    <th>CRM</th>
                    <th>Estado CRM</th>
                    <th>Especialidades</th>
                    <th>Subespecialidades</th>
                    <th>Data Emissão CRM</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <!-- Corpo da tabela onde serão iterados os registros -->
            <tbody>
                <!-- Loop que percorre todos os registros médicos -->
                <?php foreach ($medicalRecords as $record): ?>
                    <tr>
                        <!-- Exibe o nome completo -->
                        <td><?php echo htmlspecialchars($record['nome']); ?></td>
                        <!-- Exibe o CPF -->
                        <td><?php echo htmlspecialchars($record['cpf']); ?></td>
                        <!-- Exibe o RG -->
                        <td><?php echo htmlspecialchars($record['rg']); ?></td>
                        <!-- Exibe a data de nascimento formatada como DD/MM/AAAA -->
                        <td><?php echo htmlspecialchars(date("d/m/Y", strtotime($record['data_nascimento']))); ?></td>
                        <!-- Exibe o gênero -->
                        <td><?php echo htmlspecialchars($record['genero']); ?></td>
                        <!-- Exibe o telefone -->
                        <td><?php echo htmlspecialchars($record['telefone']); ?></td>
                        <!-- Exibe o e-mail -->
                        <td><?php echo htmlspecialchars($record['email']); ?></td>
                        <!-- Exibe o endereço completo -->
                        <td><?php echo htmlspecialchars($record['endereco']); ?></td>
                        <!-- Exibe o número do CRM -->
                        <td><?php echo htmlspecialchars($record['numero_crm']); ?></td>
                        <!-- Exibe o estado de emissão do CRM -->
                        <td><?php echo htmlspecialchars($record['estado_crm']); ?></td>
                        <!-- Exibe as especialidades médicas -->
                        <td><?php echo htmlspecialchars($record['especialidades']); ?></td>
                        <!-- Exibe as subespecialidades -->
                        <td><?php echo htmlspecialchars($record['subespecialidades']); ?></td>
                        <!-- Exibe a data de emissão do CRM, formatada como DD/MM/AAAA -->
                        <td><?php echo htmlspecialchars(date("d/m/Y", strtotime($record['data_emissao_crm']))); ?></td>
                        <!-- Ações para editar ou excluir o registro -->
                        <td>
                            <!-- Link para editar o registro, passando o ID pela URL -->
                            <a href="formUpdateMedico.php?id=<?php echo $record['id']; ?>">Editar</a>
                            <!-- Link para excluir o registro, passando o ID pela URL e confirmando via JavaScript -->
                            <a href="../src/medico/deleteMedico.php?id=<?php echo $record['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir esse registro?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; // Fim do loop que percorre os registros ?>
            </tbody>
        </table>
    </div>

    <!-- Rodapé da página -->
    <?php include 'footer.php'; ?>
    <!-- Inclusão do arquivo JavaScript para funcionalidades extras -->
    <script src="../assets/js/script.js"></script>
</body>
</html>