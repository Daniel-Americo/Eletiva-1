<?php
    require_once("cabecalho.php");
    require_once("conexao.php");

    // Verifica se o ID do cliente foi passado via GET
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        // Busca os dados do cliente no banco
        try {
            $sql = "SELECT * FROM clientes WHERE idclientes = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $cliente = $stmt->fetch(); // Retorna os dados do cliente
        } catch (Exception $e) {
            die("Erro ao buscar cliente: " . $e->getMessage());
        }
    } else {
        die("ID do cliente não fornecido!");
    }

    // Atualiza os dados do cliente
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $datanascimento = $_POST['datanascimento'];

        try {
            $sql = "UPDATE clientes SET nome = ?, email = ?, tel = ?, cpf = ?, rg = ?, datanascimento = ? WHERE idclientes = ?";
            $stmt = $pdo->prepare($sql);

            if ($stmt->execute([$nome, $email, $tel, $cpf, $rg, $datanascimento, $id])) {
                header('Location: clientes.php?edicao=true'); // Redireciona para a página de clientes em caso de sucesso
                exit();
            } else {
                header('Location: clientes.php?edicao=false'); // Redireciona para a página de clientes em caso de erro
                exit();
            }
        } catch (Exception $e) {
            die("Erro ao atualizar cliente: " . $e->getMessage());
        }
    }
?>

<h2>Editar Cliente</h2>

<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome do Cliente</label>
        <input type="text" id="nome" name="nome" class="form-control" required value="<?= $cliente['nome'] ?>">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" id="email" name="email" class="form-control" required value="<?= $cliente['email'] ?>">
    </div>

    <div class="mb-3">
        <label for="tel" class="form-label">Telefone</label>
        <input type="text" id="tel" name="tel" class="form-control" required value="<?= $cliente['tel'] ?>">
    </div>

    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" id="cpf" name="cpf" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="rg" class="form-label">RG</label>
        <input type="text" id="rg" name="rg" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="datanascimento" class="form-label">Data de Nascimento</label>
        <input type="date" id="datanascimento" name="datanascimento" class="form-control" value="<?= $cliente['datanascimento'] ?>">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Voltar</button>
</form>

<?php
    require_once("rodape.php");
?>