<?php
require_once("conexao.php");

$mensagem = "";

$id = $_POST['id'] ?? $_GET['id'] ?? null;

if (!$id) {
    die("ID da venda não foi fornecido!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status_reserva'])) {
    $data_contratacao = $_POST['data_contratacao'];
    $status_reserva = $_POST['status_reserva'];
    $pacotes_idpacotes = $_POST['pacotes_idpacotes'];
    $clientes_idclientes = $_POST['clientes_idclientes'];

    try {
        $sql = "UPDATE vendas SET data_contratacao = ?, status_reserva = ?, pacotes_idpacotes = ?, clientes_idclientes = ? WHERE id_vendas = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$data_contratacao, $status_reserva, $pacotes_idpacotes, $clientes_idclientes, $id])) {
            header("Location: vendas.php?edicao=sucesso");
            exit();
        } else {
            $mensagem = '<div class="alert alert-danger">Erro ao atualizar a venda.</div>';
        }
    } catch (Exception $e) {
        $mensagem = '<div class="alert alert-danger">Erro ao atualizar a venda: ' . $e->getMessage() . '</div>';
    }
}

try {
    $sql = "SELECT * FROM vendas WHERE id_vendas = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $venda = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$venda) {
        die("Venda não encontrada!");
    }
} catch (Exception $e) {
    die("Erro ao buscar os dados da venda: " . $e->getMessage());
}

require_once("cabecalho.php");
?>

<div class="container mt-4">
    <h2>Editar Venda</h2>

    <?= $mensagem ?>

    <form method="post" action="editar_venda.php?id=<?= htmlspecialchars($venda['id_vendas']) ?>">
        <input type="hidden" name="id" value="<?= htmlspecialchars($venda['id_vendas']) ?>">

        <div class="mb-3">
            <label for="data_contratacao" class="form-label">Data da Contratação</label>
            <input type="date" id="data_contratacao" name="data_contratacao" class="form-control" required value="<?= htmlspecialchars($venda['data_contratacao']) ?>">
        </div>

        <div class="mb-3">
            <label for="status_reserva" class="form-label">Status da Reserva</label>
            <select id="status_reserva" name="status_reserva" class="form-control" required>
                <option value="Concluída" <?= ($venda['status_reserva'] ?? '') === 'Concluída' ? 'selected' : '' ?>>Concluída</option>
                <option value="Confirmada" <?= ($venda['status_reserva'] ?? '') === 'Confirmada' ? 'selected' : '' ?>>Confirmada</option>
                <option value="Pendente" <?= ($venda['status_reserva'] ?? '') === 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                <option value="Cancelada" <?= ($venda['status_reserva'] ?? '') === 'Cancelada' ? 'selected' : '' ?>>Cancelada</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="pacotes_idpacotes" class="form-label">Código do Pacote</label>
            <input type="number" id="pacotes_idpacotes" name="pacotes_idpacotes" class="form-control" required value="<?= htmlspecialchars($venda['pacotes_idpacotes']) ?>">
        </div>

        <div class="mb-3">
            <label for="clientes_idclientes" class="form-label">Código do Cliente</label>
            <input type="number" id="clientes_idclientes" name="clientes_idclientes" class="form-control" required value="<?= htmlspecialchars($venda['clientes_idclientes']) ?>">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="vendas.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php require_once("rodape.php"); ?>