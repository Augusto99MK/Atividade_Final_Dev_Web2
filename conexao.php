<?php
function conectarBanco()
{
    try {
        $conexao = new PDO("mysql:host=localhost; dbname=web2", "root", "");
        return $conexao;
    } catch (PDOException $e) {
        die("Ocorreu um erro inesperado " . $e->getMessage());
    }
}
