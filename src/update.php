<?php
require_once 'db.php';

// Verifica se o método de requisição é POST para processar os dados enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera os dados enviados no formulário via método POST
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $data_nascimento = $_POST['data_nascimento'];
    $genero = $_POST['genero'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $crm = $_POST['numero_crm'];         // Número do CRM
    $estado_crm = $_POST['estado_crm'];
    $especialidades = $_POST['especialidades'];
    $subespecialidades = $_POST['subespecialidades'];
    $data_emissao_crm = $_POST['data_emissao_crm'];

    // Estabelece a conexão com o banco de dados, usando a função connect() definida em db.php
    $conn = connect();

    // Prepara a query SQL para atualizar os dados do registro no banco de dados
    // Utiliza placeholders (?) para prevenir injeção de SQL
    $sql = "UPDATE medicos SET 
                nome = ?, 
                cpf = ?, 
                rg = ?, 
                data_nascimento = ?, 
                genero = ?, 
                telefone = ?, 
                email = ?, 
                endereco = ?, 
                numero_crm = ?, 
                estado_crm = ?, 
                especialidades = ?, 
                subespecialidades = ?, 
                data_emissao_crm = ? 
            WHERE id = ?";

    // Prepara a declaração (statement) usando a conexão PDO
    $stmt = $conn->prepare($sql);

    // Agrupa os parâmetros num array na ordem em que os placeholders aparecem na query
    $params = [
        $nome,                // Nome
        $cpf,                 // CPF
        $rg,                  // RG
        $data_nascimento,     // Data de Nascimento
        $genero,              // Gênero
        $telefone,            // Telefone
        $email,               // E-mail
        $endereco,            // Endereço
        $crm,                 // Número do CRM
        $estado_crm,          // Estado do CRM
        $especialidades,      // Especialidades
        $subespecialidades,   // Subespecialidades
        $data_emissao_crm,    // Data de Emissão do CRM
        $id                   // ID do registro a ser atualizado
    ];

    // Executa a query de atualização com os parâmetros fornecidos
    if ($stmt->execute($params)) {
        // Se a atualização ocorrer com sucesso, exibe uma página HTML com mensagem de sucesso
        // e utiliza meta tag para redirecionar para a página inicial após 5 segundos
        echo "<html lang='pt-BR'>
        <head>
            <meta charset='UTF-8'>
            <title>Cadastro atualizado com sucesso!</title>
            <!-- Redireciona para index.php após 5 segundos -->
            <meta http-equiv='refresh' content='5;url=../public/index.php'>
            <style>
                /* Estilos simples para a mensagem de sucesso e layout da página */
                body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background-color: #f4f4f4; }
                h1 { color: #007BFF; }
            </style>
        </head>
        <body>
            <h1>Cadastro realizado com sucesso!</h1>
            <p>Você será redirecionado para a página inicial em 5 segundos...</p>
        </body>
        </html>";
    } else {
        // Em caso de erro na execução, captura o erro via errorInfo() e exibe a mensagem de erro
        $errorInfo = $stmt->errorInfo();
        echo "Erro ao atualizar o registro: " . $errorInfo[2];
    }

    // Libera os recursos associados à declaração
    $stmt->closeCursor();
    // Fecha a conexão com o banco de dados
    $conn = null;
} else {
    // Se o método da requisição não for POST, exibe uma mensagem de erro
    echo "Método de requisição inválido.";
}
?>