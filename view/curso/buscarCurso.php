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
} else {
    // O usuário não tem permissão, exiba uma mensagem de erro
    echo "Você não tem permissão para acessar esta página.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php $path = 'http://' . $_SERVER["HTTP_HOST"] . '/devweb22023'; ?>

<head>
    <meta charset="UTF-8">
    <title>Busca de Curso</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="<?php echo $path; ?>/arquivos/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo $path; ?>/arquivos/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo $path; ?>/arquivos/js/busca.cep.js"></script>
</head>

<body>
    <?php include("../../menu.php") ?>
    <div class="container">
        <div class="row mb-4 mt-4">
            <!-- Botao X que retorna ao buscarCurso -->
            <a href="../../index.php" class="btn btn-close" aria-label="Close"></a>
            <div class="alert alert-light" role="alert">
                <h1>Busca de Curso</h1>
            </div>
        </div>
        <div class="row">
            <h3>Selecione o que deseja ver:</h3>
            <div class="col-md-1">
                <!-- o próprio script PHP que está sendo executado será utilizado como destino da requisição de envio do formulário -->
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <label for="select_opcao">Opção:</label>
                        <select class="form-control border-dark" id="select_opcao" name="opcao">
                            <option value="curso">Cursos</option>
                            <option value="campus">Campus</option>
                            <option value="area">Area</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        /* verificar se a requisição HTTP feita ao servidor foi do tipo POST */
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            /* do valor preenchido do formulario de selecao */
            $opcao = $_POST["opcao"];
            if ($opcao == "curso") {
                require_once('../../conexao.php');

                $conexao = conectarBanco();
                try {
                    $sql = "SELECT curso.*, area.nomeArera, campus.nomeCampus
                    FROM curso
                    INNER JOIN area ON curso.idArea = area.idArea
                    INNER JOIN campus ON curso.idCampus = campus.idCampus";
                    $resultado = $conexao->query($sql);
                    if ($resultado->rowCount() > 0) {
        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Resultado da busca de cursos:</h3>
                                <table class="table border-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome Curso</th>
                                            <th scope="col">Nota Curso</th>
                                            <th scope="col">Nome Area</th>
                                            <th scope="col">Nome Campus</th>
                                            <th scope="col">#</th>
                                            <th scope="col">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($linha = $resultado->fetch()) {
                                            echo "<tr>";
                                            echo "<td>" . $linha['idCurso'] . "</td>";
                                            echo "<td>" . $linha['nomeCurso'] . "</td>";
                                            echo "<td>" . $linha['notaCurso'] . "</td>";
                                            echo "<td>" . $linha['nomeArera'] . "</td>";
                                            echo "<td>" . $linha['nomeCampus'] . "</td>";
                                            echo "<td><a href=\"../../repositorio/curso/removerCurso.php?id_Curso=" . $linha['idCurso'] . "\" class=\"btn btn-danger\">Remover</a></td>";
                                            echo "<td><a href=\"../curso/editarCurso.php?id_Curso=" . $linha['idCurso'] . "\" class=\"btn btn-secondary\">Editar</a></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo "<div class='row'><div class='col-md-12'><p>Nenhum curso encontrado.</p></div></div>";
                    }
                } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
            } else if ($opcao == "campus") {
                require_once('../../conexao.php');

                $conexao = conectarBanco();
                try {
                    $sql = "select * from campus";
                    $resultado = $conexao->query($sql);
                    if ($resultado->rowCount() > 0) {
                    ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Resultado da busca de campus:</h3>
                                <table class="table border-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome Campus</th>
                                            <th scope="col">CEP</th>
                                            <th scope="col">#</th>
                                            <th scope="col">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($linha = $resultado->fetch()) {
                                            echo "<tr>";
                                            echo "<td>" . $linha['idCampus'] . "</td>";
                                            echo "<td>" . $linha['nomeCampus'] . "</td>";
                                            echo "<td>" . $linha['CEP'] . "</td>";
                                            echo "<td><a href=\"../../repositorio/campus/removerCampus.php?idCampus=" . $linha['idCampus'] . "\" class=\"btn btn-danger\">Remover</a></td>";
                                            echo "<td><a href=\"../campus/editarCampus.php?idCampus=" . $linha['idCampus'] . "\" class=\"btn btn-secondary\">Editar</a></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo "<div class='row'><div class='col-md-12'><p>Nenhum campus encontrado.</p></div></div>";
                    }
                } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
            } else if ($opcao == "area") {
                require_once('../../conexao.php');

                $conexao = conectarBanco();
                try {
                    $sql = "SELECT * FROM area";
                    $resultado = $conexao->query($sql);
                    if ($resultado->rowCount() > 0) {
                    ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Resultado da busca de area:</h3>
                                <table class="table border-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome Area</th>
                                            <th scope="col">#</th>
                                            <th scope="col">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($linha = $resultado->fetch()) {
                                            echo "<tr>";
                                            echo "<td>" . $linha['idArea'] . "</td>";
                                            echo "<td>" . $linha['nomeArera'] . "</td>";
                                            echo "<td><a href=\"../../repositorio/area/removerArea.php?id_Area=" . $linha['idArea'] . "\" class=\"btn btn-danger\">Remover</a></td>";
                                            echo "<td><a href=\"../area/editarArea.php?id_Area=" . $linha['idArea'] . "\" class=\"btn btn-secondary\">Editar</a></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
        <?php
                    } else {
                        echo "<div class='row'><div class='col-md-12'><p>Nenhuma area encontrada.</p></div></div>";
                    }
                } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
            }
        }
        ?>
    </div>

</body>

</html>