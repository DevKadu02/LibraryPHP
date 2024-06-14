<?php
$servername = "localhost";
$username = "root";  // Altere se necessário
$password = "";      // Altere se necessário
$dbname = "CRUD_Library";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}