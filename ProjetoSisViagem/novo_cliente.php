<?php
    require_once("cabecalho.php");

    // Função para inserir um novo cliente no banco de dados
    function inserirCliente($nome, $email, $tel, $cpf, $rg, $datanascimento) {
        require("conexao.php"); // Inclui a conexão com o banco de dados
        try {
            // Comando SQL para inserir um cliente
            $sql = "INSERT INTO clientes (nome, email, tel, cpf, rg, datanascimento) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);

            // Executa a consulta e verifica o resultado
            if ($stmt->execute([$nome, $email, $tel, $cpf, $rg, $datanascimento])) {
                header('location: clientes.php?cadastro=true'); // Redireciona em caso de sucesso
            } else {
                header('location: clientes.php?cadastro=false'); // Redireciona em caso de erro
            }
        } catch (Exception $e) {
            // Exibe mensagem de erro em caso de falha
            die("Erro ao inserir cliente: " . $e->getMessage());
        }
    }

    //Verifica se o formulário foi enviado com o método POST
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $datanascimento = $_POST['datanascimento'];

        //Chama a função para inserir o cliente no banco de dados
        inserirCliente($nome, $email, $tel, $cpf, $rg, $datanascimento);
    }
?>

<h2>Novo Cliente</h2>

<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" id="nome" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="tel" class="form-label">Telefone</label>
        <input type="text" id="tel" name="tel" class="form-control">
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
        <input type="date" id="datanascimento" name="datanascimento" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
    <button type="button" class="btn btn-secondary" onclick="history.back();">Voltar</button>
</form>

<?php
    require_once("rodape.php");
?>