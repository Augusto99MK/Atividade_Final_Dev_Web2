<?php
require_once('../../conexao.php');

$conexao = conectarBanco();

$idArea = $_GET['id_Area'];

try {
    $sql = "delete from area where idArea = " . $idArea;
    $conexao->exec($sql);
    echo "Removido com sucesso !!!";
} catch (PDOException $e) {
    die("Ocorreu um erro " . $e->getMessage());
}
header('Location: ../../view/area/buscarArea.php');