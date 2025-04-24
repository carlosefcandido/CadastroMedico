<?php
require_once __DIR__ . '/../db.php';

function createPaciente($data) {
    // Conecta ao banco de dados
    $conn = connect();
    
    // Prepara a query para inserir os dados do paciente
    $stmt = $conn->prepare("INSERT INTO pacientes (
        nome_completo, nome_social, cpf, rg, cartao_sus, data_nascimento, genero, estado_civil, 
        nacionalidade, naturalidade, telefone_principal, telefone_secundario, email, cep, 
        logradouro, numero, complemento, bairro, cidade, estado, tipo_sanguineo, alergias, 
        condicoes_medicas, medicamentos, convenio, numero_convenio, validade_convenio, profissao, 
        escolaridade, necessidades_especiais, consentimento_dados
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $params = [
        $data['nome_completo'],
        $data['nome_social'],
        $data['cpf'],
        $data['rg'],
        $data['cartao_sus'],
        $data['data_nascimento'],
        $data['genero'],
        $data['estado_civil'],
        $data['nacionalidade'],
        $data['naturalidade'],
        $data['telefone_principal'],
        $data['telefone_secundario'],
        $data['email'],
        $data['cep'],
        $data['logradouro'],
        $data['numero'],
        $data['complemento'],
        $data['bairro'],
        $data['cidade'],
        $data['estado'],
        $data['tipo_sanguineo'],
        $data['alergias'],
        $data['condicoes_medicas'],
        $data['medicamentos'],
        $data['convenio'],
        $data['numero_convenio'],
        $data['validade_convenio'],
        $data['profissao'],
        $data['escolaridade'],
        $data['necessidades_especiais'],
        isset($data['consentimento_dados']) ? 1 : 0
    ];
    
    if ($stmt->execute($params)) {
        $stmt->closeCursor();
        $conn = null;
        return true;
    } else {
        $errorInfo = $stmt->errorInfo();
        $stmt->closeCursor();
        $conn = null;
        return $errorInfo[2];
    }
}

function updatePaciente($id, $data) {
    $conn = connect();

    // Prepara a query para atualizar os dados do paciente
    $stmt = $conn->prepare("UPDATE pacientes SET 
        nome_completo = ?, nome_social = ?, cpf = ?, rg = ?, cartao_sus = ?, data_nascimento = ?, 
        genero = ?, estado_civil = ?, nacionalidade = ?, naturalidade = ?, telefone_principal = ?, 
        telefone_secundario = ?, email = ?, cep = ?, logradouro = ?, numero = ?, complemento = ?, 
        bairro = ?, cidade = ?, estado = ?, tipo_sanguineo = ?, alergias = ?, condicoes_medicas = ?, 
        medicamentos = ?, convenio = ?, numero_convenio = ?, validade_convenio = ?, profissao = ?, 
        escolaridade = ?, necessidades_especiais = ?, consentimento_dados = ?
        WHERE id = ?");
    
    $params = [
        $data['nome_completo'],
        $data['nome_social'],
        $data['cpf'],
        $data['rg'],
        $data['cartao_sus'],
        $data['data_nascimento'],
        $data['genero'],
        $data['estado_civil'],
        $data['nacionalidade'],
        $data['naturalidade'],
        $data['telefone_principal'],
        $data['telefone_secundario'],
        $data['email'],
        $data['cep'],
        $data['logradouro'],
        $data['numero'],
        $data['complemento'],
        $data['bairro'],
        $data['cidade'],
        $data['estado'],
        $data['tipo_sanguineo'],
        $data['alergias'],
        $data['condicoes_medicas'],
        $data['medicamentos'],
        $data['convenio'],
        $data['numero_convenio'],
        $data['validade_convenio'],
        $data['profissao'],
        $data['escolaridade'],
        $data['necessidades_especiais'],
        isset($data['consentimento_dados']) ? 1 : 0,
        $id
    ];
    
    if ($stmt->execute($params)) {
        $stmt->closeCursor();
        $conn = null;
        return true;
    } else {
        $errorInfo = $stmt->errorInfo();
        $stmt->closeCursor();
        $conn = null;
        return $errorInfo[2];
    }
}

function deletePaciente($id) {
    $conn = connect();
    
    // Prepara a query para deletar o paciente pelo ID
    $stmt = $conn->prepare("DELETE FROM pacientes WHERE id = ?");
    
    if ($stmt->execute([$id])) {
        $stmt->closeCursor();
        $conn = null;
        return true;
    } else {
        $errorInfo = $stmt->errorInfo();
        $stmt->closeCursor();
        $conn = null;
        return $errorInfo[2];
    }
}
?>