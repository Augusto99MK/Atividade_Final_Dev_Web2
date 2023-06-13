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
    <title>Editar Campus</title>

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
                <h1>Editar Campus</h1>
            </div>
        </div>
        <?php
        require_once('../../conexao.php');

        $conexao = conectarBanco();

        //da url de buscarCampus que esta chamando este arquivo
        $idCampus = $_GET['idCampus'];

        try {
            $sql = "select * from campus where idCampus = " . $idCampus;
            $resultado = $conexao->query($sql);
            if ($resultado->rowCount() > 0) {
                $linha = $resultado->fetch();

        ?>
                <form action="<?php echo $path; ?>/repositorio/campus/editarCampus.php" method="POST">
                    <input value="<?php echo $linha['idCampus'] ?>" type="text" name="idCampus" id="idCampus" hidden>
                    <div class="row mb-3">
                        <div class="col col-md-8">
                            <label class="form-label" for="idnome">Nome</label>
                            <input class="form-control border-dark" value="<?php echo $linha['nomeCampus'] ?>" type="text" name="nome" id="idnome" required>
                        </div>
                        <div class="col col-md-4">
                            <label class="form-label" for="idcep">CEP</label>
                            <input class="form-control border-dark" value="<?php echo $linha['CEP'] ?>" type="number" name="cep" id="idcep" required>
                        </div>
                    </div>
            <?php
            }
        } catch (PDOException $e) {
            die("Ocorreu um erro " . $e->getMessage());
        }
            ?>
            <div class="row mb-3">
                <div class="col col-md-4">
                    <label class="form-label" for="idrua">Rua</label>
                    <input class="form-control border-dark" type="text" name="rua" id="idrua">
                </div>
                <div class="col col-md-4">
                    <label class="form-label" for="idbairro">Bairro</label>
                    <input class="form-control border-dark" type="text" name="bairro" id="idbairro">
                </div>
                <div class="col col-md-3">
                    <label class="form-label" for="idcidade">Cidade</label>
                    <input class="form-control border-dark" type="text" name="cidade" id="idcidade">
                </div>
                <div class="col col-md-1">
                    <label class="form-label" for="iduf">UF</label>
                    <input class="form-control border-dark" type="text" name="uf" id="iduf">
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Salvar">
                </form>
    </div>
</body>

</html>