<?php
require_once('../../conexao.php');

$conexao = conectarBanco();

$idCurso = $_POST['id_curso'];
$nome = $_POST['nome'];
$nota = $_POST['nota'];

try {
    $sql = "update curso set nomeCurso='$nome', notaCurso='$nota' where idCurso=" . $idCurso;
    $conexao->exec($sql);
    echo "Editado com sucesso !!!";
} catch (PDOException $e) {
    die("Ocorreu um erro " . $e->getMessage());
}

header('Location: ../../view/curso/buscarCurso.php');