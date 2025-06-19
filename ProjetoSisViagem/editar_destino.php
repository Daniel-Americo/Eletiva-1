<?php
require_once("conexao.php");

$id = $_POST['id'] ?? $_GET['id'] ?? null;

if (!$id) {
    die("Erro: ID do destino não foi fornecido!");
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $pais = $_POST['pais'];

    try {
        $sql = "UPDATE destinos SET estado = ?, cidade = ?, pais = ? WHERE id_destinos = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$estado, $cidade, $pais, $id])) {
            header('location: destinos.php?edicao=sucesso');
            exit();
        }
    } catch (Exception $e) {
        die("Erro ao alterar destino: " . $e->getMessage());
    }
}

try {
    $sql = "SELECT * FROM destinos WHERE id_destinos = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $destino = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$destino) {
        die("Erro: Destino com o ID fornecido não foi encontrado.");
    }
} catch (Exception $e) {
    die("Erro ao consultar destino: " . $e->getMessage());
}

require_once("cabecalho.php");
?>

<div class="container mt-4">
    <h2>Alterar Destino</h2>

    <form method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($destino['id_destinos']) ?>">

        <div class="mb-3">
            <label for="cidade" class="form-label">Nome da Cidade</label>
            <input type="text" id="cidade" name="cidade" class="form-control" required value="<?= htmlspecialchars($destino['cidade']) ?>">
        </div>
        
        <div class="mb-3">
            <label for="estado" class="form-label">Nome do Estado</label>
            <input type="text" id="estado" name="estado" class="form-control" required value="<?= htmlspecialchars($destino['estado']) ?>">
        </div>

        <div class="mb-3">
            <label for="pais" class="form-label">Nome do País</label>
            <input type="text" id="pais" name="pais" class="form-control" required value="<?= htmlspecialchars($destino['pais']) ?>">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="destinos.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php require_once("rodape.php"); ?>