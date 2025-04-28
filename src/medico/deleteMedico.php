<?php
// Este arquivo processa a exclusão de um médico pelo ID recebido via GET.
// Chama a função de exclusão e exibe mensagem de sucesso ou erro.

require_once './medico_functions.php';

// Verifica se o parâmetro "id" foi enviado via URL (método GET)
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Armazena o valor do "id" recebido na variável $id

    // Chama a função que exclui o médico do banco
    $result = deleteMedico($id);
    
    // Se a exclusão for bem-sucedida, exibe mensagem de sucesso e redireciona
    if ($result === true) {
        echo "<html lang='pt-BR'>
        <head>
            <meta charset='UTF-8'>
            <title>Cadastro excluído com sucesso!</title>
            <!-- Redireciona para index.php após 5 segundos -->
            <meta http-equiv='refresh' content='5;url=../../public/index.php'>
            <style>
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
        // Caso haja erro na execução da query de exclusão, exibe a mensagem de erro
        echo "Erro ao excluir o registro médico: " . $result;
    }

} else {
    // Se o parâmetro "id" não for fornecido, exibe uma mensagem de erro
    echo "ID do registro médico não fornecido.";
}
?>