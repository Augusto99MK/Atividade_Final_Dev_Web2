<?php
session_start();

// Verificar se a sessão do usuário está definida
if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['nome'])) {
    $nomeUsuario = $_SESSION['usuario']['nome'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manter Aluno e Professor</title>

    <!--Adicionando Framework Bootstrap CSS e JS-->
    <link href="./arquivos/css/bootstrap.min.css" rel="stylesheet">
    <script src="./arquivos/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <!-- Adicionando menu redirecionando o usuario para outra pagina, isto faz o menu aparecer-->
    <?php include("./menu.php") ?>

    <!--Adicionando um espaçamento horizontal e vertical para a div e auto alinhamento centro.-->
    <!-- px se refere a preenchimento horizontal a esquerda e direita do elemento.-->
    <!-- py se refere a preenchimento vertical acima e abaixo do elemento. -->
    <!-- pt-md se refere a preenchimento de margem superior e preenchimento superior para telas medias e maiores (padding top) -->
    <!-- pb-md se refere a preenchimento de margem inferior e preenchimento inferior para telas medias e maiores (padding bottom) -->
    <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">

        <!--Autoregulagem de tamanho fontes-->
        <h1 class="display-4">Desenvolvimento Web 2</h1>
        <!-- Aplica um estilo fonte diferente-->
        <p class="lead">Objetivo: Desenvolver aplicações WEB utilizando servidor apache, linguagem PHP, biblioteca
            jQuery, acesso a banco de dados e técnicas de orientação a objetos seguindo o padrão MVC para desenvolver
            aplicações completas.</p>
    </div>

    <!-- container(bootstrap) centraliza o conteudo -->
    <div class="container">
        <!-- row cria uma linha horizontal na qual as colunas sao colocadas lado a lado -->
        <div class="row">
            <!-- a coluna ocupará 25% (3/12) da largura total do container pai (responsividade para dar espaço a imagem).-->
            <!-- md se refere a dispositos de tamanho medio.-->
            <div class="col-md-3">
            </div>
            <!--a coluna ocupará 50% (6/12) da largura total do container pai.-->
            <div class="col-md-6">
                <!--chamada carousel-->
                <!-- classe slide, o id carouselExampleInterval e data-bs-ride define o comportamento de 
                animação de transição entre as imagens -->
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <!--carousel Inner é responsavel por aplicar o estilo de largura e altura adequado aos slides -->
                    <div class="carousel-inner">
                        <!--timer carousel-->
                        <!--carousel-item define o estilo básico para um slide, 
                        como a largura, altura, margens e outros estilos de posicionamento,
                    quando possui a classe active, ele é exibido como o slide atual no carrossel-->
                        <div class="carousel-item active" data-bs-interval="2000000">
                            <img src="./arquivos/imagens/ifms1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000000">
                            <img src="./arquivos/imagens/ifms2.jpeg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="./arquivos/imagens/ifms3.jpeg" class="d-block w-100" alt="...">
                        </div>
                    </div>

                    <!-- botões do carousel-->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>


        <!-- Card da pagina inicial-->

        <!-- A classe mt-5 é classe de margem superior que Adiciona
    um espaçamento em branco acima do elemento, mt seria abreviação para margem top-->
        <div class="row mt-5 mb-5">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <!-- chamada do card com estilo de altura -->
                <div class="card" style="width: 8rem height-100;">
                    <div class="card-body">
                        <h3 class="card-title text-center">Sobre nós</h3>
                        <p class="card-text"> o Campus do IFMS é um lugar que combina excelência acadêmica,
                            inovação, inclusão e bem-estar dos estudantes. Aqui, os estudantes são desafiados a se
                            superar,
                            a expandir seus horizontes e a se preparar para uma carreira de sucesso nas áreas de
                            ciência, tecnologia.</p>
                        <div class="text-center">
                            <a href="index.php" class="h-100 btn btn-primary">Retornar
                                ao Menu</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mx-auto text-center">
            <h3>Perguntas Relacionadas</h3>
        </div>

        <!-- chamada dos accordings -->
        <div class="row mt-4">
            <div class="col-md-3">
            </div>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseTwo">
                            Quais são os cursos oferecidos no Campus do IFMS?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            O Campus do IFMS oferece uma ampla gama de cursos nas áreas de ciência,
                            tecnologia, engenharia, artes e matemática, incluindo cursos técnicos integrados
                            ao ensino médio, cursos técnicos subsequentes, cursos de graduação e pós-graduação.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Quais são as oportunidades de estágio para os estudantes no Campus do IFMS?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            O Campus do IFMS oferece diversas oportunidades de estágio
                            para os estudantes, por meio de parcerias com empresas, instituições e órgãos
                            governamentais. O Campus do IFMS oferece diversas oportunidades de estágio para os
                            estudantes,
                            por meio de parcerias com empresas, instituições e órgãos governamentais.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Quais são as atividades extracurriculares oferecidas pelo Campus do IFMS?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            O Campus do IFMS oferece uma variedade de atividades extracurriculares para os estudantes,
                            como clubes acadêmicos, grupos de estudo, projetos de extensão, eventos culturais, palestras
                            e workshops. Essas atividades permitem aos estudantes aprimorar suas habilidades, aprofundar
                            conhecimentos em áreas específicas, conhecer outras áreas do conhecimento, interagir com
                            outros estudantes e enriquecer sua experiência acadêmica.

                        </div>
                    </div>
                </div>
            </div>

            <!-- chamada da barra de navegacao de paginas -->
            <div class="row mt-5">
                <div class="col-md-3">
                </div>
            </div>
            <div class="col-md-3 mx-auto text-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
</body>

</html>