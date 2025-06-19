<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir_destino'])) {
    $id_destino = $_POST['excluir_destino'];

    try {
        $sql = "DELETE FROM destinos WHERE id_destinos = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$id_destino])) {
            $_SESSION['mensagem'] = "Destino excluído com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao excluir destino.";
        }
    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Erro ao excluir destino. Verifique se não há viagens associadas a ele.";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

function retornaDestinos($pdo) {
    try {
        $sql = "SELECT * FROM destinos ORDER BY cidade";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao consultar os destinos: " . $e->getMessage());
    }
}

$destinos = retornaDestinos($pdo);

require_once("cabecalho.php");
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Consulta de Destinos</h2>
    </div>
    
    <?php if (isset($_SESSION['mensagem'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php if (empty($destinos)): ?>
            <div class="col-12">
                <div class="alert alert-secondary text-center">
                    Nenhum destino cadastrado no momento.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($destinos as $destino): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><?= htmlspecialchars($destino['cidade']) ?></h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>País:</strong> <?= htmlspecialchars($destino['pais']) ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Estado:</strong> <?= htmlspecialchars($destino['estado']) ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>ID:</strong> <?= htmlspecialchars($destino['id_destinos']) ?>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-light text-end">
                            <form method="post" onsubmit="return confirm('Tem certeza que deseja excluir este destino?');" style="display: inline;">
                                <input type="hidden" name="excluir_destino" value="<?= $destino['id_destinos'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <hr>

    <div class="text-center mt-4 mb-4">
        <a href="destinos.php" class="btn btn-secondary">Voltar</a>
    </div>

</div>

<?php require_once("rodape.php"); ?>