<?php
require_once("cabecalho.php");
require("conexao.php");

function retornaClientes($pdo) {
    try {
        $sql = "SELECT * FROM clientes";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        die("Erro ao consultar os clientes: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cliente'])) {
    $id = $_POST['id_cliente'];

    try {
        $sql = "DELETE FROM clientes WHERE idclientes = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$id])) {
            header('Location: consultar_cliente.php?exclusao=sucesso');
            exit;
        } else {
            header('Location: consultar_cliente.php?exclusao=erro');
            exit;
        }
    } catch (Exception $e) {
        die("Erro ao excluir cliente: " . $e->getMessage());
    }
}

$clientes = retornaClientes($pdo);
?>

<h2>Consultar Clientes</h2>

<?php if (isset($_GET['exclusao'])): ?>

    <?php if ($_GET['exclusao'] === 'sucesso'): ?>

        <div class="alert alert-success">Cliente excluído com sucesso!</div>

    <?php elseif ($_GET['exclusao'] === 'erro'): ?>

        <div class="alert alert-danger">Erro ao excluir cliente!</div>
        
    <?php endif; ?>
<?php endif; ?>

<?php foreach ($clientes as $cliente): ?>
    <div class="mb-2">
        <p>Nome: <strong><?= $cliente['nome'] ?></strong></p>
        <p>Telefone: <strong><?= $cliente['tel'] ?></strong></p>
        <p>CPF: <strong><?= $cliente['CPF'] ?></strong></p>
        <p>RG: <strong><?= $cliente['Rg'] ?></strong></p>
        <p>Data de Nascimento: <strong><?= date("d/m/Y", strtotime($cliente['datanascimento'])) ?></strong></p>
        <p>Email: <strong><?= $cliente['email'] ?></strong></p>
        <div style="display: flex; gap: 10px; align-items: center;">
            <form method="post" style="margin: 0;">
                <input type="hidden" name="id_cliente" value="<?= $cliente['idclientes'] ?>">
                <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
            <button type="button" class="btn btn-secondary" onclick="history.back()">Voltar</button>
        </div>
    </div>
<?php endforeach; ?>

<?php require_once("rodape.php"); ?>