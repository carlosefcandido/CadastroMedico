<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Define o conjunto de caracteres como UTF-8 -->
    <meta charset="UTF-8">
    <!-- Configura a viewport para responsividade -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título da página -->
    <title>Cadastro Médico</title>
    <!-- Link para o arquivo de estilos CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
   <!-- Cabeçalho da página -->
   <?php include 'header.php'; ?>

    <!-- Container principal para centralizar o conteúdo -->
    <div class="container">
        <!-- Formulário de cadastro, que envia os dados via método POST para create.php -->
        <form id="cadastroForm" action="../src/medico/createMedico.php" method="POST">
            <!-- Fieldset para agrupar os dados pessoais -->
            <fieldset>
                <legend>Dados Pessoais</legend>

                <!-- Campo para o nome completo -->
                <label for="nome">Nome completo:</label>
                <input type="text" id="nome" name="nome" required>

                <!-- Campo para o CPF-->
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required>

                <!-- Campo para o RG-->
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg" required>

                <!-- Campo para a data de nascimento -->
                <label for="data_nascimento">Data de nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" required>

                <!-- Seleção para o gênero -->
                <label for="genero">Gênero:</label>
                <select id="genero" name="genero" required>
                    <!-- Opção Masculino -->
                    <option value="masculino">Masculino</option>
                    <!-- Opção Feminino -->
                    <option value="feminino">Feminino</option>
                    <!-- Opção Outro -->
                    <option value="outro">Outro</option>
                </select>
            </fieldset>

            <!-- Fieldset para agrupar os dados de contato -->
            <fieldset>
                <legend>Contato</legend>

                <!-- Campo para o telefone -->
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" required>

                <!-- Campo para o email -->
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <!-- Campo para o endereço completo, com placeholder de exemplo -->
                <label for="endereco">Endereço completo:</label>
                <input type="text" id="endereco" name="endereco" placeholder="CEP, Rua, Número, Complemento, Bairro, Cidade, Estado" required>
            </fieldset>

            <!-- Fieldset para agrupar os dados do registro profissional -->
            <fieldset>
                <legend>Registro Profissional</legend>

                <!-- Campo para o número do CRM -->
                <label for="crm">Número do CRM:</label>
                <input type="text" id="numero_crm" name="numero_crm" required>

                <!-- Campo para o estado de emissão do CRM -->
                <label for="estado_crm">Estado de emissão do CRM:</label>
                <input type="text" id="estado_crm" name="estado_crm" required>

                <!-- Campo para as especialidades médicas -->
                <label for="especialidades">Especialidades médicas:</label>
                <input type="text" id="especialidades" name="especialidades" required>

                <!-- Campo para as subespecialidades (opcional) -->
                <label for="subespecialidades">Subespecialidades:</label>
                <input type="text" id="subespecialidades" name="subespecialidades">

                <!-- Campo para a data de emissão do CRM -->
                <label for="data_emissao_crm">Data de emissão do CRM:</label>
                <input type="date" id="data_emissao_crm" name="data_emissao_crm" required>
            </fieldset>

            <!-- Botão para submeter o formulário -->
            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <!-- Rodapé da página -->
    <?php include 'footer.php'; ?>

    <!-- Inclusão do arquivo JavaScript externo -->
    <script src="../assets/js/script.js"></script>
</body>
</html>