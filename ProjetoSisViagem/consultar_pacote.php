<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pacote_excluir'])) {
    $id_pacote = $_POST['id_pacote_excluir'];

    try {
        $sql = "DELETE FROM pacotes WHERE idpacotes = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$id_pacote])) {
            $_SESSION['mensagem'] = "Pacote excluído com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao excluir o pacote.";
        }
    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Erro ao excluir pacote. Verifique as dependências.";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

function retornaPacotes($pdo) {
    try {
        $sql = "SELECT * FROM pacotes ORDER BY idpacotes DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao consultar os pacotes: " . $e->getMessage());
    }
}

$pacotes = retornaPacotes($pdo);

require_once("cabecalho.php");
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Consulta de Pacotes</h2>
    </div>
    
    <?php if (isset($_SESSION['mensagem'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php if (empty($pacotes)): ?>
            <div class="col-12">
                <div class="alert alert-secondary text-center">
                    Nenhum pacote cadastrado no momento.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($pacotes as $pacote): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Pacote ID: <?= htmlspecialchars($pacote['idpacotes']) ?></h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Destino ID:</strong> <?= htmlspecialchars($pacote['destino_id_destino']) ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Período:</strong>
                                    <?= htmlspecialchars(date('d/m/Y', strtotime($pacote['data_inicio']))) ?>
                                    a
                                    <?= htmlspecialchars(date('d/m/Y', strtotime($pacote['fim_pacote']))) ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Valor:</strong> R$ <?= htmlspecialchars(number_format($pacote['valor'], 2, ',', '.')) ?>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-light text-end">
                            <form method="post" id="form-excluir-<?= $pacote['idpacotes'] ?>" style="display: inline;">
                                <input type="hidden" name="id_pacote_excluir" value="<?= $pacote['idpacotes'] ?>">
                                <button type="button" onclick="confirmarExclusao('form-excluir-<?= $pacote['idpacotes'] ?>')" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <hr>

    <div class="text-center mt-4 mb-4">
        <a href="pacotes.php" class="btn btn-secondary">Voltar</a>
    </div>
</div>

<?php require_once("rodape.php"); ?>