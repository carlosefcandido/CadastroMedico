<?php
// Importa o arquivo que contém a função de conexão com o banco de dados
require_once 'db.php';

// Verifica se o parâmetro "id" foi enviado via URL (método GET)
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Armazena o valor do "id" recebido na variável $id

    // Estabelece a conexão com o banco de dados utilizando a função connect() definida em db.php
    $conn = connect();

    // Prepara a query SQL para deletar o registro com o id informado
    $stmt = $conn->prepare("DELETE FROM medicos WHERE id = ?");
    
    // Executa a query passando o id como parâmetro
    if ($stmt->execute([$id])) {
        // Se a exclusão for bem-sucedida, exibe uma página HTML informando o sucesso
        // e redireciona o usuário para a página inicial (index.php) após 5 segundos
        echo "<html lang='pt-BR'>
        <head>
            <meta charset='UTF-8'>
            <title>Cadastro excluído com sucesso!</title>
            <!-- Redireciona para index.php após 5 segundos -->
            <meta http-equiv='refresh' content='5;url=../public/index.php'>
            <style>
                /* Estilos simples para a mensagem de sucesso */
                body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background-color: #f4f4f4; }
                h1 { color: rgb(255, 30, 0); }
            </style>
        </head>
        <body>
            <h1>Cadastro excluído com sucesso!</h1>
            <p>Você será redirecionado para a página inicial em 5 segundos...</p>
        </body>
        </html>";
    } else {
        // Caso haja erro na execução da query de exclusão, captura e exibe a mensagem de erro
        $errorInfo = $stmt->errorInfo();
        echo "Erro ao excluir o registro médico: " . $errorInfo[2];
    }

    // Libera os recursos associados à statement
    $stmt->closeCursor();
    // Fecha a conexão com o banco de dados
    $conn = null;
} else {
    // Se o parâmetro "id" não for fornecido, exibe uma mensagem de erro
    echo "ID do registro médico não fornecido.";
}
?>