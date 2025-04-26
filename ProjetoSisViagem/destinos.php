<?php
    require_once("cabecalho.php");

    function retornaDestinos() {
        require("conexao.php");
        try {
            $sql = "SELECT * FROM destinos";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(); // Retorna os registros
        } catch (Exception $e) {
            die("Erro ao consultar os destinos: " . $e->getMessage());
        }
    }

    $destinos = retornaDestinos();
?>

<h2>Destinos</h2>
<a href="novo_destino.php" class="btn btn-success mb-3">Novo Registro</a>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>País</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($destinos as $d): ?>
            <tr>
                <td><?= $d['id_destinos'] ?></td>
                <td><?= $d['estado'] ?></td>
                <td><?= $d['cidade'] ?></td>
                <td><?= $d['pais'] ?></td>
                <td>
                    <a href="editar_destino.php?id=<?= $d['id_destinos'] ?>" class="btn btn-warning">Editar</a>
                    <a href="consultar_destino.php?id=<?= $d['id_destinos'] ?>" class="btn btn-info">Consultar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    require_once("rodape.php");
?>