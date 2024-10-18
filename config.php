<?php
// Conexão com o MySQL
$host = 'localhost';
$user = 'root';
$password = 'root'; // Coloque a senha do MySQL se houver
$dbname = 'db_exemplo'; // Nome do banco de dados
$databaseFile = 'database.sql';

try {
    // Conectar ao MySQL sem especificar banco de dados
    $pdo = new PDO("mysql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar se o banco de dados já existe
    $dbExists = $pdo->query("SHOW DATABASES LIKE '$dbname'")->rowCount() > 0;

    

    // Conectar ao banco de dados específico
    $pdo->exec("USE $dbname");

    // Ler o conteúdo do arquivo SQL
    $sql = file_get_contents($databaseFile);
    if ($sql === false) {
        throw new Exception("Não foi possível ler o arquivo SQL");
    }

    // Executar o script SQL para criar tabelas
    $pdo->exec($sql);
    echo "Tabelas criadas ou atualizadas com sucesso!";

} catch (PDOException $e) {
    
} catch (Exception $e) {
}
?>
