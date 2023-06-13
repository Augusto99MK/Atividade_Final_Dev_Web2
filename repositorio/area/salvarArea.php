<?php
require_once('../../conexao.php');

$conexao = conectarBanco();

$nome = $_POST['nomeA'];

try {
    $sql = "insert into area (nomeArera) values ('$nome')";
    $conexao->exec($sql);
    echo "Salvo com sucesso !!!";
} catch (PDOException $e) {
    die("Ocorreu um erro " . $e->getMessage());
}