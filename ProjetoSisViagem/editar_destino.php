<?php
require_once("conexao.php");

$mensagem = "";
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Erro: ID do destino não foi fornecido!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['estado'])) {
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $pais = $_POST['pais'];
        $id_formulario = $_POST['id_destino'];

        try {
            $sql = "UPDATE destinos SET estado = ?, cidade = ?, pais = ? WHERE id_destinos = ?";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([$estado, $cidade, $pais, $id_formulario])) {
                header("Location: destinos.php?edicao=sucesso");
                exit();
            }
            
            $mensagem = '<div class="alert alert-danger">Erro ao atualizar o destino.</div>';

        } catch (Exception $e) {
            $mensagem = '<div class="alert alert-danger">Erro: ' . $e->getMessage() . '</div>';
        }
    }
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

require_once("cabecalho.php");
?>

<div class="container mt-4">
    <h2>Editar Destino</h2>

    <?= $mensagem ?>

    <form method="post" action="editar_destino.php?id=<?= htmlspecialchars($id) ?>">
        <input type="hidden" name="id_destino" value="<?= htmlspecialchars($id) ?>">

        <div class="mb-3">
            <label for="estado" class="form-label">Nome do Estado</label>
            <input type="text" id="estado" name="estado" class="form-control" required value="<?= htmlspecialchars($destino['estado']) ?>">
        </div>

        <div class="mb-3">
            <label for="cidade" class="form-label">Nome da Cidade</label>
            <input type="text" id="cidade" name="cidade" class="form-control" required value="<?= htmlspecialchars($destino['cidade']) ?>">
        </div>

        <div class="mb-3">
            <label for="pais" class="form-label">Nome do País</label>
            <input type="text" id="pais" name="pais" class="form-control" required value="<?= htmlspecialchars($destino['pais']) ?>">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="destinos.php" class="btn btn-secondary">Voltar para a Lista</a>
    </form>
</div>

<?php require_once("rodape.php"); ?>