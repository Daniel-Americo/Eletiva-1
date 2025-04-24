<?php
    require_once("cabecalho.php");

    function retornaCategorias(){
        require("conexao.php");
        try {
            $sql = "SELECT * FROM categoria"; 
            $stmt = $pdo->query($sql);//quando for fazer a consulta(condição)
            return $stmt -> fetchAll(); //PEGA todos os registros do banco de dados. em formato de array

        }catch (exception $e){
            die ("erro ao consultar as categrias: ". $e->GetMessage());
        }
    }

    $categorias = retornaCategorias(); //armazena os dados que vier do banco

?>


<h2>Categorias</h2>
    <a href="nova_categoria.php" class="btn btn-success mb-3">Novo Registro</a>

    <?php
        if (isset($_GET['cadastro']) && $_GET['cadastro'] == true) 
        {
            echo '<p class="text-success">Registro Salvo com sucesso! </p>';

        }elseif (isset($_GET['cadastro']) && $_GET['cadastro'] == false)
        {
            echo '<p class="text-danger">Erro ao Inserir o Registro! </p>';
        }
    ?>

    <table class="table table-hover table-striped" id="tabela">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($categorias as $c): //vai percorrer todas as linhas a cada laço/linha do categorias e por em $c
            ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td><?= $c['nome'] ?></td>
                    <td>
                        <a href="#" class="btn btn-warning">Editar</a>
                        <a href="#" class="btn btn-info">Consultar</a>
                    </td>
                </tr>
            <?php 
            endforeach
            ?>
        </tbody>
    </table>


<?php
    require_once("rodape.php");
?>