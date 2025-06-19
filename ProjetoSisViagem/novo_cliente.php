<?php
require_once("conexao.php");

function inserirCliente($pdo, $nome, $email, $tel, $cpf, $rg, $datanascimento) {
    try {
        $sql = "INSERT INTO clientes (nome, email, tel, cpf, rg, datanascimento) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$nome, $email, $tel, $cpf, $rg, $datanascimento])) {
            header('location: clientes.php?cadastro=sucesso'); 
            exit();
        }
    } catch (Exception $e) {
        if ($e->getCode() == 23000) {
            return "Erro: O Email ou CPF informado já está cadastrado.";
        }
        return "Erro ao inserir cliente: " . $e->getMessage();
    }
    return "Erro desconhecido ao inserir o cliente.";
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $datanascimento = $_POST['datanascimento'];

    $resultado = inserirCliente($pdo, $nome, $email, $tel, $cpf, $rg, $datanascimento);
    
    if (is_string($resultado)) {
        $mensagem_erro = $resultado;
    }
}

require_once("cabecalho.php");
?>

<div class="container mt-4">
    <h2>Novo Cliente</h2>

    <?php if (isset($mensagem_erro)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($mensagem_erro) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" required value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" id="email" name="email" class="form-control" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="tel" class="form-label">Telefone</label>
            <input type="text" id="tel" name="tel" class="form-control" value="<?= htmlspecialchars($_POST['tel'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" id="cpf" name="cpf" class="form-control" required value="<?= htmlspecialchars($_POST['cpf'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="rg" class="form-label">RG</label>
            <input type="text" id="rg" name="rg" class="form-control" required value="<?= htmlspecialchars($_POST['rg'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="datanascimento" class="form-label">Data de Nascimento</label>
            <input type="date" id="datanascimento" name="datanascimento" class="form-control" value="<?= htmlspecialchars($_POST['datanascimento'] ?? '') ?>">
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="clientes.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php
    require_once("rodape.php");
?>