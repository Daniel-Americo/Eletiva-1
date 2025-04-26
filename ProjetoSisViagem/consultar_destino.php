<?php
    require_once("cabecalho.php");
    require("conexao.php"); // Inclui a conexão com o banco de dados

    // Função para buscar os destinos
    function retornaDestinos($pdo) {
        try {
            $sql = "SELECT * FROM destinos"; // Consulta a tabela destino
            $stmt = $pdo->query($sql); // Executa a consulta
            return $stmt->fetchAll(); // Retorna os dados como array
        } catch (Exception $e) {
            die("Erro ao consultar os destinos: " . $e->getMessage());
        }
    }

    // Função para excluir um destino
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_destino'])) {
        $id_destino = $_POST['id_destino'];

        try {
            $sql = "DELETE FROM destinos WHERE id_destinos = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$id_destino])) {
                // manda para a pagina destinos se a exclusao der certo
                header('Location: destinos.php?exclusao=true');
                exit;
            } else {
                // manda para a pagina destinos se der errado com a mensagem
                header('Location: destinos.php?exclusao=false'); // Remove o espaço extra
                exit;
            }
        } catch (Exception $e) {
            die("Erro ao excluir destino: " . $e->getMessage());
        }
    }

    // Busca os destinos no banco
    $destinos = retornaDestinos($pdo);
?>

<h2>Consultar Destinos</h2>

<?php
    // Mensagem de feedback para exclusão
    if (isset($_GET['exclusao'])) {
        if ($_GET['exclusao'] === 'true') {
            echo '<p class="text-success">Destino excluído com sucesso!</p>';
        } elseif ($_GET['exclusao'] === 'false') {
            echo '<p class="text-danger">Erro ao excluir destino!</p>';
        }
    }
?>

<?php foreach ($destinos as $destino): ?>
    <div class="mb-2">
        <p>Estado: <strong><?= $destino['estado'] ?></strong></p>
        <p>Cidade: <strong><?= $destino['cidade'] ?></strong></p>
        <p>País: <strong><?= $destino['pais'] ?></strong></p>
        <div style="display: flex; gap: 10px; align-items: center;">
            <form method="post" style="margin: 0;">
                <input type="hidden" name="id_destino" value="<?= $destino['id_destinos'] ?>">
                <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
            <button type="button" class="btn btn-secondary" onclick="history.back()">Voltar</button>
        </div>
    </div>
<?php endforeach; ?>

<?php
    require_once("rodape.php");
?>