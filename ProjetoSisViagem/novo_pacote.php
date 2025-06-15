<?php
require_once("cabecalho.php");
require_once("conexao.php");

function buscarDestinos($pdo) {
    try {
        $sql = "SELECT id_destinos, cidade, estado, pais FROM destinos ORDER BY cidade";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao buscar destinos: " . $e->getMessage());
    }
}

$destinos = buscarDestinos($pdo);

function inserirPacote($pdo, $data_inicio, $fim_pacote, $valor, $destino_id_destino) {
    try {
        $sql = "INSERT INTO pacotes (data_inicio, fim_pacote, valor, destino_id_destino) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$data_inicio, $fim_pacote, $valor, $destino_id_destino])) {
            $_SESSION['mensagem'] = "Pacote cadastrado com sucesso!";
            header("Location: pacotes.php");
            exit();
        } else {
            $_SESSION['mensagem'] = "Erro ao cadastrar o pacote!";
            header("Location: pacotes.php");
            exit();
        }
    } catch (Exception $e) {
        die("Erro ao inserir pacote: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['data_inicio']) && !empty($_POST['fim_pacote']) && !empty($_POST['valor']) && !empty($_POST['destino_id_destino'])) {
        inserirPacote($pdo, $_POST['data_inicio'], $_POST['fim_pacote'], $_POST['valor'], $_POST['destino_id_destino']);
    } else {
        $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios!";
        header("Location: pacotes.php");
        exit();
    }
}
?>

<h2>Novo Pacote</h2>

<?php if (isset($_SESSION['mensagem'])) : ?>
    <div class="alert alert-info">
        <?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
    </div>
<?php endif; ?>

<form method="post">
    <div class="mb-3">
        <label for="data_inicio" class="form-label">Data de Inicio</label>
        <input type="date" id="data_inicio" name="data_inicio" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="fim_pacote" class="form-label">Data de Fim</label>
        <input type="date" id="fim_pacote" name="fim_pacote" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="valor" class="form-label">Valor</label>
        <input type="number" step="0.01" id="valor" name="valor" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="destino_id_destino" class="form-label">Destino</label>
        <select id="destino_id_destino" name="destino_id_destino" class="form-control" required>
            <option value="">Selecione um destino</option>
            <?php foreach ($destinos as $d): ?>
                <option value="<?= $d['id_destinos'] ?>">
                    <?= $d['cidade'] ?> - <?= $d['estado'] ?> (<?= $d['pais'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Cancelar</button>
</form>

<?php require_once("rodape.php"); ?>