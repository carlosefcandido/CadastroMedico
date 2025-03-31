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

    <!-- Container principal para centralizar o conteúdo -->
    <div class="container">
        <!-- Formulário de cadastro, que envia os dados via método POST para create.php -->
        <form id="cadastroPacienteForm" action="../src/paciente/createPaciente.php" method="POST">
            <!-- Fieldset para agrupar os dados pessoais -->
            <fieldset>
                <legend>Dados Pessoais</legend>

                <!-- Campo para o nome completo -->
                <label for="nome_completo">Nome completo:</label>
                <input type="text" id="nome_completo" name="nome_completo" required>

                <!-- Campo para nome social (opcional) -->
                <label for="nome_social">Nome social:</label>
                <input type="text" id="nome_social" name="nome_social">

                <!-- Campo para o CPF -->
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00">

                <!-- Campo para o RG -->
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg" required>

                <!-- Campo para o Cartão do SUS -->
                <label for="cartao_sus">Número do Cartão do SUS:</label>
                <input type="text" id="cartao_sus" name="cartao_sus">

                <!-- Campo para a data de nascimento -->
                <label for="data_nascimento">Data de nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" required>

                <!-- Seleção para o gênero -->
                <label for="genero">Gênero:</label>
                <select id="genero" name="genero" required>
                    <option value="">Selecione</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </select>

                <!-- Campo para estado civil -->
                <label for="estado_civil">Estado Civil:</label>
                <select id="estado_civil" name="estado_civil">
                    <option value="">Selecione</option>
                    <option value="solteiro">Solteiro(a)</option>
                    <option value="casado">Casado(a)</option>
                    <option value="divorciado">Divorciado(a)</option>
                    <option value="viuvo">Viúvo(a)</option>
                    <option value="uniao_estavel">União Estável</option>
                </select>

                <!-- Campo para nacionalidade -->
                <label for="nacionalidade">Nacionalidade:</label>
                <input type="text" id="nacionalidade" name="nacionalidade">

                <!-- Campo para naturalidade -->
                <label for="naturalidade">Naturalidade:</label>
                <input type="text" id="naturalidade" name="naturalidade">
            </fieldset>

            <!-- Fieldset para agrupar os dados de contato -->
            <fieldset>
                <legend>Contato</legend>

                <!-- Campo para o telefone principal -->
                <label for="telefone_principal">Telefone Principal:</label>
                <input type="tel" id="telefone_principal" name="telefone_principal" required placeholder="(00) 00000-0000">

                <!-- Campo para o telefone secundário -->
                <label for="telefone_secundario">Telefone Secundário/Recado:</label>
                <input type="tel" id="telefone_secundario" name="telefone_secundario" placeholder="(00) 00000-0000">

                <!-- Campo para o email -->
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email">

                <!-- Campos de endereço detalhados -->
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" placeholder="00000-000">

                <label for="logradouro">Logradouro:</label>
                <input type="text" id="logradouro" name="logradouro" required>

                <label for="numero">Número:</label>
                <input type="text" id="numero" name="numero" required>

                <label for="complemento">Complemento:</label>
                <input type="text" id="complemento" name="complemento">

                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" required>

                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" required>

                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="">Selecione</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
            </fieldset>

            <!-- Fieldset para informações de emergência -->
            <fieldset>
                <legend>Contato de Emergência</legend>

                <label for="nome_emergencia">Nome do Contato:</label>
                <input type="text" id="nome_emergencia" name="nome_emergencia">

                <label for="parentesco_emergencia">Parentesco:</label>
                <input type="text" id="parentesco_emergencia" name="parentesco_emergencia">

                <label for="telefone_emergencia">Telefone de Emergência:</label>
                <input type="tel" id="telefone_emergencia" name="telefone_emergencia" placeholder="(00) 00000-0000">
            </fieldset>

            <!-- Fieldset para dados de saúde -->
            <fieldset>
                <legend>Informações de Saúde</legend>

                <label for="tipo_sanguineo">Tipo Sanguíneo:</label>
                <select id="tipo_sanguineo" name="tipo_sanguineo">
                    <option value="">Selecione</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>

                <label for="alergias">Alergias:</label>
                <textarea id="alergias" name="alergias" placeholder="Liste suas alergias"></textarea>

                <label for="condicoes_medicas">Condições Médicas Preexistentes:</label>
                <textarea id="condicoes_medicas" name="condicoes_medicas" placeholder="Liste suas condições médicas"></textarea>

                <label for="medicamentos">Medicamentos em Uso:</label>
                <textarea id="medicamentos" name="medicamentos" placeholder="Liste os medicamentos que está tomando"></textarea>
            </fieldset>

            <!-- Fieldset para dados administrativos -->
            <fieldset>
                <legend>Dados Administrativos</legend>

                <label for="convenio">Convênio Médico:</label>
                <input type="text" id="convenio" name="convenio">

                <label for="numero_convenio">Número do Convênio:</label>
                <input type="text" id="numero_convenio" name="numero_convenio">

                <label for="validade_convenio">Validade do Convênio:</label>
                <input type="date" id="validade_convenio" name="validade_convenio">
            </fieldset>

            <!-- Fieldset para informações adicionais -->
            <fieldset>
                <legend>Informações Complementares</legend>

                <label for="profissao">Profissão:</label>
                <input type="text" id="profissao" name="profissao">

                <label for="escolaridade">Escolaridade:</label>
                <select id="escolaridade" name="escolaridade">
                    <option value="">Selecione</option>
                    <option value="fundamental_incompleto">Fundamental Incompleto</option>
                    <option value="fundamental_completo">Fundamental Completo</option>
                    <option value="medio_incompleto">Médio Incompleto</option>
                    <option value="medio_completo">Médio Completo</option>
                    <option value="superior_incompleto">Superior Incompleto</option>
                    <option value="superior_completo">Superior Completo</option>
                    <option value="pos_graduacao">Pós-Graduação</option>
                </select>

                <label for="necessidades_especiais">Necessidades Especiais:</label>
                <textarea id="necessidades_especiais" name="necessidades_especiais" placeholder="Descreva suas necessidades especiais, se houver"></textarea>
            </fieldset>

            <!-- Consentimento para tratamento de dados -->
            <fieldset>
                <legend>Consentimento</legend>
                <input type="checkbox" id="consentimento_dados" name="consentimento_dados" required>
                <label for="consentimento_dados">Li e concordo com o tratamento dos meus dados pessoais conforme a Lei Geral de Proteção de Dados (LGPD)</label>
            </fieldset>

            <!-- Botão para submeter o formulário -->
            <button type="submit">Cadastrar Paciente</button>
        </form>
    </div>

    <!-- Rodapé da página -->
    <?php include 'footer.php'; ?>

    <!-- Inclusão do arquivo JavaScript para validações -->
    <script src="../assets/js/script.js"></script>
</body>
</html>