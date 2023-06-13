<?php
require_once('../../conexao.php');

$conexao = conectarBanco();

$nome = $_POST['nome'];
$cep = $_POST['cep'];

try {
    $sql = "INSERT INTO campus (CEP, nomeCampus) VALUES ('$cep','$nome')";
    $conexao->exec($sql);
    echo "Salvo com sucesso!";
} catch (PDOException $e) {
    die("Ocorreu um erro " . $e->getMessage());
}