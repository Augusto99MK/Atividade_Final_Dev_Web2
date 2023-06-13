<?php
// Verificar as credenciais fornecidas pelo usuário
if (isset($_POST['email']) && isset($_POST['dataIngresso'])) {
    $email = $_POST['email'];
    $dataIngresso = $_POST['dataIngresso'];

    // Lógica para verificar as credenciais no banco de dados
    require_once('../../conexao.php');

    $conexao = conectarBanco();

    try {
        // Verificar se o usuário é um aluno
        $sql = "SELECT p.idPessoa, p.nome, a.ra
                FROM pessoa p
                INNER JOIN aluno a ON p.idPessoa = a.idPessoa
                WHERE p.emailInstitucional = ? AND p.dataEntrada = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $dataIngresso);
        $stmt->execute();

        $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar se o usuário é um professor
        if (!$aluno) {
            $sql = "SELECT p.idPessoa, p.nome, pr.siape
                    FROM pessoa p
                    INNER JOIN professor pr ON p.idPessoa = pr.idPessoa
                    WHERE p.emailInstitucional = ? AND p.dataEntrada = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $dataIngresso);
            $stmt->execute();

            $professor = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($professor) {
                $idProfessor = $professor['idPessoa'];
                $usuario = [
                    'acesso' => 'professor',
                    'idProfessor' => $idProfessor,
                    'nome' => $professor['nome'],
                    'siape' => $professor['siape']
                ];

                // Iniciar a sessão
                session_start();

                // Definir a variável de sessão para identificar o tipo de acesso do usuário
                $_SESSION['usuario'] = $usuario;

                // Definir o cookie de autenticação do professor
                setcookie('professor_autenticado', 'true', time() + 3600, '/');

                // Redirecionar para a página inicial ou para a página desejada após o login
                header('Location: ../../index.php');
                exit();
            }
        } else {
            $idAluno = $aluno['idPessoa'];
            $usuario = [
                'acesso' => 'estudante',
                'idAluno' => $idAluno,
                'nome' => $aluno['nome'],
                'ra' => $aluno['ra']
            ];

            // Iniciar a sessão
            session_start();

            // Definir a variável de sessão para identificar o tipo de acesso do usuário
            $_SESSION['usuario'] = $usuario;

            // Definir o cookie de autenticação do aluno
            setcookie('aluno_autenticado', 'true', time() + 3600, '/');

            // Redirecionar para a página inicial ou para a página desejada após o login
            header('Location: ../../index.php');
            exit();
        }

        // Caso nenhuma autenticação seja bem-sucedida, exiba uma mensagem de erro ou redirecione para a página de login novamente
        echo "Credenciais inválidas. Por favor, tente novamente.";
    } catch (PDOException $e) {
        die("Ocorreu um erro: " . $e->getMessage());
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Adicionando Framework Bootstrap CSS e JS -->
    <link href="../../arquivos/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../arquivos/css/login.css" rel="stylesheet">
    <script src="../../arquivos/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <section class="vh-100" style="background-color: #13f478;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-8">
                    <div class="card" style="border-radius: 2rem;">
                        <div class="row g-2">
                            <div class="col-md-6 col-lg-6 col-md-6">
                                <img src="../../arquivos/imagens/DreamShaper_v6_student_girl_waifu_portrait_wearing_a_green_shi_1.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-3 col-lg-4 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-4 text-black">
                                    <form method="POST" action="login.php">
                                        <div class="d-flex align-items-center">
                                            <img src="../../arquivos/imagens/if.png" alt="logo ifms" style="margin-right: 20px;">
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3 py-2" style="letter-spacing: 1px;">Faça seu
                                            login
                                            na nossa plataforma:
                                        </h5>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example17">Email Cadastrado</label>
                                            <input type="email" id="form2Example17" class="form-control form-control-md" style="border: 1px solid" name="email" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27">Insira a data de
                                                Ingresso</label>
                                            <input type="date" id="form2Example27" class="form-control form-control-md" style="border: 1px solid" name="dataIngresso" />
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-success btn-lg btn-block" type="submit">Login</button>
                                        </div>

                                        <a class="small text-muted" href="#!">Esqueceu o login?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #000000;">Não possui uma conta? <a href="./cadastro.php" style="color: #393f81;">Clique aqui</a></p>
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