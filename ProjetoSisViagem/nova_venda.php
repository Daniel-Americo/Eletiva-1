<?php
require_once("conexao.php");

function retornaClientes($pdo) {
    try {
        $sql = "SELECT idclientes, nome FROM clientes ORDER BY nome ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao consultar clientes: " . $e->getMessage());
    }
}

function retornaPacotes($pdo) {
    try {
        $sql = "SELECT p.idpacotes, p.valor, d.cidade, d.pais 
                FROM pacotes p
                JOIN destinos d ON p.destino_id_destino = d.id_destinos
                ORDER BY d.cidade ASC, p.valor ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao consultar pacotes: " . $e->getMessage());
    }
}

function inserirVenda($pdo, $data_contratacao, $status_reserva, $pacotes_idpacotes, $clientes_idclientes) {
    try {
        $sql = "INSERT INTO Vendas (data_contratacao, status_reserva, pacotes_idpacotes, clientes_idclientes) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$data_contratacao, $status_reserva, $pacotes_idpacotes, $clientes_idclientes])) {
            header('location: vendas.php?cadastro=sucesso'); 
            exit(); 
        } else {
            header('location: vendas.php?cadastro=erro');
            exit();
        }
    } catch (Exception $e) {
        die("Erro ao inserir venda: " . $e->getMessage());
    }
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data_contratacao = $_POST['data_contratacao'];
    $status_reserva = $_POST['status_reserva'];
    $pacotes_idpacotes = $_POST['id_pacote']; 
    $clientes_idclientes = $_POST['id_cliente']; 

    inserirVenda($pdo, $data_contratacao, $status_reserva, $pacotes_idpacotes, $clientes_idclientes);
}

$clientes = retornaClientes($pdo);
$pacotes = retornaPacotes($pdo);

require_once("cabecalho.php");
?>

<div class="container mt-4">
    <h2>Registrar Nova Venda</h2>

    <form method="post">
        <div class="mb-3">
            <label for="id_cliente" class="form-label">Cliente</label>
            <select id="id_cliente" name="id_cliente" class="form-select" required>
                <option value="" disabled selected>Selecione um cliente</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= htmlspecialchars($cliente['idclientes']) ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_pacote" class="form-label">Pacote</label>
            <select id="id_pacote" name="id_pacote" class="form-select" required>
                <option value="" disabled selected>Selecione um pacote</option>
                <?php foreach ($pacotes as $pacote): ?>
                    <option value="<?= htmlspecialchars($pacote['idpacotes']) ?>">
                        Pacote #<?= htmlspecialchars($pacote['idpacotes']) ?> - <?= htmlspecialchars($pacote['cidade']) ?>/<?= htmlspecialchars($pacote['pais']) ?> (R$ <?= htmlspecialchars(number_format($pacote['valor'], 2, ',', '.')) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="data_contratacao" class="form-label">Data da Contratação</label>
            <input type="date" id="data_contratacao" name="data_contratacao" class="form-control" required value="<?= date('Y-m-d') ?>">
        </div>

        <div class="mb-3">
            <label for="status_reserva" class="form-label">Status da Reserva</label>
            <select id="status_reserva" name="status_reserva" class="form-select" required>
                <option value="Pendente">Pendente</option>
                <option value="Confirmada">Confirmada</option>
                <option value="Cancelada">Cancelada</option>
                <option value="Concluída">Concluída</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Venda</button>
        <a href="vendas.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php
    require_once("rodape.php");
?>