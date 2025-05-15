<?php
    require_once("cabecalho.php");
    require("conexao.php");

    
    function retornaPacotes($pdo) {
        try {
            $sql = "SELECT * FROM pacotes"; 
            $stmt = $pdo->query($sql); 
            return $stmt->fetchAll(); 
        } catch (Exception $e) {
            die("Erro ao consultar os pacotes: " . $e->getMessage());
        }
    }

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pacote'])) {
        $id_pacote = $_POST['id_pacote'];

        try {
            $sql = "DELETE FROM pacotes WHERE idpacotes = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$id_pacote])) {
                
                header('Location: pacotes.php?exclusao=true');
                exit;
            } else {
                
                header('Location: pacotes.php?exclusao=false');
                exit;
            }
        } catch (Exception $e) {
            die("Erro ao excluir pacote: " . $e->getMessage());
        }
    }

    
    $pacotes = retornaPacotes($pdo);
?>

<h2>Consultar Pacotes</h2>

<?php

    if (isset($_GET['exclusao'])) {
        if ($_GET['exclusao'] === 'true') {
            echo '<p class="text-success">Pacote excluído com sucesso!</p>';
        } elseif ($_GET['exclusao'] === 'false') {
            echo '<p class="text-danger">Erro ao excluir pacote!</p>';
        }
    }
?>

<?php foreach ($pacotes as $pacote): ?>
    <div class="mb-2">
        <p>Data de Início: <strong><?= $pacote['data_inicio'] ?></strong></p>
        <p>Fim do Pacote: <strong><?= $pacote['fim_pacote'] ?></strong></p>
        <p>Valor: <strong>R$ <?= number_format($pacote['valor'], 2, ',', '.') ?></strong></p>
        <p>ID do Destino: <strong><?= $pacote['destino_id_destino'] ?></strong></p>

        <div style="display: flex; gap: 10px; align-items: center;">
            <form method="post" style="margin: 0;">
                <input type="hidden" name="id_pacote" value="<?= $pacote['idpacotes'] ?>">
                <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
            <button type="button" class="btn btn-secondary" onclick="history.back()">Voltar</button>
        </div>
    </div>
<?php endforeach; ?>

<?php
    require_once("rodape.php");
?>
