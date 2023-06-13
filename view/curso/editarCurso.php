<?php
session_start();

// Verificar se o usuário está autenticado
$autenticado = isset($_SESSION['usuario']);

// Verificar o tipo de acesso do usuário (estudante, professor) caso esteja autenticado
$tipoAcesso = $autenticado ? $_SESSION['usuario']['acesso'] : '';

// Verificar se o usuário tem permissão de acesso a esta página (apenas professores podem acessar)
if ($autenticado && $tipoAcesso === 'professor') {
    // O usuário tem permissão, exiba o conteúdo da página
    // Restante do código da página de cadastro de áreas, cursos e campus...
} elseif (isset($_COOKIE['aluno_autenticado']) && $_COOKIE['aluno_autenticado'] === 'true') {
    // O aluno está autenticado, mas não tem permissão para acessar esta página
    echo "Você não tem permissão para acessar esta página.";
    exit();
} else {
    echo "Você não tem permissão para acessar esta página.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<?php $path = 'http://' . $_SERVER["HTTP_HOST"] . '/devweb22023'; ?>

<head>
    <meta charset="UTF-8">
    <title>Editar Area</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="<?php echo $path; ?>/arquivos/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo $path; ?>/arquivos/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo $path; ?>/arquivos/js/busca.cep.js"></script>
</head>

<body>
    <?php include("../../menu.php") ?>
    <div class="container">
        <div class="row mb-4 mt-4">
            <!-- Botao X que retorna ao menu principal -->
            <a href="../../index.php" class="btn btn-close" aria-label="Close"></a>
            <div class="alert alert-light" role="alert">
                <h1>Editar Curso</h1>
            </div>
        </div>
        <?php
        try {
            $conexao = new PDO("mysql:host=localhost; dbname=web2", "root", "Carlos11425@");
        } catch (PDOException $e) {
            die("Ocorreu um erro inesperado " . $e->getMessage());
        }

        //da url de buscarCurso que esta chamando este arquivo
        $idCurso = $_GET['id_Curso'];

        try {
            $sql = "select * from curso where idCurso = " . $idCurso;
            $resultado = $conexao->query($sql);
            if ($resultado->rowCount() > 0) {
                $linha = $resultado->fetch();

        ?>
                <form action="<?php echo $path; ?>/repositorio/curso/editarCurso.php" method="POST">
                    <input value="<?php echo $linha['idCurso'] ?>" type="text" name="id_curso" id="idArea" hidden>
                    <div class="row mb-3">
                        <div class="col col-md-3">
                            <label class="form-label" for="idnome">Nome</label>
                            <input class="form-control border-dark" value="<?php echo $linha['nomeCurso'] ?>" type="text" name="nome" id="idnome" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col col-md-3">
                            <label class="form-label" for="idNome">Nota Curso</label>
                            <input class="form-control border-dark" min="1" max="10" type="number" name="nota" id="idNome" placeholder="Digite uma nota de curso de 1 a 10" required>
                        </div>
                    </div>
            <?php
            }
        } catch (PDOException $e) {
            die("Ocorreu um erro " . $e->getMessage());
        }
            ?>
            <input class="btn btn-primary" type="submit" value="Salvar">
                </form>
    </div>
</body>

</html>