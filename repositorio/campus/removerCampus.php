<?php
require_once('../../conexao.php');

$conexao = conectarBanco();

$idCampus = $_GET['idCampus'];

try {
    $sql = "delete from campus where idCampus = " . $idCampus;
    $conexao->exec($sql);
    echo "Removido com sucesso !!!";
} catch (PDOException $e) {
    die("Ocorreu um erro " . $e->getMessage());
}
header('Location: ../../view/campus/buscarCampus.php');