<?php 
    require_once('cabecalho.php');

    function retornaDadosUsuario(){
        require("conexao.php");
        try{
            $sql = "SELECT * FROM usuarios WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_SESSION['id']]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$usuario){
                die("Erro ao Consultar Usuário");
            }
            else {
                return $usuario;
            }
        }catch(exception $e){

            die ("Erro ao Consultar o Usuário:" . $e->getMessage());

        }
    }

    function alterarDadosUsuario($nome, $email){
        require("conexao.php");
        try {
            $sql = "UPDATE usuarios SET nome = ?, email = ? where id = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$nome, $email, $_SESSION['id']]))
                echo "<p class='text-success'> Dados Aalterados com sucesso! </p>";
            else 
                echo "<p class='text-danger'> Erro ao Alterar Dados! </p>";

        }catch(exception $e){
            die("Erro ao alterar dados do Usuário: ". $e->getMessage());
        }
    }

    function alterarSenha($senha_antiga, $novaSenha, $novaSenhaConfirm){
        require("conexao.php");
        try {
            if ($novaSenha == $novaSenhaConfirm){
                $usuario = retornaDadosUsuario();

                if(password_verify($senha_antiga, $usuario['senha'])){

                    $sql = "UPDATE usuarios SET senha = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $novaSenha = password_hash($novaSenha, PASSWORD_BCRYPT);

                    if($stmt->execute([$novaSenha, $_SESSION['id']])){
                        require("sair.php");
                    }
                    else{
                        echo "<p> class='text-danger'>Erro ao alterar senha!</p>";
                    }
                }
            }
            else {
                echo "<p> class='text-danger'>Senhas não conferem! </p>";
            }
                

        }catch(Exception $e){
            die ("Erro ao Alterar a senha!!! " . $e->getMessage());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['nome']) && isset($_POST['email'])) {
            alterarDadosUsuario($_POST['nome'], $_POST['email']);
        }
        else if (isset($_POST['nova_senha'])){

            alterarSenha($_POST['senha_antiga'], $_POST['nova_senha'], $_POST['nova_senha_confirm']);
        }
    }

    $usuario = retornaDadosUsuario();

?>

    <h3>Alteração de Dados Pessoais</h3>
    <form method="post">
            
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Usuário:</label>
                <input value="<?= $usuario['nome'] ?>" type="text" id="nome" name="nome" class="form-control" required="">
            </div>
        
            <div class="mb-3">
                <label for="email" class="form-label">E-mail do Usuário:</label>
                <input value="<?= $usuario['email'] ?>" type="email" id="email" name="email" class="form-control" required="">
            </div>
        
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <h3>Alteração de Senha</h3>
    
    <form method="post">
            <div class="mb-3">
                <label for="senha_antiga" class="form-label">Informe a Senha antiga:</label>
                <input type="password" id="senha_antiga" name="senha_antiga" class="form-control" required="">
            </div>
        
            <div class="mb-3">
                <label for="nova_senha" class="form-label">Informe a nova senha:</label>
                <input type="password" id="nova_senha" name="nova_senha" class="form-control" required="">
            </div>
        
            <div class="mb-3">
                <label for="nova_senha_confirm" class="form-label">Repita a nova senha:</label>
                <input type="password" id="nova_senha_confirm" name="nova_senha_confirm" class="form-control" required="">
            </div>
        
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
            






<?php
    require_once("rodape.php");