<?php
    require_once("cabecalho.php");

    function retornaVendas() {
        require("conexao.php");
        try {
            $sql = "SELECT id_vendas, data_contratacao, status_reserva, pacotes_idpacotes FROM Vendas";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            die("Erro ao consultar as vendas: " . $e->getMessage());
        }
    }

    $vendas = retornaVendas();
?>

<h2>Vendas</h2>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>ID Venda</th>
            <th>Data Contratação</th>
            <th>Status da Reserva</th>
            <th>ID do Pacote</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vendas as $v): ?>
            <tr>
                <td><?= $v['id_vendas'] ?></td>
                <td><?= date("d/m/Y", strtotime($v['data_contratacao'])) ?></td>
                <td><?= $v['status_reserva'] ?></td>
                <td><?= $v['pacotes_idpacotes'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    require_once("rodape.php");
?>
