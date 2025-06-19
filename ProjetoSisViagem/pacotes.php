<?php
require_once("cabecalho.php");
require_once("conexao.php");

function retornaPacotes($pdo) {
    try {
        $sql = "SELECT 
                    p.idpacotes, 
                    p.data_inicio, 
                    p.fim_pacote, 
                    p.valor, 
                    p.destino_id_destino, 
                    d.cidade AS destino_cidade
                FROM 
                    pacotes p
                JOIN 
                    destinos d ON p.destino_id_destino = d.id_destinos
                ORDER BY p.idpacotes DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao consultar os pacotes: " . $e->getMessage());
    }
}

$pacotes = retornaPacotes($pdo);
?>

<div class="container mt-4">
    <h2>Pacotes</h2>
    <a href="novo_pacote.php" class="btn btn-success mb-3">Novo Pacote</a>

    <?php 
    if (isset($_GET['edicao']) && $_GET['edicao'] === 'sucesso') {
        $_SESSION['mensagem'] = "Registro alterado com sucesso!";
    }
    if (isset($_SESSION['mensagem'])) : 
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <table class="table table-hover table-striped" id="tabela">
        <thead>
            <tr>
                <th>ID Pacote</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>Valor</th>
                <th>Destino</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pacotes as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['idpacotes']) ?></td>
                    <td><?= htmlspecialchars(date("d/m/Y", strtotime($p['data_inicio']))) ?></td>
                    <td><?= htmlspecialchars(date("d/m/Y", strtotime($p['fim_pacote']))) ?></td>
                    <td>R$ <?= htmlspecialchars(number_format($p['valor'], 2, ',', '.')) ?></td>
                    <td><?= htmlspecialchars($p['destino_cidade']) ?></td>
                    <td>
                        <a href="editar_pacote.php?id=<?= htmlspecialchars($p['idpacotes']) ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="consultar_pacote.php?id=<?= htmlspecialchars($p['idpacotes']) ?>" class="btn btn-info btn-sm">Consultar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once("rodape.php"); ?>