<?php
    require_once("cabecalho.php");

    // Função para inserir um novo pacote turístico
    function inserirPacote($data_inicio, $fim_pacote, $valor, $destino_id_destino, $clientes_clientes) {
        require("conexao.php");
        try {
            $sql = "INSERT INTO pacotes (data_inicio, fim_pacote, valor, destino_id_destino, clientes_clientes) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$data_inicio, $fim_pacote, $valor, $destino_id_destino, $clientes_clientes])) {
                header('location: pacotes.php?cadastro=true'); 
            } else {
                header('location: pacotes.php?cadastro=false');
            }
        } catch (Exception $e) {
            die("Erro ao inserir pacote: " . $e->getMessage());
        }
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Converte as datas do formato brasileiro para o formato do banco
        $data_inicio = DateTime::createFromFormat('d/m/Y', $_POST['data_inicio'])->format('Y-m-d');
        $fim_pacote = DateTime::createFromFormat('d/m/Y', $_POST['fim_pacote'])->format('Y-m-d');
        $valor = $_POST['valor'];
        $destino_id_destino = $_POST['destino_id_destino'];
        $clientes_clientes = $_POST['clientes_clientes'];
        inserirPacote($data_inicio, $fim_pacote, $valor, $destino_id_destino, $clientes_clientes);
    }
?>

<h2>Novo Pacote</h2>

<form method="post">
    <div class="mb-3">
        <label for="data_inicio" class="form-label">Data de Início (DD/MM/AAAA)</label>
        <input type="text" id="data_inicio" name="data_inicio" class="form-control" placeholder="Ex: 16/04/2025" required>
    </div>

    <div class="mb-3">
        <label for="fim_pacote" class="form-label">Data de Fim (DD/MM/AAAA)</label>
        <input type="text" id="fim_pacote" name="fim_pacote" class="form-control" placeholder="Ex: 20/04/2025" required>
    </div>

    <div class="mb-3">
        <label for="valor" class="form-label">Valor</label>
        <input type="number" step="0.01" id="valor" name="valor" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="destino_id_destino" class="form-label">ID do Destino</label>
        <input type="number" id="destino_id_destino" name="destino_id_destino" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="clientes_clientes" class="form-label">ID do Cliente</label>
        <input type="number" id="clientes_clientes" name="clientes_clientes" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Cancelar</button>
</form>

<?php
    require_once("rodape.php");
?>