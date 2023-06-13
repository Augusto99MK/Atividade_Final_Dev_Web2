<?php
require_once('../../conexao.php');

$conexao = conectarBanco();

$idArea = $_POST['id_area'];
$nomeArea = $_POST['nome_area'];

try {
    $sql = "update area set nomeArera ='$nomeArea' where idArea=" . $idArea;
    $conexao->exec($sql);
    echo "Editado com sucesso !!!";
} catch (PDOException $e) {
    die("Ocorreu um erro " . $e->getMessage());
}

header('Location: ../../view/area/buscarArea.php');