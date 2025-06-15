<?php
require_once("cabecalho.php");
require_once("conexao.php");

$mensagem = "";

if (isset($_POST['id_destino']) && !empty($_POST['id_destino'])) {
    $id = $_POST['id_destino'];
} else {
    die("Erro: ID do destino não foi fornecido!");
}

try {
    $sql = "SELECT * FROM destinos WHERE id_destinos = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $destino = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$destino) {
        die("Erro: Destino não encontrado.");
    }
} catch (Exception $e) {
    die("Erro ao consultar o destino: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['estado'])) {
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $pais = $_POST['pais'];

    try {
        $sql = "UPDATE destinos SET estado = ?, cidade = ?, pais = ? WHERE id_destinos = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$estado, $cidade, $pais, $id])) {
            header("Location: destinos.php?edicao=sucesso");
            exit();
        } else {
            $mensagem = '<div class="alert alert-danger">Erro ao atualizar destino.</div>';
        }
    } catch (Exception $e) {
        $mensagem = '<div class="alert alert-danger">Erro ao atualizar destino: ' . $e->getMessage() . '</div>';
    }
}
?>

<h2>Editar Destino</h2>

<?= $mensagem ?>

<form method="post">
    <input type="hidden" name="id_destino" value="<?= $destino['id_destinos'] ?>">

    <div class="mb-3">
        <label for="estado" class="form-label">Nome do Estado</label>
        <input type="text" id="estado" name="estado" class="form-control" required value="<?= $destino['estado'] ?>">
    </div>

    <div class="mb-3">
        <label for="cidade" class="form-label">Nome da Cidade</label>
        <input type="text" id="cidade" name="cidade" class="form-control" required value="<?= $destino['cidade'] ?>">
    </div>

    <div class="mb-3">
        <label for="pais" class="form-label">Nome do País</label>
        <input type="text" id="pais" name="pais" class="form-control" required value="<?= $destino['pais'] ?>">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Voltar</button>
</form>

<?php require_once("rodape.php"); ?>