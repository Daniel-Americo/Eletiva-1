<?php
    require_once("cabecalho.php");

    // Função para inserir um novo pacote turístico (sem o ID do cliente)
    function inserirPacote($data_inicio, $fim_pacote, $valor, $destino_id_destino) {
        require("conexao.php");
        try {
            // Atualize a query para não incluir a coluna clientes_clientes
            $sql = "INSERT INTO pacotes (data_inicio, fim_pacote, valor, destino_id_destino) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$data_inicio, $fim_pacote, $valor, $destino_id_destino])) {
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

        inserirPacote($data_inicio, $fim_pacote, $valor, $destino_id_destino);
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

    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Cancelar</button>
</form>

<?php
    require_once("rodape.php");
?>
