<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cliente_excluir'])) {
    $id_cliente = $_POST['id_cliente_excluir'];

    try {
        $sql_check = "SELECT COUNT(*) FROM vendas WHERE clientes_idclientes = ?";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->execute([$id_cliente]);
        $vendas_count = $stmt_check->fetchColumn();

        if ($vendas_count > 0) {
            $_SESSION['mensagem_erro'] = "Não é possível excluir este cliente, pois ele possui vendas associadas.";
        } else {
            $sql_delete = "DELETE FROM clientes WHERE idclientes = ?";
            $stmt_delete = $pdo->prepare($sql_delete);
            if ($stmt_delete->execute([$id_cliente])) {
                $_SESSION['mensagem'] = "Cliente excluído com sucesso!";
            } else {
                $_SESSION['mensagem_erro'] = "Erro ao excluir o cliente.";
            }
        }
    } catch (Exception $e) {
        $_SESSION['mensagem_erro'] = "Erro ao excluir o cliente.";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


function retornaClientes($pdo) {
    try {
        $sql = "SELECT * FROM clientes ORDER BY nome";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao consultar os clientes: " . $e->getMessage());
    }
}

$clientes = retornaClientes($pdo);

require_once("cabecalho.php");
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Consulta de Clientes</h2>
    </div>
    
    <?php if (isset($_SESSION['mensagem'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['mensagem_erro'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensagem_erro']; unset($_SESSION['mensagem_erro']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php if (empty($clientes)): ?>
            <div class="col-12">
                <div class="alert alert-secondary text-center">
                    Nenhum cliente cadastrado no momento.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($clientes as $cliente): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><?= htmlspecialchars($cliente['nome']) ?></h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Email:</strong> <?= htmlspecialchars($cliente['email']) ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Telefone:</strong> <?= htmlspecialchars($cliente['tel']) ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>CPF:</strong> <?= htmlspecialchars($cliente['CPF'] ?? 'N/A') ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>RG:</strong> <?= htmlspecialchars($cliente['RG'] ?? 'N/A') ?>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-light text-end">
                            <form method="post" id="form-excluir-<?= $cliente['idclientes'] ?>" style="display: inline;">
                                <input type="hidden" name="id_cliente_excluir" value="<?= $cliente['idclientes'] ?>">
                                <button type="button" onclick="confirmarExclusao('form-excluir-<?= $cliente['idclientes'] ?>')" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <hr>

    <div class="text-center mt-4 mb-4">
        <a href="clientes.php" class="btn btn-secondary">Voltar</a>
    </div>

</div>

<?php require_once("rodape.php"); ?>