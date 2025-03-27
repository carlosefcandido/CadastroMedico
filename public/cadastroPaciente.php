<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Define o conjunto de caracteres como UTF-8 -->
    <meta charset="UTF-8">
    <!-- Configura a viewport para responsividade -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título da página -->
    <title>Cadastro de Pacientes</title>
    <!-- Link para o arquivo de estilos CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Cabeçalho da página -->
    <?php include 'header.php'; ?>
    <!-- Conteúdo principal da página -->

    <!-- Container principal para centralizar o conteúdo -->
    <div class="container">
        <!-- Formulário de cadastro, que envia os dados via método POST para createPaciente.php -->
        <form id="cadastroPacienteForm" action="../src/createPaciente.php" method="POST">
            <!-- Fieldset para agrupar os dados pessoais -->
            <fieldset>
                <legend>Dados do Paciente</legend>

                <label for="nome">Nome completo:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required>

                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" required>

                <label for="genero">Gênero:</label>
                <select id="genero" name="genero" required>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>
            </fieldset>

            <!-- Fieldset para agrupar os dados de contato -->
            <fieldset>
                <legend>Contato</legend>

                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone">

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email">

                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco">
            </fieldset>

            <!-- Botão para submeter o formulário -->
            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <!-- Rodapé da página -->
    <?php include 'footer.php'; ?>
    <!-- Inclusão do arquivo JavaScript para funcionalidades extras -->
    <script src="../assets/js/script.js"></script>
</body>
</html>