<?php
// Estabelecendo conexão com o diretório devweb22023
$path = 'http://' . $_SERVER["HTTP_HOST"] . '/devweb22023';

// Verificar se o usuário está autenticado
$autenticado = isset($_SESSION['usuario']);

// Verificar o tipo de acesso do usuário (estudante, professor, etc.) caso esteja autenticado
$tipoAcesso = $autenticado ? $_SESSION['usuario']['acesso'] : '';

?>

<!-- Criando um componente de barra de navegação com a classe "navbar" -->
<!-- expand-lg significa que a barra de navegação pode ser expandida em telas de dispositivos largas
ao mesmo tempo que pode ser compac'ta em telas menores -->
<nav class="navbar navbar-expand-lg bg-body-primary mt-3">
    <!-- container fluid se estende por toda a largura disponível fluid é um elemento de responsividade -->
    <div class="container-fluid">
        <img src="<?php echo $path; ?>/arquivos/imagens/ifmscb.png" width="9%">
        <!-- navbar-toggler cria o botão que pode ser usado para recolher a barra -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo $path; ?>/index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Campus
                    </a>
                    <!--Sanduíche do bootstrap para o cadastro de campus-->
                    <ul class="dropdown-menu">
                        <!--chamada das páginas php -->
                        <li><a class="dropdown-item" href="<?php echo $path; ?>./view/campus/cadastroDeCampus.php">Cadastrar Campus</a></li>
                        <li><a class="dropdown-item" href="<?php echo $path; ?>/view/campus/buscarCampus.php">Buscar
                                Campus</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Área
                    </a>
                    <!--Sanduíche do bootstrap para o cadastro de área-->
                    <ul class="dropdown-menu">
                        <!--Sanduíche do bootstrap para o cadastro de área-->
                        <li><a class="dropdown-item" href="<?php echo $path; ?>/view/area/cadastroDeArea.php">Cadastrar
                                Área</a></li>
                        <li><a class="dropdown-item" href="<?php echo $path; ?>/view/area/buscarArea.php">Buscar
                                Área</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Curso
                    </a>
                    <!--Sanduíche do bootstrap para o cadastro de curso-->
                    <ul class="dropdown-menu">
                        <!--Sanduíche do bootstrap para o cadastro de curso-->
                        <li><a class="dropdown-item" href="<?php echo $path; ?>/view/curso/cadastroDeCurso.php">Cadastrar Curso</a></li>
                        <li><a class="dropdown-item" href="<?php echo $path; ?>./view/curso/buscarCurso.php">Buscar
                                Curso</a></li>
                    </ul>
                </li>

                <!-- Exibir o menu específico para estudantes -->
                <?php if ($tipoAcesso === 'estudante') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path; ?>/view/estudante/meusCursos.php">Meus Cursos</a>
                    </li>
                <?php endif; ?>

                <!-- Exibir o menu específico para professores -->
                <?php if ($tipoAcesso === 'professor') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path; ?>/view/professor/meusCursos.php">Meus Cursos</a>
                    </li>
                <?php endif; ?>

            </ul>
            <ul class="navbar-nav ms-auto">
                <!-- Exibir o botão de login ou o nome do usuário autenticado -->
                <?php if ($autenticado) : ?>
                    <li class="nav-item">
                        <a class="nav-link btn-lg" style="padding: 2px 20px;" href="#" tabindex="-1" aria-disabled="true">Bem-vindo(a),
                            <?php
                            echo $_SESSION['usuario']['nome'];
                            if ($tipoAcesso === 'estudante') {
                                echo " (RA: " . $_SESSION['usuario']['ra'] . ")";
                            } elseif ($tipoAcesso === 'professor') {
                                echo " (SIAPE: " . $_SESSION['usuario']['siape'] . ")";
                            }
                            ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger btn-lg" style="padding: 2px 20px; color: #ffffff;" href="<?php echo $path; ?>/view/login/login.php">Sair</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path; ?>/view/login/login.php">Login</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>