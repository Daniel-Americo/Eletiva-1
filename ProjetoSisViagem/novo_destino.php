<?php
    require_once("cabecalho.php");

    
    function inserirDestino($estado, $cidade, $pais) {
        require("conexao.php");
        try {
            $sql = "INSERT INTO destinos (estado, cidade, pais) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$estado, $cidade, $pais])) {
                header('location: destinos.php?cadastro=true'); 
            } else {
                header('location: destinos.php?cadastro=false'); 
            }
        } catch (Exception $e) {
            die("Erro ao inserir destino: " . $e->getMessage());
        }
    }

 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $pais = $_POST['pais'];
        inserirDestino($estado, $cidade, $pais);
    }
?>

<h2>Novo Destino</h2>

<form method="post">
    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <input type="text" id="estado" name="estado" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="cidade" class="form-label">Cidade</label>
        <input type="text" id="cidade" name="cidade" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="pais" class="form-label">País</label>
        <input type="text" id="pais" name="pais" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Cancelar</button>
</form>

<?php
    require_once("rodape.php");
?>