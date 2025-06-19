<?php
require_once("cabecalho.php");
require_once("conexao.php");

function getDashboardData($pdo) {
    $data = [];
    try {
        $stmt_vendas = $pdo->query("SELECT COUNT(id_vendas) AS total FROM vendas");
        $data['total_vendas'] = $stmt_vendas->fetchColumn();

        $stmt_faturamento = $pdo->query("SELECT SUM(p.valor) FROM vendas v JOIN pacotes p ON v.pacotes_idpacotes = p.idpacotes");
        $data['faturamento_total'] = $stmt_faturamento->fetchColumn();

        $stmt_clientes = $pdo->query("SELECT COUNT(idclientes) AS total FROM clientes");
        $data['total_clientes'] = $stmt_clientes->fetchColumn();

        $stmt_pacotes = $pdo->query("SELECT COUNT(idpacotes) AS total FROM pacotes");
        $data['total_pacotes'] = $stmt_pacotes->fetchColumn();

    } catch (Exception $e) {
        $data = [
            'total_vendas' => 'N/D',
            'faturamento_total' => 'N/D',
            'total_clientes' => 'N/D',
            'total_pacotes' => 'N/D'
        ];
    }
    return $data;
}

$dashboard_data = getDashboardData($pdo);
$nome_usuario = $_SESSION['usuario'] ?? 'Usuário';
?>

<div class="container mt-4">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Bem-vindo, <?= htmlspecialchars($nome_usuario) ?>!</h1>
            <p class="col-md-8 fs-4">Este é o seu painel de controle central. Aqui você tem acesso rápido às principais funcionalidades e métricas do sistema DAT Viagens.</p>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-cart4"></i> Total de Vendas</h5>
                    <p class="display-4"><?= $dashboard_data['total_vendas'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-cash-coin"></i> Faturamento</h5>
                    <p class="display-4">R$ <?= htmlspecialchars(number_format($dashboard_data['faturamento_total'] ?? 0, 2, ',', '.')) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-info h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people-fill"></i> Clientes</h5>
                    <p class="display-4"><?= $dashboard_data['total_clientes'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-box2-heart"></i> Pacotes</h5>
                    <p class="display-4"><?= $dashboard_data['total_pacotes'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <div class="text-center">
        <h3>Acesso Rápido</h3>
        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <a href="nova_venda.php" class="btn btn-primary btn-lg px-4 gap-3">Registrar Venda</a>
            <a href="novo_pacote.php" class="btn btn-secondary btn-lg px-4">Novo Pacote</a>
            <a href="novo_cliente.php" class="btn btn-outline-primary btn-lg px-4">Novo Cliente</a>
        </div>
    </div>

</div>

<?php require_once("rodape.php"); ?>