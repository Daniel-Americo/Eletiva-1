<?php
    require_once("cabecalho.php");

    function retornaVendasComDetalhes() {
        require("conexao.php"); 
        try {

            $sql = "SELECT
                        v.id_vendas,
                        v.data_contratacao,
                        v.status_reserva,
                        c.nome AS nome_cliente,
                        p.valor AS valor_pacote,
                        d.cidade AS cidade_destino,
                        d.estado AS estado_destino,
                        d.pais AS pais_destino,
                        p.idpacotes AS id_pacote_associado
                    FROM
                        Vendas v
                    JOIN
                        clientes c ON v.clientes_idclientes = c.idclientes
                    JOIN
                        pacotes p ON v.pacotes_idpacotes = p.idpacotes
                    JOIN
                        destinos d ON p.destino_id_destino = d.id_destinos
                    ORDER BY
                        v.data_contratacao DESC"; 
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } catch (Exception $e) {
            die("Erro ao consultar as vendas com detalhes: " . $e->getMessage());
        }
    }

    $vendas = retornaVendasComDetalhes();
?>

<h2>Vendas Registradas</h2>
<a href="nova_venda.php" class="btn btn-success mb-3">Nova Venda</a>

<table class="table table-hover table-striped" id="tabela">
    <thead>
        <tr>
            <th>ID Venda</th>
            <th>Data Contratação</th>
            <th>Status Reserva</th>
            <th>Cliente</th>
            <th>Valor Pacote</th>
            <th>Destino (Cidade/País)</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($vendas)): ?>
            <?php foreach ($vendas as $v): ?>
                <tr>
                    <td><?= $v['id_vendas'] ?></td>
                    <td><?= date("d/m/Y", strtotime($v['data_contratacao'])) ?></td>
                    <td><?= $v['status_reserva'] ?></td>
                    <td><?= $v['nome_cliente'] ?></td>
                    <td>R$ <?= number_format($v['valor_pacote'], 2, ',', '.') ?></td>
                    <td><?= $v['cidade_destino'] ?>/<?= $v['pais_destino'] ?></td>
                    <td>
                        <a href="editar_venda.php?id=<?= $v['id_vendas'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="consultar_venda.php?id=<?= $v['id_vendas'] ?>" class="btn btn-info btn-sm">Consultar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Nenhuma venda encontrada.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
    require_once("rodape.php");
?>