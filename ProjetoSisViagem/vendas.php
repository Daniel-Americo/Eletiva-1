<?php
    require_once("cabecalho.php");

    function retornaVendas() {
        require("conexao.php");
        try {
            $sql = "SELECT * FROM Vendas";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(); // Retorna os registros
        } catch (Exception $e) {
            die("Erro ao consultar as vendas: " . $e->getMessage());
        }
    }

    $vendas = retornaVendas();
?>

<h2>Vendas</h2>
<a href="nova_venda.php" class="btn btn-success mb-3">Nova Venda</a>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Data Contratação</th>
            <th>Status da Reserva</th>
            <th>ID do Pacote</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vendas as $v): ?>
            <tr>
                <td><?= $v['id_vendas'] ?></td>
                <td><?= $v['data_contratacao'] ?></td>
                <td><?= $v['status_reserva'] ?></td>
                <td><?= $v['pacotes_idpacotes'] ?></td>
                <td>
                    <a href="editar_venda.php?id=<?= $v['id_vendas'] ?>" class="btn btn-warning">Editar</a>
                    <a href="consultar_venda.php?id=<?= $v['id_vendas'] ?>" class="btn btn-info">Consultar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    require_once("rodape.php");
?>
