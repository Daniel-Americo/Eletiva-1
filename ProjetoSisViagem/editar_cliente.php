<?php
require_once("cabecalho.php");
require_once("conexao.php");

$mensagem = "";

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
} else {
    die("ID do cliente não fornecido!");
}

try {
    $sql = "SELECT * FROM clientes WHERE idclientes = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $cliente = $stmt->fetch();
} catch (Exception $e) {
    die("Erro ao buscar cliente: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'])) {
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
            header("Location: clientes.php?edicao=sucesso");
            exit();
        } else {
            $mensagem = '<div class="alert alert-danger">Erro ao atualizar cliente.</div>';
        }
    } catch (Exception $e) {
        $mensagem = '<div class="alert alert-danger">Erro ao atualizar cliente: ' . $e->getMessage() . '</div>';
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM clientes WHERE idclientes = ?");
        $stmt->execute([$id]);
        $cliente = $stmt->fetch();
    } catch (Exception $e) {
        die("Erro ao recarregar cliente: " . $e->getMessage());
    }
}
?>

<h2>Editar Cliente</h2>

<?= $mensagem ?>

<form method="post">
    <input type="hidden" name="id" value="<?= $cliente['idclientes'] ?>">

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
        <input type="text" id="cpf" name="cpf" class="form-control" required value="<?= $cliente['CPF'] ?>">
    </div>

    <div class="mb-3">
        <label for="rg" class="form-label">RG</label>
        <input type="text" id="rg" name="rg" class="form-control" required value="<?= $cliente['Rg'] ?>">
    </div>

    <div class="mb-3">
        <label for="datanascimento" class="form-label">Data de Nascimento</label>
        <input type="date" id="datanascimento" name="datanascimento" class="form-control" required value="<?= $cliente['datanascimento'] ?>">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Voltar</button>
</form>

<?php require_once("rodape.php"); ?>