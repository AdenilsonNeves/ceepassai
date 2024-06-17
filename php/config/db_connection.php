<?php
$user = 'postgres.foyrklpprrelptnykkro';
$pass = 'ewIN9hwdVTbVJ5xR';
$host = 'aws-0-sa-east-1.pooler.supabase.com';
$port = '6543';
$dbname = 'postgres';

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);

} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>