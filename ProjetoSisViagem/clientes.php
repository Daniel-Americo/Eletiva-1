<?php
require_once("cabecalho.php");

function retornaClientes() {
    require("conexao.php");
    try {
        $sql = "SELECT * FROM clientes";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        die("Erro ao consultar os clientes: " . $e->getMessage());
    }
}

$clientes = retornaClientes();
?>

<h2>Clientes</h2>

<?php if (isset($_GET['edicao']) && $_GET['edicao'] === 'sucesso'): ?>
    <div class="alert alert-success">Cliente atualizado com sucesso!</div>
<?php endif; ?>

<a href="novo_cliente.php" class="btn btn-success mb-3">Novo Cliente</a>

<table class="table table-hover table-striped" id="tabela">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Tel</th>
            <th>CPF</th>
            <th>RG</th>
            <th>Data de Nascimento</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $c): ?>
            <tr>
                <td><?= $c['idclientes'] ?></td>
                <td><?= $c['nome'] ?></td>
                <td><?= $c['tel'] ?></td>
                <td><?= $c['CPF'] ?></td>
                <td><?= $c['Rg'] ?></td>
                <td><?= date("d/m/Y", strtotime($c['datanascimento'])) ?></td>
                <td><?= $c['email'] ?></td>
                <td>
                    <form action="editar_cliente.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $c['idclientes'] ?>">
                        <button type="submit" class="btn btn-warning">Editar</button>
                    </form>
                    <form action="consultar_cliente.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $c['idclientes'] ?>">
                        <button type="submit" class="btn btn-info">Consultar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once("rodape.php"); ?>