<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_venda_excluir'])) {
    $id_venda = $_POST['id_venda_excluir'];

    try {
        $sql = "DELETE FROM vendas WHERE id_vendas = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$id_venda])) {
            $_SESSION['mensagem'] = "Venda excluída com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao excluir a venda.";
        }
    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Erro ao excluir a venda.";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

function retornaVendas($pdo) {
    try {
        $sql = "SELECT 
                    v.id_vendas, v.data_contratacao, v.status_reserva,
                    c.nome AS cliente_nome,
                    p.idpacotes AS pacote_id,
                    d.cidade AS destino_cidade
                FROM 
                    vendas v
                JOIN 
                    clientes c ON v.clientes_idclientes = c.idclientes
                JOIN 
                    pacotes p ON v.pacotes_idpacotes = p.idpacotes
                JOIN 
                    destinos d ON p.destino_id_destino = d.id_destinos
                ORDER BY 
                    v.id_vendas DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao consultar as vendas: " . $e->getMessage());
    }
}

$vendas = retornaVendas($pdo);

require_once("cabecalho.php");
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Consulta de Vendas</h2>
    </div>
    
    <?php if (isset($_SESSION['mensagem'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php if (empty($vendas)): ?>
            <div class="col-12">
                <div class="alert alert-secondary text-center">
                    Nenhuma venda cadastrada no momento.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($vendas as $venda): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title mb-0">Venda #<?= htmlspecialchars($venda['id_vendas']) ?></h5>
                            <span><?= htmlspecialchars(date('d/m/Y', strtotime($venda['data_contratacao']))) ?></span>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Cliente:</strong> <?= htmlspecialchars($venda['cliente_nome']) ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Pacote:</strong> ID <?= htmlspecialchars($venda['pacote_id']) ?> (<?= htmlspecialchars($venda['destino_cidade']) ?>)
                                </li>
                                <li class="list-group-item">
                                    <strong>Status:</strong> <?= htmlspecialchars($venda['status_reserva']) ?>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-light text-end">
                            <form method="post" id="form-excluir-<?= $venda['id_vendas'] ?>" style="display: inline;">
                                <input type="hidden" name="id_venda_excluir" value="<?= $venda['id_vendas'] ?>">
                                <button type="button" onclick="confirmarExclusao('form-excluir-<?= $venda['id_vendas'] ?>')" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <hr>

    <div class="text-center mt-4 mb-4">
        <a href="vendas.php" class="btn btn-secondary">Voltar</a>
    </div>

</div>

<?php require_once("rodape.php"); ?>