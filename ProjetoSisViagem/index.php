<?php
session_start();
require_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $stmt = $pdo->prepare('SELECT * FROM usuarios where email = ?');
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario['nome'];
            $_SESSION['acesso'] = true;
            $_SESSION['id'] = $usuario['id'];
            header('Location: principal.php');
            exit;
        } else {
            $message['erro'] = "Usuário e/ou senha incorretos!";
        }
    } catch (Exception $e) {
        $message['erro'] = "Erro ao processar login: " . $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - DAT Viagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 15px;
            margin: auto;
        }
    </style>
</head>
<body>

<main class="login-card">
    <div class="card shadow">
        <div class="card-body p-4 p-md-5">

            <div class="text-center mb-4">
                <img src="imagens/logo1.png" alt="DAT Viagens Logo" style="width: 90px; height: auto;">
                <h3 class="mt-3">Acesse sua Conta</h3>
            </div>

            <?php if (isset($message['erro'])) : ?>
                <div class="alert alert-danger">
                    <?= $message['erro'] ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['mensagem']) && $_GET['mensagem'] == "acesso_negado") : ?>
                <div class="alert alert-warning">
                    Você precisa fazer login para acessar o sistema.
                </div>
            <?php endif; ?>
            
            <form action="index.php" method="POST">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" required>
                    <label for="email">Endereço de email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                    <label for="senha">Senha</label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">Acessar</button>
                </div>

                <div class="text-center">
                    <small>Não possui acesso? <a href="novo_usuario.php">Cadastre-se</a></small>
                </div>
            </form>

        </div>
    </div>
</main>

</body>
</html>