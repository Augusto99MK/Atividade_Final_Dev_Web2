<?php
require_once('../../conexao.php');

$conexao = conectarBanco();

$nome = $_POST['nome'];
$email = $_POST['email'];
$date = $_POST['date'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$idCurso = $_POST['idCurso'];

try {
    $sql = "INSERT INTO pessoa (nome, emailInstitucional, idade, sexo, dataEntrada) VALUES ('$nome','$email','$age','$gender','$date')";
    $conexao->exec($sql);

    // Recupera o ID gerado automaticamente
    $idPessoa = $conexao->lastInsertId();

    if ($_POST['acesso'] === 'estudante') {
        $ra = $_POST['ra'];
        $sql = "INSERT INTO aluno (RA, idPessoa, idCurso) VALUES ('$ra', '$idPessoa', '$idCurso')";
        $conexao->exec($sql);
    } elseif ($_POST['acesso'] === 'professor') {
        $siape = $_POST['siape'];
        $sql = "INSERT INTO professor (SIAPE, idPessoa, idCurso) VALUES ('$siape', '$idPessoa', '$idCurso')";
        $conexao->exec($sql);
    }

    echo "Salvo com sucesso!";
} catch (PDOException $e) {
    die("Ocorreu um erro " . $e->getMessage());
}
