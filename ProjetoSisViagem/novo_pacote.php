<?php
require_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $data_inicio = $_POST['data_inicio'];
    $fim_pacote = $_POST['fim_pacote'];
    $valor = $_POST['valor'];
    $destino_id = $_POST['destino_id_destino'];
    
    try {
        $sql = "INSERT INTO pacotes (data_inicio, fim_pacote, valor, destino_id_destino) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$data_inicio, $fim_pacote, $valor, $destino_id])) {
            header("Location: pacotes.php?cadastro=sucesso");
            exit();
        }

    } catch (Exception $e) {
        $mensagem_erro = "Erro ao cadastrar pacote: " . $e->getMessage();
    }
}

function retornaDestinos($pdo) {
    try {
        $sql = "SELECT id_destinos, cidade, pais FROM destinos ORDER BY cidade";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao buscar destinos: " . $e->getMessage());
    }
}
$destinos = retornaDestinos($pdo);

require_once("cabecalho.php");
?>

<div class="container mt-4">
    <h2>Cadastrar Novo Pacote</h2>

    <?php if (isset($mensagem_erro)): ?>
        <div class="alert alert-danger"><?= $mensagem_erro ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="destino_id_destino" class="form-label">Destino</label>
            <select id="destino_id_destino" name="destino_id_destino" class="form-select" required>
                <option value="" disabled selected>Selecione um destino</option>
                <?php foreach ($destinos as $destino): ?>
                    <option value="<?= htmlspecialchars($destino['id_destinos']) ?>">
                        <?= htmlspecialchars($destino['cidade']) ?> / <?= htmlspecialchars($destino['pais']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="data_inicio" class="form-label">Data de Início</label>
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

        <button type="submit" class="btn btn-primary">Cadastrar Pacote</button>
        <a href="pacotes.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php
require_once("rodape.php");
?>