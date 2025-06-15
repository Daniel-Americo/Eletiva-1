<?php
require_once("cabecalho.php");
require_once("conexao.php");

$mensagem = "";

if (!isset($_POST['id']) || empty($_POST['id'])) {
    die("ID da venda nao fornecido!");
}

$id = $_POST['id'];

try {
    $sql = "SELECT * FROM vendas WHERE id_vendas = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $venda = $stmt->fetch();
} catch (Exception $e) {
    die("Erro ao buscar venda: " . $e->getMessage());
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
            $mensagem = '<div class="alert alert-danger">Erro ao atualizar venda.</div>';
        }
    } catch (Exception $e) {
        $mensagem = '<div class="alert alert-danger">Erro ao atualizar venda: ' . $e->getMessage() . '</div>';
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM vendas WHERE id_vendas = ?");
        $stmt->execute([$id]);
        $venda = $stmt->fetch();
    } catch (Exception $e) {
        die("Erro ao recarregar venda: " . $e->getMessage());
    }
}
?>

<h2>Editar Venda</h2>

<?= $mensagem ?>

<form method="post">
    <input type="hidden" name="id" value="<?= $venda['id_vendas'] ?>">

    <div class="mb-3">
        <label for="data_contratacao" class="form-label">Data da Contratacao</label>
        <input type="date" id="data_contratacao" name="data_contratacao" class="form-control" required value="<?= $venda['data_contratacao'] ?>">
    </div>

    <div class="mb-3">
        <label for="status_reserva" class="form-label">Status da Reserva</label>
        <select id="status_reserva" name="status_reserva" class="form-control" required>
            <option value="Concluida" <?= $venda['status_reserva'] === 'Concluida' ? 'selected' : '' ?>>Concluida</option>
            <option value="Confirmada" <?= $venda['status_reserva'] === 'Confirmada' ? 'selected' : '' ?>>Confirmada</option>
            <option value="Pendente" <?= $venda['status_reserva'] === 'Pendente' ? 'selected' : '' ?>>Pendente</option>
            <option value="Cancelada" <?= $venda['status_reserva'] === 'Cancelada' ? 'selected' : '' ?>>Cancelada</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="pacotes_idpacotes" class="form-label">Codigo do Pacote</label>
        <input type="number" id="pacotes_idpacotes" name="pacotes_idpacotes" class="form-control" required value="<?= $venda['pacotes_idpacotes'] ?>">
    </div>

    <div class="mb-3">
        <label for="clientes_idclientes" class="form-label">Codigo do Cliente</label>
        <input type="number" id="clientes_idclientes" name="clientes_idclientes" class="form-control" required value="<?= $venda['clientes_idclientes'] ?>">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Voltar</button>
</form>

<?php require_once("rodape.php"); ?>