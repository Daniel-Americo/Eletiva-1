<?php
    require_once("cabecalho.php"); // Incluindo o cabeçalho
    require("conexao.php"); // Incluindo a conexão com o banco

    // Verifica se o ID do destino foi passado via GET
    if (!isset($_GET['id'])) {
        die("Erro: ID do destino não foi fornecido.");
    }

    $id = $_GET['id']; // ID do destino recebido via GET

    // Função para buscar os dados do destino
    function retornaDestino($id) {
        require("conexao.php");
        try {
            $sql = "SELECT * FROM destinos WHERE id_destinos = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $destino = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$destino) {
                die("Erro: Destino não encontrado.");
            }

            return $destino;
        } catch (Exception $e) {
            die("Erro ao consultar o destino: " . $e->getMessage());
        }
    }

    // Função para salvar as alterações no banco
    function alterarDestino($id, $estado, $cidade, $pais) {
        require("conexao.php");
        try {
            $sql = "UPDATE destinos SET estado = ?, cidade = ?, pais = ? WHERE id_destinos = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$estado, $cidade, $pais, $id])) {
                header("Location: destinos.php?edicao=true");
                exit;
            } else {
                echo "<p class='text-danger'>Erro ao alterar os dados do destino.</p>";
            }
        } catch (Exception $e) {
            die("Erro ao atualizar os dados do destino: " . $e->getMessage());
        }
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $pais = $_POST['pais'];

        alterarDestino($id, $estado, $cidade, $pais);
    }

    // Busca os dados do destino
    $destino = retornaDestino($id);
?>

<h2>Editar Destino</h2>

<form method="post">
    <div class="mb-3">
        <label for="estado" class="form-label">Nome do Estado</label>
        <input type="text" id="estado" name="estado" class="form-control" value="<?= $destino['estado'] ?>" required>
    </div>

    <div class="mb-3">
        <label for="cidade" class="form-label">Nome da Cidade</label>
        <input type="text" id="cidade" name="cidade" class="form-control" value="<?= $destino['cidade'] ?>" required>
    </div>

    <div class="mb-3">
        <label for="pais" class="form-label">Nome do País</label>
        <input type="text" id="pais" name="pais" class="form-control" value="<?= $destino['pais'] ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Voltar</button>
</form>

<?php
    require_once("rodape.php"); // Incluindo o rodapé
?>