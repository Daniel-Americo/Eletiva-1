<?php
require_once("cabecalho.php");
require_once("conexao.php");

function consultaPacote($id) {
    require("conexao.php"); 
    try {
        $sql = "SELECT * FROM pacotes WHERE idpacotes = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $pacote = $stmt->fetch(PDO::FETCH_ASSOC); 
        if (!$pacote) {
            die("Erro ao Consultar o Registro!");
        } else {
            return $pacote;
        }
    } catch (Exception $e) {
        die("Erro ao Consultar Pacote: " . $e->getMessage());
    }
}

function alterarPacote($data_inicio, $fim_pacote, $valor, $destino_id_destino, $id) {
    require("conexao.php");
    try {
        $sql = "UPDATE pacotes SET data_inicio = ?, fim_pacote = ?, valor = ?, destino_id_destino = ? WHERE idpacotes = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$data_inicio, $fim_pacote, $valor, $destino_id_destino, $id])) {
            header('location: pacotes.php?edicao=true');
        } else {
            header('location: pacotes.php?edicao=false');
        }
    } catch (Exception $e) {
        die("Erro ao alterar pacote: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['id'])) {
    $data_inicio = $_POST['data_inicio'];
    $fim_pacote = $_POST['fim_pacote'];
    $valor = $_POST['valor'];
    $destino_id_destino = $_POST['destino_id_destino'];
    $id = $_POST['id'];

    alterarPacote($data_inicio, $fim_pacote, $valor, $destino_id_destino, $id); 
} else {
    if (!isset($_POST['id_pacote'])) {
        die("Erro: ID do pacote não foi fornecido!");
    }

    $id = $_POST['id_pacote'];
    $pacote = consultaPacote($id);
}
?>

<h2>Alterar Pacote</h2>

<form method="post">
    <input type="hidden" name="id" value="<?= $pacote['idpacotes'] ?>">

    <div class="mb-3">
        <label for="data_inicio" class="form-label">Data de Inicio</label>
        <input type="date" id="data_inicio" name="data_inicio" class="form-control" required value="<?= $pacote['data_inicio'] ?>">
    </div>

    <div class="mb-3">
        <label for="fim_pacote" class="form-label">Data de Fim</label>
        <input type="date" id="fim_pacote" name="fim_pacote" class="form-control" required value="<?= $pacote['fim_pacote'] ?>">
    </div>

    <div class="mb-3">
        <label for="valor" class="form-label">Valor</label>
        <input type="number" step="0.01" id="valor" name="valor" class="form-control" required value="<?= $pacote['valor'] ?>">
    </div>

    <div class="mb-3">
        <label for="destino_id_destino" class="form-label">ID do Destino</label>
        <input type="number" id="destino_id_destino" name="destino_id_destino" class="form-control" required value="<?= $pacote['destino_id_destino'] ?>">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Voltar</button>
</form>

<?php require_once("rodape.php"); ?>