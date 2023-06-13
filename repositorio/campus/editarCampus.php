<?php
require_once('../../conexao.php');

$conexao = conectarBanco();

$idCampus = $_POST['idCampus'];
$nome = $_POST['nome'];
$cep = $_POST['cep'];

try {
    $sql = "update campus set nomeCampus='$nome', CEP='$cep' where idCampus=" . $idCampus;
    $conexao->exec($sql);
    echo "Editado com sucesso !!!";
} catch (PDOException $e) {
    die("Ocorreu um erro " . $e->getMessage());
}

header('Location: ../../view/campus/buscarCampus.php');