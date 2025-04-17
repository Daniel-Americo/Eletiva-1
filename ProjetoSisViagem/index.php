<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de controle de viagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="container">
    <h1 class="mt-5">Sistema de pacote de controle de viagens</h1>

    <?php
        require_once('conexao.php');
        session_start(); // Inicia a sessão
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try{
                $email = $_POST['email'];
                $senha = $_POST['senha'];

                $stmt = $pdo->prepare('SELECT * FROM usuarios where email = ?'); //recebe o email que vem pelo post
                $stmt->execute([$email]);
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC); //variavel que busca no banco de dados o usuario

                if($usuario && password_verify($senha, $usuario['senha'])){ //verifica se existe o usuario no banco de dados, e se a senha bate com o banco de dados.
                    $_SESSION['usuario'] = $usuario['nome']; // Armazena o usuário
                    $_SESSION['acesso'] = true; // Acesso validado
                    $_SESSION['id'] = $usuario['id']; //nome no banco de dados
                    header('Location: principal.php'); // Redireciona para o principal.php
                    exit; // Finaliza o script após o redirecionamento
                } else {
                    $message['erro'] = "Usuário e/ou senha incorretos!";
                }
            } catch(Exception $e){
                echo "Erro: " . $e->getMessage();
                die();
            }   
        }
    ?>

    <?php if(isset($message['erro'])) : ?> 
        <div class="alert alert-danger mt-3 mb-3"> 
            <?= $message['erro'] ?>
        </div>
    <?php endif ?>

    <?php 

        if (isset(($_GET['mensagem'])) && ($_GET['mensagem'] == "acesso_negado")) : ?> 
            <div class="alert alert-danger mt-3 mb-3"> 
                Você precisa informar seus dados, para poder acessar o sistema!
            </div>
    <?php endif ?>

    <form action="" method="POST">
        <div class="row">
            <div class="col">
                <label for="email" class="form-label">Informe o email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col">        
                <label for="senha" class="form-label">Informe a senha</label>
                <input type="password" id="senha" name="senha" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary mt-3">Acessar</button>
            </div>
        </div>

        <div class="row">
            <div class="col"> 
                Não possui acesso? clique <a href="novo_usuario.php"> aqui </a>
            </div>
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
