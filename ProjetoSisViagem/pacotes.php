<?php
    require_once("cabecalho.php");

    
    function retornaPacotes() {
        require("conexao.php");
        try {
            $sql = "SELECT * FROM pacotes";
            $stmt = $pdo->query($sql); 
            return $stmt->fetchAll(); 
        } catch (Exception $e) {
            die("Erro ao consultar os pacotes: " . $e->getMessage());
        }
    }

    $pacotes = retornaPacotes(); 
?>

<h2>Pacotes</h2>
<a href="novo_pacote.php" class="btn btn-success mb-3">Novo Pacote</a>

<?php
    if (isset($_GET['cadastro']) && $_GET['cadastro'] == true) {
        echo '<p class="text-success">Registro salvo com sucesso!</p>';
    } elseif (isset($_GET['cadastro']) && $_GET['cadastro'] == false) {
        echo '<p class="text-danger">Erro ao inserir o registro!</p>';
    }

    if (isset($_GET['edicao']) && $_GET['edicao'] == true) {
        echo '<p class="text-success">Registro alterado com sucesso!</p>';
    } elseif (isset($_GET['edicao']) && $_GET['edicao'] == false) {
        echo '<p class="text-danger">Erro ao alterar o registro!</p>';
    }

    if (isset($_GET['exclusao']) && $_GET['exclusao'] == true) {
        echo '<p class="text-success">Registro excluído com sucesso!</p>';
    } elseif (isset($_GET['exclusao']) && $_GET['exclusao'] == false) {
        echo '<p class="text-danger">Erro ao excluir o registro!</p>';
    }
?>

<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>ID Pacote</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Valor</th>
            <th>Destino ID</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pacotes as $p): ?>
            <tr>
                <td><?= $p['idpacotes'] ?></td>
                <td><?= date("d/m/Y", strtotime($p['data_inicio'])) ?></td>
                <td><?= date("d/m/Y", strtotime($p['fim_pacote'])) ?></td>
                <td><?= number_format($p['valor'], 2, ',', '.') ?></td>
                <td><?= $p['destino_id_destino'] ?></td>
                <td>
                    <a href="editar_pacote.php?id=<?= $p['idpacotes'] ?>" class="btn btn-warning">Editar</a>
                    <a href="consultar_pacote.php?id=<?= $p['idpacotes'] ?>" class="btn btn-info">Consultar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    require_once("rodape.php");
?>
