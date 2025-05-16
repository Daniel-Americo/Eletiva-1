<?php
    require_once("cabecalho.php"); // Incluindo o cabeçalho

    function retornaCateorias(){
        require("conexao.php");
        try {
            $sql = "SELECT * FROM categoria";
            $stmt = $pdo->query($sql);
            return $stmt->fetchall();
        }catch (exception $e){
            die ("Erro ao consultar categorias: ". $e->getMessage());
        }
    }

    function retornaProduto($id){
        require("conexao.php");
        try {
            $sql = "SELECT * FROM produto WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id']);
            $produto = $stmt->fetch();
            if(!$produto)
                die("Erro ao Retornar o produto!!!");
            else
                return $produto;
        }catch (exception $e) {
            die ("Erro ao consultar o produto: ". $e->getMessage());
        }
    }

    function alterarProduto($nome, $descricao, $preco, $categoria, $id){
        require("conexao.php");
        try {
            $sql = "UPDATE produto SET nome=?, descricao = ?, preco = ?, categoria_id = ? where id = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute ([$nome, $descricao, $preco, $categoria, $id]))
                header('location: produtos.php?edicao=true');  
            else
            header('location: produtos.php?edicao=false');
        }catch(exception $e) {
            die("Erro ao alterar produto: ". $e->getMessage());
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $preco = $_POST['preco'];
            $categoria = $_POST['categoria'];
            alterarProduto($nome, $preco, $descricao, $id, $categoria);
        } 
        else {
            $categorias = retornaCateorias();
            $produto = retornaProduto($_GET['id']);
        }
    }
?>

<h2>Editar Produto</h2>

<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input value="<?= $produto['nome']?>" type="text" id="nome" name="nome" class="form-control" required="">
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea  id="descricao" name="descricao" class="form-control" rows="4" required="" style="height: 103px;" <?= $produto['nome']?>></textarea>
    </div>

    <div class="mb-3">
        <label for="preco" class="form-label">preco</label>
        <input value="<?= $produto['preco']?>" type="number" id="preco" name="preco" class="form-control" required="">
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Voltar</button>
</form>

<?php
    require_once("rodape.php"); // Incluindo o rodapé
?>
