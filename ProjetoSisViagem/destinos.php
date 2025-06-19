<?php
require_once("cabecalho.php");

function retornaDestinos() {
    require("conexao.php");
    try {
        $sql = "SELECT * FROM destinos";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        die("Erro ao consultar os destinos: " . $e->getMessage());
    }
}

$destinos = retornaDestinos();
?>

<h2>Destinos</h2>
<a href="novo_destino.php" class="btn btn-success mb-3">Novo Destino</a>

<table class="table table-hover table-striped" id="tabela">
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
                <td><?= htmlspecialchars($d['id_destinos']) ?></td>
                <td><?= htmlspecialchars($d['estado']) ?></td>
                <td><?= htmlspecialchars($d['cidade']) ?></td>
                <td><?= htmlspecialchars($d['pais']) ?></td>
                <td>
                    <a href="editar_destino.php?id=<?= htmlspecialchars($d['id_destinos']) ?>" class="btn btn-warning btn-sm">Editar</a>
                    
                    <form action="consultar_destino.php" method="post" style="display:inline;">
                        <input type="hidden" name="id_destino" value="<?= htmlspecialchars($d['id_destinos']) ?>">
                        <button type="submit" class="btn btn-info btn-sm">Consultar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
require_once("rodape.php");
?>