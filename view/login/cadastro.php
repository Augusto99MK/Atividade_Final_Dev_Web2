<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <!-- Adicionando Framework Bootstrap CSS e JS -->
    <link href="../../arquivos/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../arquivos/css/login.css" rel="stylesheet">
    <script src="../../arquivos/js/bootstrap.bundle.min.js"></script>
    <!-- Adicionando FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
</head>

<body>
    <section class="vh-100" style="background-color: #13f478;">
        <div class="container py-0 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-8">
                    <div class="card" style="border-radius: 2rem;">
                        <div class="row g-2 align-items-start">
                            <div class="col-md-3 col-lg-6 col-md-6">
                                <img src="../../arquivos/imagens/DreamShaper_v6_student_girl_waifu_portrait_wearing_a_green_shi_3.jpg"
                                    alt="login form" class="img-fluid img-form" />
                            </div>
                            <div class="col-md-5 col-lg-6 d-flex align-items-center">
                                <div class="card-body p-lg-3 text-black">
                                    <form method="POST" action="../../repositorio/login/salvaCadastro.php">
                                        <div class="d-flex align-items-center">
                                            <img src="../../arquivos/imagens/if.png" alt="logo ifms"
                                                style="margin-right: 20px;">
                                            <h5 class="fw-normal pb-0 py-0" style="letter-spacing: 1px;">Faça seu
                                                cadastro
                                                na nossa plataforma:
                                            </h5>
                                        </div>

                                        <div class="form-outline col col-md-8">
                                            <label class="form-label-sm mb-1" for="form2ExampleName">Nome</label>
                                            <input type="text" id="form2ExampleName"
                                                class="form-control form-control-sm form-control-sm mb-1"
                                                style="border: 1px solid" name="nome" required />
                                        </div>

                                        <div class="form-outline col col-md-8">
                                            <label class="form-label-sm mb-1" for="form2ExampleEmail">Email</label>
                                            <input type="email" id="form2ExampleEmail"
                                                class="form-control form-control-sm form-control-sm mb-1"
                                                style="border: 1px solid" name="email" required />
                                        </div>

                                        <div class="form-outline col col-md-8">
                                            <label class="form-label-sm mb-1" for="form2ExampleDate">Data de
                                                Ingresso</label>
                                            <input type="date" id="form2ExampleDate"
                                                class="form-control form-control-sm form-control-sm mb-1"
                                                style="border: 1px solid" name="date" required />
                                        </div>

                                        <div class="form-outline col col-md-8">
                                            <label class="form-label-sm mb-1" for="form2ExampleAge">Idade</label>
                                            <input type="number" id="form2ExampleAge"
                                                class="form-control form-control-sm mb-1" style="border: 1px solid"
                                                name="age" required />
                                        </div>

                                        <div class="form-outline col col-md-5">
                                            <label class="form-label-sm mb-1" for="form2ExampleGender">Sexo</label>
                                            <select required id="form2ExampleGender"
                                                class="form-select form-select-sm form-control form-control-sm mb-1"
                                                style="border: 1px solid" name="gender" required>
                                                <option value="">Selecionar</option>
                                                <option value="M">Masculino</option>
                                                <option value="F">Feminino</option>
                                                <option value="O">Outro</option>
                                            </select>

                                        </div>

                                        <div class="form-outline col col-md-5">
                                            <label class="form-label-sm mb-1" for="form2ExampleAccess">Acesso</label>
                                            <select id="form2ExampleAccess"
                                                class="form-select form-select-sm form-control form-control-sm mb-1"
                                                style="border: 1px solid" name="acesso" required
                                                onchange="showAdditionalField(this)">
                                                <option value="">Selecionar</option>
                                                <option value="estudante">Estudante</option>
                                                <option value="professor">Professor</option>
                                            </select>
                                        </div>

                                        <div id="additionalFieldstudent" class="additional-field col col-md-4"
                                            style="display: none;">
                                            <div class="form-outline">
                                                <label class="form-label-sm mb-1" for="additionalInputStudent">RA
                                                    Estudante</label>
                                                <input type="text" id="additionalInputStudent"
                                                    class="form-control form-control-sm" style="border: 1px solid"
                                                    name="ra" placeholder="Digite o seu RA">
                                            </div>
                                        </div>

                                        <div id="additionalFieldprofessor" class="additional-field col col-md-4"
                                            style="display: none;">
                                            <div class="form-outline">
                                                <label class="form-label-sm mb-1" for="additionalInputProfessor">Siape
                                                    Professor</label>
                                                <input type="text" id="additionalInputProfessor"
                                                    class="form-control form-control-sm" style="border: 1px solid"
                                                    name="siape" placeholder="Digite o seu Siape">
                                            </div>
                                        </div>

                                        <?php
                                        require_once('../../conexao.php');

                                        $conexao = conectarBanco();

                                        try {
                                            $sql = "SELECT * FROM curso";
                                            $resultado = $conexao->query($sql);

                                            if ($resultado->rowCount() > 0) {
                                        ?>
                                        <div class="row">
                                            <div class="col col-md-4 mb-3">
                                                <label class="form-label-sm mb-1" for="idCurso">Curso</label>
                                                <select class="form-select form-select-sm form-select-sm border-dark"
                                                    id="select_curso" name="idCurso">
                                                    <option value="">Selecionar</option>
                                                    <?php
                                                            while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                                                echo "<option value=\"" . $linha['idCurso'] . "\">" . $linha['nomeCurso'] . "</option>";
                                                            }
                                                            ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                            } else {
                                                echo "<div class='row'><div class='col-md-12'><p>Nenhum curso encontrado.</p></div></div>";
                                            }
                                        } catch (PDOException $e) {
                                            echo "Erro: " . $e->getMessage();
                                        }
                                        ?>

                                        <script>
                                        function showAdditionalField(selectElement) {
                                            var additionalFieldStudent = document.getElementById(
                                                "additionalFieldstudent");
                                            var additionalFieldProfessor = document.getElementById(
                                                "additionalFieldprofessor");

                                            additionalFieldStudent.style.display = selectElement.value === "estudante" ?
                                                "block" : "none";
                                            additionalFieldProfessor.style.display = selectElement.value ===
                                                "professor" ? "block" : "none";
                                        }
                                        </script>


                                        <div class="pt-0 mb-0">
                                            <button class="btn btn-success btn-sm btn-block"
                                                type="submit">Cadastrar</button>
                                        </div>

                                        <p class="mb-0 pb-sm-0" style="color: #000000;">Já possui uma conta? <a
                                                href="login.php" style="color: #393f81;">Faça login</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>