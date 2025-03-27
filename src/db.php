<?php
// db.php - Gerenciamento da conexão com o banco de dados

// Configurações do banco de dados
$host = 'localhost';      // Host do banco de dados
$dbname = 'cadastro_medico'; // Nome do banco de dados
$username = 'root';       // Usuário do banco de dados
$password = '';           // Senha do banco de dados

// Função para estabelecer a conexão com o banco de dados utilizando PDO
function connect() {
    // Torna as variáveis de configuração acessíveis dentro da função
    global $host, $dbname, $username, $password;
    
    try {
        // Cria uma nova instância PDO com a string de conexão e credenciais
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Configura o PDO para lançar exceções em caso de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Retorna a conexão estabelecida
        return $conn;
    } catch (PDOException $e) {
        // Em caso de erro na conexão, exibe a mensagem de erro
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

// Função auxiliar para executar consultas ao banco de dados
function query($sql, $params = []) {
    // Estabelece a conexão
    $conn = connect();
    if ($conn) {
        // Prepara a query SQL
        $stmt = $conn->prepare($sql);
        // Executa a query com os parâmetros fornecidos
        $stmt->execute($params);
        // Retorna o objeto statement com os resultados da consulta
        return $stmt;
    }
    // Retorna null se a conexão não foi estabelecida
    return null;
}
?>