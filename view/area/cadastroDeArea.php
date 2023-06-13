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
    <title>Cadastro de Area</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="<?php echo $path; ?>/arquivos/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo $path; ?>/arquivos/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include("../../menu.php") ?>

    <div class="container">
        <div class="row mb-4 mt-4">
            <!-- Botao X que retorna ao menu principal -->
            <a href="../../index.php" class="btn btn-close" aria-label="Close"></a>
            <div class="alert alert-light" role="alert">
                <h1>Cadastro de Area</h1>
            </div>
        </div>
        <form action="<?php echo $path; ?>/repositorio/area/salvarArea.php" method="POST">
            <div class="row mb-3">
                <div class="col col-md-3">
                    <label class="form-label" for="idNome">Nome da Area</label>
                    <input class="form-control border-dark" type="text" name="nomeA" id="idNome" required>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Salvar">
        </form>
    </div>
</body>

</html>