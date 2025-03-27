<?php
// Importa o arquivo de conexão com o banco de dados
require_once 'db.php';

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados enviados pelo formulário
    $nome            = $_POST['nome'];
    $cpf             = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $genero          = $_POST['genero'];
    $telefone        = $_POST['telefone'];
    $email           = $_POST['email'];
    $endereco        = $_POST['endereco'];

    // Conecta ao banco de dados
    $conn = connect();

    // Prepara a query INSERT utilizando placeholders para segurança
    $sql = "INSERT INTO pacientes (nome, cpf, data_nascimento, genero, telefone, email, endereco)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $params = [
        $nome,
        $cpf,
        $data_nascimento,
        $genero,
        $telefone,
        $email,
        $endereco
    ];

    // Executa a query de inserção dos dados
    if ($stmt->execute($params)) {
        // Exibe mensagem de sucesso e redirecionamento após 5 segundos
        echo "<html lang='pt-BR'>
        <head>
            <meta charset='UTF-8'>
            <title>Paciente cadastrado com sucesso!</title>
            <!-- Redireciona para index.php após 5 segundos -->
            <meta http-equiv='refresh' content='5;url=../public/index.php'>
            <style>
                body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background-color: #f4f4f4; }
                h1 { color: #007BFF; }
            </style>
        </head>
        <body>
            <h1>Paciente cadastrado com sucesso!</h1>
            <p>Você será redirecionado para a página inicial em 5 segundos...</p>
        </body>
        </html>";
        exit;
    } else {
        // Exibe a mensagem de erro caso ocorra falha na inserção
        $errorInfo = $stmt->errorInfo();
        echo "Erro ao cadastrar paciente: " . $errorInfo[2];
    }

    // Libera os recursos e fecha a conexão
    $stmt->closeCursor();
    $conn = null;
}
?>