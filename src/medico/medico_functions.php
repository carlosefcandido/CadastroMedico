<?php
require_once __DIR__ . '/../db.php';

// Cria um novo médico no banco de dados
function createMedico($data) {
    // Conecta ao banco de dados
    $conn = connect();
    // Prepara a query com placeholders para evitar SQL Injection
    $stmt = $conn->prepare("INSERT INTO medicos (nome, cpf, rg, data_nascimento, genero, telefone, email, endereco, numero_crm, estado_crm, especialidades, subespecialidades, data_emissao_crm) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $params = [
        $data['nome'],
        $data['cpf'],
        $data['rg'],
        $data['data_nascimento'],
        $data['genero'],
        $data['telefone'],
        $data['email'],
        $data['endereco'],
        $data['numero_crm'],
        $data['estado_crm'],
        $data['especialidades'],
        $data['subespecialidades'],
        $data['data_emissao_crm']
    ];
    // Executa a query e retorna true em caso de sucesso, ou mensagem de erro em caso de falha
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

// Atualiza os dados de um médico existente
function updateMedico($id, $data) {
    $conn = connect();
    $stmt = $conn->prepare("UPDATE medicos SET nome = ?, cpf = ?, rg = ?, data_nascimento = ?, genero = ?, telefone = ?, email = ?, endereco = ?, numero_crm = ?, estado_crm = ?, especialidades = ?, subespecialidades = ?, data_emissao_crm = ? WHERE id = ?");
    $params = [
        $data['nome'],
        $data['cpf'],
        $data['rg'],
        $data['data_nascimento'],
        $data['genero'],
        $data['telefone'],
        $data['email'],
        $data['endereco'],
        $data['numero_crm'],
        $data['estado_crm'],
        $data['especialidades'],
        $data['subespecialidades'],
        $data['data_emissao_crm'],
        $id
    ];
    // Executa a query de atualização e retorna true em caso de sucesso, ou mensagem de erro em caso de falha
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

// Exclui um médico do banco de dados pelo ID
function deleteMedico($id) {
    $conn = connect();
    $stmt = $conn->prepare("DELETE FROM medicos WHERE id = ?");
    // Executa a query de exclusão e retorna true em caso de sucesso, ou mensagem de erro em caso de falha
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