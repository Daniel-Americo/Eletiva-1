<?php
    require_once("cabecalho.php");

    // Função para buscar todos os clientes para o dropdown
    function retornaClientes() {
        require("conexao.php");
        try {
            $sql = "SELECT idclientes, nome FROM clientes ORDER BY nome ASC";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Erro ao consultar clientes: " . $e->getMessage());
        }
    }

    // Função para buscar todos os pacotes para o dropdown
    function retornaPacotes() {
        require("conexao.php");
        try {
            // Inclui informações do destino para facilitar a identificação do pacote
            $sql = "SELECT
                        p.idpacotes,
                        p.valor,
                        d.cidade,
                        d.pais
                    FROM
                        pacotes p
                    JOIN
                        destinos d ON p.destino_id_destino = d.id_destinos
                    ORDER BY
                        d.cidade ASC, p.valor ASC";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Erro ao consultar pacotes: " . $e->getMessage());
        }
    }

    // Função para inserir uma nova venda no banco de dados
    function inserirVenda($data_contratacao, $status_reserva, $pacotes_idpacotes, $clientes_idclientes) {
        require("conexao.php");
        try {
            $sql = "INSERT INTO Vendas (data_contratacao, status_reserva, pacotes_idpacotes, clientes_idclientes) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);

            if ($stmt->execute([$data_contratacao, $status_reserva, $pacotes_idpacotes, $clientes_idclientes])) {
                header('location: vendas.php?cadastro=true'); // Redireciona para a lista de vendas
                exit(); // É crucial usar exit() após header()
            } else {
                header('location: vendas.php?cadastro=false');
                exit();
            }
        } catch (Exception $e) {
            die("Erro ao inserir venda: " . $e->getMessage());
        }
    }

    // Carrega clientes e pacotes antes de exibir o formulário
    $clientes = retornaClientes();
    $pacotes = retornaPacotes();

    // Verifica se o formulário foi enviado com o método POST
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $data_contratacao = $_POST['data_contratacao'];
        $status_reserva = $_POST['status_reserva'];
        $pacotes_idpacotes = $_POST['id_pacote']; // Nome do campo do formulário
        $clientes_idclientes = $_POST['id_cliente']; // Nome do campo do formulário

        inserirVenda($data_contratacao, $status_reserva, $pacotes_idpacotes, $clientes_idclientes);
    }
?>

<h2>Registrar Nova Venda</h2>

<form method="post">
    <div class="mb-3">
        <label for="id_cliente" class="form-label">Cliente</label>
        <select id="id_cliente" name="id_cliente" class="form-select" required>
            <option value="">Selecione um cliente</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?= $cliente['idclientes'] ?>"><?= $cliente['nome'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="id_pacote" class="form-label">Pacote</label>
        <select id="id_pacote" name="id_pacote" class="form-select" required>
            <option value="">Selecione um pacote</option>
            <?php foreach ($pacotes as $pacote): ?>
                <option value="<?= $pacote['idpacotes'] ?>">
                    Pacote #<?= $pacote['idpacotes'] ?> - <?= $pacote['cidade'] ?>/<?= $pacote['pais'] ?> (R$ <?= number_format($pacote['valor'], 2, ',', '.') ?>)
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
    <button type="button" class="btn btn-secondary" onclick="history.back();">Voltar</button>
</form>

<?php
    require_once("rodape.php");
?>