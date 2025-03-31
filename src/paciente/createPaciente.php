<?php
require_once 'pacienteFunctions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Monta o array com os dados recebidos do formulário
    $data = [
        'nome_completo'         => $_POST['nome_completo'] ?? '',
        'nome_social'           => $_POST['nome_social'] ?? '',
        'cpf'                   => $_POST['cpf'] ?? '',
        'rg'                    => $_POST['rg'] ?? '',
        'cartao_sus'            => $_POST['cartao_sus'] ?? '',
        'data_nascimento'       => $_POST['data_nascimento'] ?? '',
        'genero'                => $_POST['genero'] ?? '',
        'estado_civil'          => $_POST['estado_civil'] ?? '',
        'nacionalidade'         => $_POST['nacionalidade'] ?? '',
        'naturalidade'          => $_POST['naturalidade'] ?? '',
        'telefone_principal'    => $_POST['telefone_principal'] ?? '',
        'telefone_secundario'   => $_POST['telefone_secundario'] ?? '',
        'email'                 => $_POST['email'] ?? '',
        'cep'                   => $_POST['cep'] ?? '',
        'logradouro'            => $_POST['logradouro'] ?? '',
        'numero'                => $_POST['numero'] ?? '',
        'complemento'           => $_POST['complemento'] ?? '',
        'bairro'                => $_POST['bairro'] ?? '',
        'cidade'                => $_POST['cidade'] ?? '',
        'estado'                => $_POST['estado'] ?? '',
        'tipo_sanguineo'        => $_POST['tipo_sanguineo'] ?? '',
        'alergias'              => $_POST['alergias'] ?? '',
        'condicoes_medicas'     => $_POST['condicoes_medicas'] ?? '',
        'medicamentos'          => $_POST['medicamentos'] ?? '',
        'convenio'              => $_POST['convenio'] ?? '',
        'numero_convenio'       => $_POST['numero_convenio'] ?? '',
        'validade_convenio'     => $_POST['validade_convenio'] ?? '',
        'profissao'             => $_POST['profissao'] ?? '',
        'escolaridade'          => $_POST['escolaridade'] ?? '',
        'necessidades_especiais'=> $_POST['necessidades_especiais'] ?? '',
        'consentimento_dados'   => isset($_POST['consentimento_dados']) ? 1 : 0
    ];
    
    $result = createPaciente($data);
    
    if ($result === true) {
        echo "<html lang='pt-BR'>
        <head>
            <meta charset='UTF-8'>
            <title>Paciente cadastrado com sucesso!</title>
            <meta http-equiv='refresh' content='5;url=../../public/index.php'>
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
        echo "Erro ao cadastrar paciente: " . $result;
    }
}
?>