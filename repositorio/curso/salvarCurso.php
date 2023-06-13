<?php
require_once('../../conexao.php');

$conexao = conectarBanco();

$idCampus = $_POST['idCampus'];
$idArea = $_POST['idArea'];
$nome = $_POST['nome'];
$nota = $_POST['nota'];

try {
    $sql = "insert into curso (nomeCurso, notaCurso, idCampus, idArea) values ('$nome','$nota', '$idCampus', '$idArea')";
    $conexao->exec($sql);
    echo "Salvo com sucesso !!!";
} catch (PDOException $e) {
    die("Ocorreu um erro " . $e->getMessage());
}
