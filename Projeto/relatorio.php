<?php
  session_start();
  if(!$_SESSION['acesso']){
    header("location: index.php?mensagem=acesso_negado");
  }
  function retornarProdutos(){
    require("conexao.php");
    try {
        $sql = "SELECT P.*, c.nome as nome_categoria
        from produtos p
        inner join categoria c on c.id = p.categoria_id";
        $stmt = $pdo -> query($sql);
        return $stmt->fetchAll();
    } catch(Exception $e) {
        die("Erro ao consultar produtos: ". $e->GetMessage());
    }
  }
  $produtos = retornarProdutos();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Produtos</title>
    <style>
        /* Estilo normal (tela) */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 20px;
        }
        .no-print {
            display: block;
        }
        .print-button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
        }

        /* Estilo para impressão */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                font-size: 12px;
                padding: 0;
            }
            .tabela th {
                background-color: #f0f0f0 !important;
                -webkit-print-color-adjust: exact;
            }
        }

        /* Seu CSS original */
        .titulo { text-align: center; font-size: 18px; font-weight: bold; }
        .tabela { width: 100%; border-collapse: collapse; 15px; }
        .tabela th, .tabela td { border: 1px solid #000; padding: 6px 10px; text-align: left; }
        .tabela th { background-color: #f0f0f0; }
    </style>
</head>
<body>

    <!-- Botão para impressão (não aparece no PDF) window.print() faz não aparecer   -->
    <button class="print-button no-print" onclick="window.print()">Imprimir / Salvar como PDF</button>

    <div class="titulo">Relatório de Produtos</div>
    <div class="row">
        <div class="col">Data: <?php echo date('d/m/Y'); ?></div>
    </div>

    <table class="tabela">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($produtos as $p):
            ?>
            <tr>
                <td><?= $p['id']?></td>
                <td><?= $p['nome']?></td>
                <td><?= $p['preco']?></td>
                <td><?= $p['nome_categoria']?></td>
            </tr>
            <?php
                endforeach;
            ?>
            <!-- Adicione mais linhas dinamicamente com PHP -->
        </tbody>
    </table>

    <script>
        // Opcional: Configuração para melhor experiência de impressão
        function beforePrint() {
            console.log("Preparando para impressão...");
        }
        function afterPrint() {
            console.log("Impressão concluída");
        }
        window.addEventListener('beforeprint', beforePrint);
        window.addEventListener('afterprint', afterPrint);
    </script>
</body>
</html>