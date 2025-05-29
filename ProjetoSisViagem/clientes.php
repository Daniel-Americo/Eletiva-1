<?php
    require_once("cabecalho.php");

    function retornaClientes() {
        require("conexao.php");
        try {
            $sql = "SELECT * FROM clientes";
            $stmt = $pdo->query($sql); // Busca todos os clientes
            return $stmt->fetchAll(); // Retorna os clientes em formato de array
        } catch (Exception $e) {
            die("Erro ao consultar os clientes: " . $e->getMessage());
        }
    }

    $clientes = retornaClientes(); // Obtém os clientes do banco de dados
?>

<h2>Clientes</h2>
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
                    <a href="editar_cliente.php?id=<?= $c['idclientes'] ?>" class="btn btn-warning">Editar</a>
                    <a href="consultar_cliente.php?id=<?= $c['idclientes'] ?>" class="btn btn-info">Consultar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    require_once("rodape.php");
?>