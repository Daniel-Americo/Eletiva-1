<?php
require_once("conexao.php");

function consultaPacote($pdo, $id) {
    try {
        $sql = "SELECT * FROM pacotes WHERE idpacotes = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    } catch (Exception $e) {
        die("Erro ao Consultar Pacote: " . $e->getMessage());
    }
}

function alterarPacote($pdo, $data_inicio, $fim_pacote, $valor, $destino_id_destino, $id) {
    try {
        $sql = "UPDATE pacotes SET data_inicio = ?, fim_pacote = ?, valor = ?, destino_id_destino = ? WHERE idpacotes = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$data_inicio, $fim_pacote, $valor, $destino_id_destino, $id])) {
            header('location: pacotes.php?edicao=sucesso');
            exit();
        } else {
            header('location: pacotes.php?edicao=erro');
            exit();
        }
    } catch (Exception $e) {
        die("Erro ao alterar pacote: " . $e->getMessage());
    }
}

$id = $_POST['id'] ?? $_GET['id'] ?? null;

if (!$id) {
    die("Erro: ID do pacote não foi fornecido!");
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data_inicio = $_POST['data_inicio'];
    $fim_pacote = $_POST['fim_pacote'];
    $valor = $_POST['valor'];
    $destino_id_destino = $_POST['destino_id_destino'];
    
    alterarPacote($pdo, $data_inicio, $fim_pacote, $valor, $destino_id_destino, $id); 
}

$pacote = consultaPacote($pdo, $id);

if (!$pacote) {
    die("Erro: Pacote com o ID fornecido não foi encontrado.");
}

require_once("cabecalho.php");
?>

<div class="container mt-4">
    <h2>Alterar Pacote</h2>

    <form method="post" action="editar_pacote.php?id=<?= htmlspecialchars($pacote['idpacotes']) ?>">
        <input type="hidden" name="id" value="<?= htmlspecialchars($pacote['idpacotes']) ?>">

        <div class="mb-3">
            <label for="data_inicio" class="form-label">Data de Inicio</label>
            <input type="date" id="data_inicio" name="data_inicio" class="form-control" required value="<?= htmlspecialchars($pacote['data_inicio']) ?>">
        </div>

        <div class="mb-3">
            <label for="fim_pacote" class="form-label">Data de Fim</label>
            <input type="date" id="fim_pacote" name="fim_pacote" class="form-control" required value="<?= htmlspecialchars($pacote['fim_pacote']) ?>">
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input type="number" step="0.01" id="valor" name="valor" class="form-control" required value="<?= htmlspecialchars($pacote['valor']) ?>">
        </div>

        <div class="mb-3">
            <label for="destino_id_destino" class="form-label">ID do Destino</label>
            <input type="number" id="destino_id_destino" name="destino_id_destino" class="form-control" required value="<?= htmlspecialchars($pacote['destino_id_destino']) ?>">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="pacotes.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php require_once("rodape.php"); ?>