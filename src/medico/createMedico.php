<?php
// Este arquivo processa o cadastro de um novo médico.
// Recebe os dados do formulário, chama a função de criação e exibe mensagem de sucesso ou erro.

require_once './medico/medico_functions.php';

// Verifica se a requisição foi feita via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Monta o array de dados do médico a partir do formulário
    $data = [
        'nome'              => $_POST['nome'],
        'cpf'               => $_POST['cpf'],
        'rg'                => $_POST['rg'],
        'data_nascimento'   => $_POST['data_nascimento'],
        'genero'            => $_POST['genero'],
        'telefone'          => $_POST['telefone'],
        'email'             => $_POST['email'],
        'endereco'          => $_POST['endereco'],
        'numero_crm'        => $_POST['numero_crm'],
        'estado_crm'        => $_POST['estado_crm'],
        'especialidades'    => $_POST['especialidades'],
        'subespecialidades' => $_POST['subespecialidades'],
        'data_emissao_crm'  => $_POST['data_emissao_crm']
    ];
    
    // Chama a função que insere o médico no banco
    $result = createMedico($data);
    
    // Se o cadastro for bem-sucedido, exibe mensagem de sucesso e redireciona
    if ($result === true) {
        echo "<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <title>Cadastro realizado com sucesso!</title>
    <!-- Redireciona para index.html após 5 segundos -->
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
        exit;
    } else {
        // Se ocorrer algum erro, exibe a mensagem de erro
        echo "Erro ao realizar cadastro: " . $result;
    }
}
?>