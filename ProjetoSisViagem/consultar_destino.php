<?php
require_once("cabecalho.php");
require_once("conexao.php");

function retornaDestinos($pdo) {
    try {
        $sql = "SELECT * FROM destinos";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        die("Erro ao consultar os destinos: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir_destino'])) {
    $id_destino = $_POST['excluir_destino'];

    try {
        $sql = "DELETE FROM destinos WHERE id_destinos = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$id_destino])) {
            $_SESSION['mensagem'] = "Destino excluído com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao excluir destino!";
        }
    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Erro ao excluir destino: " . $e->getMessage();
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$destinos = retornaDestinos($pdo);
?>

<h2>Consultar Destinos</h2>

<?php if (isset($_SESSION['mensagem'])) : ?>
    <div class="alert alert-info"><?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?></div>
<?php endif; ?>

<?php foreach ($destinos as $destino): ?>
    <div class="mb-2">
        <p>Estado: <strong><?= $destino['estado'] ?></strong></p>
        <p>Cidade: <strong><?= $destino['cidade'] ?></strong></p>
        <p>País: <strong><?= $destino['pais'] ?></strong></p>
        <div style="display: flex; gap: 10px; align-items: center;">
            <form method="post" style="margin: 0;">
                <input type="hidden" name="excluir_destino" value="<?= $destino['id_destinos'] ?>">
                <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
            <button type="button" class="btn btn-secondary" onclick="history.back()">Voltar</button>
        </div>
    </div>
<?php endforeach; ?>

<?php require_once("rodape.php"); ?>