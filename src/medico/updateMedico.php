<?php
// Este arquivo processa a atualização dos dados de um médico existente.
// Recebe os dados do formulário, chama a função de atualização e exibe mensagem de sucesso ou erro.

require_once '../medico/medico_functions.php';

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

    // Chama a função que atualiza o médico no banco
    $result = updateMedico($id, [
        'nome' => $nome,
        'cpf' => $cpf,
        'rg' => $rg,
        'data_nascimento' => $data_nascimento,
        'genero' => $genero,
        'telefone' => $telefone,
        'email' => $email,
        'endereco' => $endereco,
        'numero_crm' => $crm,
        'estado_crm' => $estado_crm,
        'especialidades' => $especialidades,
        'subespecialidades' => $subespecialidades,
        'data_emissao_crm' => $data_emissao_crm
    ]);

    // Se a atualização ocorrer com sucesso, exibe mensagem de sucesso e redireciona
    if ($result === true) {
        echo "<html lang='pt-BR'>
        <head>
            <meta charset='UTF-8'>
            <title>Cadastro atualizado com sucesso!</title>
            <!-- Redireciona para index.php após 5 segundos -->
            <meta http-equiv='refresh' content='5;url=../../public/index.php'>
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
    } else {
        // Em caso de erro na execução, exibe a mensagem de erro
        echo "Erro ao atualizar o registro: " . $result;
    }

} else {
    // Se o método da requisição não for POST, exibe uma mensagem de erro
    echo "Método de requisição inválido.";
}
?>