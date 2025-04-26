<?php
    require_once("cabecalho.php");

    function consultaCategoria($id)
    {
        require("conexao.php"); //adiciona a conexão com banco de dados
        try {
            $sql = "SELECT * FROM categoria WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $categoria = $stmt->fetch(PDO::FETCH_ASSOC); //TRANSFORMA OS DADOS EM UM ARRAY
            if (!$categoria) {
                die("Erro ao Consultar o Registro!");
            } else {
                return $categoria;
            }
        } catch (Exception $e) {
            die("Erro ao Consultar Categoria: " . $e->getMessage());
        }
    }

    function excluirCategoria($id) { // função para excluir categoria
        require("conexao.php");
        try {
            $sql = "DELETE FROM categoria WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$id])) {
                header('location: categorias.php?exclusao=true'); 
            } else {
                header('location: categorias.php?exclusao=false');
            }
        } catch (Exception $e) {
            die("Erro ao excluir categoria: " . $e->getMessage());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        excluirCategoria($id); // chamada da função passando os valores
    } else {
        $categoria = consultaCategoria($_GET['id']);
    }
?>

<h2>Consultar Categoria</h2>

<form method="post" id="excluir-form">
    <input type="hidden" name="id" value="<?= $categoria['id'] ?>">

    <div class="mb-3">
        <p>Nome: <b><?= $categoria['nome']?></b> </p>
    </div>

    <div class="mb-3">
        <p>Descrição: <b><?= $categoria['descricao']?></b></p>
    </div>

    <div class="mb-3">
        <p class="text-danger">Deseja excluir este registro?</p>
        <button type="button" class="btn btn-danger" onclick="confirmarExclusao()">Excluir</button>
        <a href="categorias.php" class="btn btn-secondary">Voltar</a>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmarExclusao() {
        Swal.fire({
            title: "Tem certeza?",
            text: "Esta ação não pode ser desfeita!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sim, excluir!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("excluir-form").submit();
            }
        });
    }
</script>

<?php
    require_once("rodape.php");
?>
