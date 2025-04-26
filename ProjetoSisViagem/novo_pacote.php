<?php
    require_once("cabecalho.php");

    // Função para inserir um novo pacote turístico
    function inserirPacote($data_inicio, $fim_pacote, $valor, $destino_id_destino, $clientes_clientes) {
        require("conexao.php");
        try {
            $sql = "INSERT INTO pacotes (data_inicio, fim_pacote, valor, destino_id_destino, clientes_clientes) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$data_inicio, $fim_pacote, $valor, $destino_id_destino, $clientes_clientes])) {
                header('location: pacotes.php?cadastro=true'); // Redireciona em caso de sucesso
            } else {
                header('location: pacotes.php?cadastro=false'); // Redireciona em caso de erro
            }
        } catch (Exception $e) {
            die("Erro ao inserir pacote: " . $e->getMessage());
        }
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Recebe as datas no formato padrão (YYYY-MM-DD) do campo tipo date
        $data_inicio = $_POST['data_inicio'];
        $fim_pacote = $_POST['fim_pacote'];

        $valor = $_POST['valor'];
        $destino_id_destino = $_POST['destino_id_destino'];
        $clientes_clientes = $_POST['clientes_clientes'];

        inserirPacote($data_inicio, $fim_pacote, $valor, $destino_id_destino, $clientes_clientes);
    }
?>

<h2>Novo Pacote</h2>

<form method="post">
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