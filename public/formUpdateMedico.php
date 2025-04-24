<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../src/db.php';

// Verifica se o ID foi informado na URL via parâmetro GET
if (!isset($_GET['id'])) {
    echo "ID não especificado."; // Exibe mensagem de erro caso não exista o parâmetro 'id'
    exit; // Encerra a execução do script
}

$id = $_GET['id']; // Recebe o ID do registro a ser editado
$conn = connect(); // Estabelece a conexão com o banco de dados

// Prepara a query para obter os dados do registro com o ID informado
$sql = "SELECT * FROM medicos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$record = $stmt->fetch(PDO::FETCH_ASSOC); // Recupera o registro como um array associativo

// Verifica se o registro foi encontrado
if (!$record) {
    echo "Registro não encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Define o conjunto de caracteres da página -->
    <meta charset="UTF-8">
    <!-- Configura a viewport para responsividade -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título da página de edição -->
    <title>Editar Cadastro Médico</title>
    <!-- Link para o arquivo de estilos CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Cabeçalho da página -->
    <?php include 'header.php'; ?>
    <!-- Container principal para centralizar o conteúdo -->
    <div class="container">
        <!-- Formulário para atualizar os dados do registro, que envia os dados via método POST para update.php -->
        <form id="updateForm" action="../src/medico/updateMedico.php" method="POST">
            <!-- Fieldset para agrupar os dados pessoais -->
            <fieldset>
                <legend>Dados Pessoais</legend>
                <!-- Campo oculto para armazenar o ID do registro (necessário para a atualização) -->
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($record['id']); ?>">

                <!-- Campo para o Nome Completo -->
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($record['nome']); ?>" required>

                <!-- Campo para o CPF -->
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($record['cpf']); ?>" required>

                <!-- Campo para o RG -->
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg" value="<?php echo htmlspecialchars($record['rg']); ?>" required>

                <!-- Campo para Data de Nascimento -->
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo htmlspecialchars($record['data_nascimento']); ?>" required>

                <!-- Seleção para o Gênero -->
                <label for="genero">Gênero:</label>
                <select id="genero" name="genero" required>
                    <!-- Se a opção for 'masculino', marca como selecionada -->
                    <option value="masculino" <?php if($record['genero']=='masculino') echo 'selected'; ?>>Masculino</option>
                    <!-- Se a opção for 'feminino', marca como selecionada -->
                    <option value="feminino" <?php if($record['genero']=='feminino') echo 'selected'; ?>>Feminino</option>
                    <!-- Se a opção for 'outro', marca como selecionada -->
                    <option value="outro" <?php if($record['genero']=='outro') echo 'selected'; ?>>Outro</option>
                </select>
            </fieldset>
            <!-- Fieldset para agrupar os dados de Contato -->
            <fieldset>
                <legend>Contato</legend>
                <!-- Campo para Telefone -->
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($record['telefone']); ?>" required>

                <!-- Campo para E-mail -->
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($record['email']); ?>" required>

                <!-- Campo para Endereço -->
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($record['endereco']); ?>" required>
            </fieldset>
            <!-- Fieldset para agrupar os dados do Registro Profissional -->
            <fieldset>
                <legend>Registro Profissional</legend>
                <!-- Campo para o Número do CRM -->
                <label for="numero_crm">Número CRM:</label>
                <input type="text" id="numero_crm" name="numero_crm" value="<?php echo htmlspecialchars($record['numero_crm']); ?>" required>

                <!-- Campo para o Estado do CRM -->
                <label for="estado_crm">Estado CRM:</label>
                <input type="text" id="estado_crm" name="estado_crm" value="<?php echo htmlspecialchars($record['estado_crm']); ?>" required>

                <!-- Campo para as Especialidades -->
                <label for="especialidades">Especialidades:</label>
                <input type="text" id="especialidades" name="especialidades" value="<?php echo htmlspecialchars($record['especialidades']); ?>" required>

                <!-- Campo para as Subespecialidades (opcional) -->
                <label for="subespecialidades">Subespecialidades:</label>
                <input type="text" id="subespecialidades" name="subespecialidades" value="<?php echo htmlspecialchars($record['subespecialidades']); ?>">

                <!-- Campo para a Data de Emissão do CRM -->
                <label for="data_emissao_crm">Data Emissão CRM:</label>
                <input type="date" id="data_emissao_crm" name="data_emissao_crm" value="<?php echo htmlspecialchars($record['data_emissao_crm']); ?>" required>
            </fieldset>
            <!-- Botão para submeter o formulário e atualizar os dados -->
            <button type="submit">Atualizar</button>
        </form>
    </div>
    <!-- Rodapé da página -->
    <?php include 'footer.php'; ?>
    <!-- Inclusão do arquivo JavaScript para funcionalidades extras -->
    <script src="../assets/js/script.js"></script>
</body>
</html>