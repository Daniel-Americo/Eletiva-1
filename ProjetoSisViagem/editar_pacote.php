<?php
    require_once("cabecalho.php"); // Incluindo o cabeçalho
    require("conexao.php"); // Incluindo a conexão com o banco

    function consultaPacote($id) {
        require("conexao.php"); // Adiciona a conexão com banco de dados
        try {
            $sql = "SELECT * FROM pacotes WHERE idpacotes = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $pacote = $stmt->fetch(PDO::FETCH_ASSOC); // Transforma os dados em um array
            if (!$pacote) {
                die("Erro ao Consultar o Registro!");
            } else {
                return $pacote;
            }
        } catch (Exception $e) {
            die("Erro ao Consultar Pacote: " . $e->getMessage());
        }
    }

    function alterarPacote($data_inicio, $fim_pacote, $valor, $destino_id_destino, $clientes_clientes, $id) {
        require("conexao.php");
        try {
            $sql = "UPDATE pacotes SET data_inicio = ?, fim_pacote = ?, valor = ?, destino_id_destino = ?, clientes_clientes = ? WHERE idpacotes = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$data_inicio, $fim_pacote, $valor, $destino_id_destino, $clientes_clientes, $id])) {
                header('location: pacotes.php?edicao=true');
            } else {
                header('location: pacotes.php?edicao=false');
            }
        } catch (Exception $e) {
            die("Erro ao alterar pacote: " . $e->getMessage());
        }
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $data_inicio = $_POST['data_inicio'];
        $fim_pacote = $_POST['fim_pacote'];
        $valor = $_POST['valor'];
        $destino_id_destino = $_POST['destino_id_destino'];
        $clientes_clientes = $_POST['clientes_clientes'];
        $id = $_POST['id'];

        alterarPacote($data_inicio, $fim_pacote, $valor, $destino_id_destino, $clientes_clientes, $id); // Chamada do método passando os valores
    } else {
        $pacote = consultaPacote($_GET['id']); // Consulta o pacote com base no ID recebido via GET
    }
?>

<h2>Alterar Pacote</h2>

<form method="post">

    <!-- Campo Oculto para o ID do Pacote -->
    <input type="hidden" name="id" value="<?= $pacote['idpacotes'] ?>">

    <div class="mb-3">
        <label for="data_inicio" class="form-label">Data de Início</label>
        <input type="date" id="data_inicio" name="data_inicio" class="form-control" value="<?= $pacote['data_inicio'] ?>" required>
    </div>

    <div class="mb-3">
        <label for="fim_pacote" class="form-label">Data de Fim</label>
        <input type="date" id="fim_pacote" name="fim_pacote" class="form-control" value="<?= $pacote['fim_pacote'] ?>" required>
    </div>

    <div class="mb-3">
        <label for="valor" class="form-label">Valor</label>
        <input type="number" step="0.01" id="valor" name="valor" class="form-control" value="<?= $pacote['valor'] ?>" required>
    </div>

    <div class="mb-3">
        <label for="destino_id_destino" class="form-label">ID do Destino</label>
        <input type="number" id="destino_id_destino" name="destino_id_destino" class="form-control" value="<?= $pacote['destino_id_destino'] ?>" required>
    </div>

    <div class="mb-3">
        <label for="clientes_clientes" class="form-label">ID do Cliente</label>
        <input type="number" id="clientes_clientes" name="clientes_clientes" class="form-control" value="<?= $pacote['clientes_clientes'] ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Voltar</button>

</form>

<?php
    require_once("rodape.php"); // Incluindo o rodapé
?>