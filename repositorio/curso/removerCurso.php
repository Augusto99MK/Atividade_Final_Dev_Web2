<?php
require_once('../../conexao.php');

$conexao = conectarBanco();

$idCurso = $_GET['id_Curso'];

try {
    $sql = "delete from curso where idCurso = " . $idCurso;
    $conexao->exec($sql);
    echo "Removido com sucesso !!!";
} catch (PDOException $e) {
    die("Ocorreu um erro " . $e->getMessage());
}
header('Location: ../../view/curso/buscarCurso.php');