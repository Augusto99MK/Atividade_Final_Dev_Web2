<?php
session_start();

// Verificar se o usuário está autenticado
$autenticado = isset($_SESSION['usuario']);

// Verificar se o usuário tem permissão de acesso a esta página (apenas usuários autenticados podem acessar)
if ($autenticado) {
    // O usuário tem permissão, exiba o conteúdo da página

    // Verificar se a chave 'idAluno' está definida no array $_SESSION['usuario']
    if (isset($_SESSION['usuario']['idAluno'])) {
        // Obter o ID do aluno da sessão
        $idAluno = $_SESSION['usuario']['idAluno'];

        // Realizar a consulta para buscar os cursos do aluno
        require_once('../../conexao.php');
        $conexao = conectarBanco();

        try {
            $sql = "SELECT c.nomeCurso FROM curso c
                    INNER JOIN aluno a ON c.idCurso = a.idCurso
                    WHERE a.idPessoa = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(1, $idAluno);
            $stmt->execute();

            $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Ocorreu um erro: " . $e->getMessage());
        }
    } else {
        echo "ID do aluno não encontrado na sessão.";
    }
} else {
    // O usuário não tem permissão, exiba uma mensagem de erro
    echo "Você não tem permissão para acessar esta página.";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Meus Cursos</title>
    <!-- Adicione o link para o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Estilo personalizado para a tabela */
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Meus Cursos</h1>

        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome do Curso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($cursos) && $cursos) : ?>
                        <?php foreach ($cursos as $curso) : ?>
                            <tr>
                                <td><?php echo $curso['nomeCurso']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="1">Nenhum curso encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Adicione o link para o JavaScript do Bootstrap (opcional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>