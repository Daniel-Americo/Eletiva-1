<?php
require_once("cabecalho.php");
require_once("conexao.php");


function retornaPacotes($pdo) {
    try {
        $sql = "SELECT * FROM pacotes";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        die("Erro ao consultar os pacotes: " . $e->getMessage());
    }
}

$pacotes = retornaPacotes($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastro'])) {
    $_SESSION['mensagem'] = $_POST['cadastro'] === "true" ? "Registro salvo com sucesso!" : "Erro ao inserir o registro!";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edicao'])) {
    $_SESSION['mensagem'] = $_POST['edicao'] === "true" ? "Registro alterado com sucesso!" : "Erro ao alterar o registro!";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exclusao'])) {
    $_SESSION['mensagem'] = $_POST['exclusao'] === "true" ? "Registro excluído com sucesso!" : "Erro ao excluir o registro!";
}
?>

<h2>Pacotes</h2>
<a href="novo_pacote.php" class="btn btn-success mb-3">Novo Pacote</a>

<?php if (isset($_SESSION['mensagem'])) : ?>
    <div class="alert alert-info"><?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?></div>
<?php endif; ?>

<table class="table table-hover table-striped" id="tabela">
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
                    <form action="editar_pacote.php" method="post" style="display:inline;">
                        <input type="hidden" name="id_pacote" value="<?= $p['idpacotes'] ?>">
                        <button type="submit" class="btn btn-warning">Editar</button>
                    </form>
                    <form action="consultar_pacote.php" method="post" style="display:inline;">
                        <input type="hidden" name="id_pacote" value="<?= $p['idpacotes'] ?>">
                        <button type="submit" class="btn btn-info">Consultar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once("rodape.php"); ?>