<?php
// Importa o arquivo de conexão com o banco de dados
require_once 'db.php';

// Verifica se a requisição foi feita via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera os dados enviados pelo formulário e os atribui a variáveis
    $nome              = $_POST['nome'];              // Nome completo do médico
    $cpf               = $_POST['cpf'];               // CPF
    $rg                = $_POST['rg'];                // RG
    $data_nascimento   = $_POST['data_nascimento'];   // Data de nascimento
    $genero            = $_POST['genero'];            // Gênero
    $telefone          = $_POST['telefone'];          // Telefone
    $email             = $_POST['email'];             // E-mail
    $endereco          = $_POST['endereco'];          // Endereço completo
    $numero_crm        = $_POST['numero_crm'];        // Número do CRM
    $estado_crm        = $_POST['estado_crm'];        // Estado de emissão do CRM
    $especialidades    = $_POST['especialidades'];    // Especialidades médicas
    $subespecialidades = $_POST['subespecialidades']; // Subespecialidades (se houver)
    $data_emissao_crm  = $_POST['data_emissao_crm'];  // Data de emissão do CRM

    // Estabelece a conexão com o banco de dados utilizando a função connect() definida em db.php
    $conn = connect();

    // Prepara a query de INSERT. A utilização de placeholders (?) é uma boa prática para prevenir SQL Injection
    $stmt = $conn->prepare("INSERT INTO medicos (nome, cpf, rg, data_nascimento, genero, telefone, email, endereco, numero_crm, estado_crm, especialidades, subespecialidades, data_emissao_crm) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Agrupa os parâmetros em um array na mesma ordem dos placeholders na query
    $params = [
        $nome, 
        $cpf, 
        $rg, 
        $data_nascimento, 
        $genero, 
        $telefone, 
        $email, 
        $endereco, 
        $numero_crm, 
        $estado_crm, 
        $especialidades, 
        $subespecialidades, 
        $data_emissao_crm
    ];
    
    // Executa a query e, se bem-sucedida, exibe a mensagem e redireciona para home após alguns segundos.
    if ($stmt->execute($params)) {
        echo "<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <title>Cadastro realizado com sucesso!</title>
    <!-- Redireciona para index.html após 5 segundos -->
    <meta http-equiv='refresh' content='5;url=../public/index.html'>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background-color: #f4f4f4; }
        h1 { color: #007BFF; }
    </style>
</head>
<body>
    <h1>Cadastro realizado com sucesso!</h1>
    <p>Você será redirecionado para a página inicial em 5 segundos...</p>
</body>
</html>";
        exit;
    } else {
        // Se ocorrer algum erro, captura a mensagem de erro e exibe
        $errorInfo = $stmt->errorInfo();
        echo "Erro ao realizar cadastro: " . $errorInfo[2];
    }

    // Libera os recursos associados à query
    $stmt->closeCursor();

    // Fecha a conexão com o banco de dados
    $conn = null;
}
?>