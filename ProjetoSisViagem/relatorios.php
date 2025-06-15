<?php
session_start();
if (!isset($_SESSION['acesso']) || !$_SESSION['acesso']) {
    header("location: index.php?mensagem=acesso_negado");
    exit();
}

require_once("conexao.php");

function retornaDestinos($pdo) {
    try {
        $sql = "SELECT * FROM destinos ORDER BY cidade";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao consultar destinos: " . $e->getMessage());
    }
}

$destinos = retornaDestinos($pdo);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Destinos</title>
    <style>
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
        .titulo {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        .tabela {
            width: 100%;
            border-collapse: collapse;
        }
        .tabela th, .tabela td {
            border: 1px solid #000;
            padding: 6px 10px;
            text-align: left;
        }
        .tabela th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

    <button class="print-button no-print" onclick="window.print()">Imprimir / Salvar como PDF</button>

    <div class="titulo">Relatório de Destinos</div>
    <div class="row">
        <div class="col">Data: <?= date('d/m/Y') ?></div>
    </div>

    <table class="tabela">
        <thead>
            <tr>
                <th>ID Destino</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>País</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($destinos as $d): ?>
            <tr>
                <td><?= $d['id_destinos'] ?></td>
                <td><?= $d['cidade'] ?></td>
                <td><?= $d['estado'] ?></td>
                <td><?= $d['pais'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
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

<?php require_once("rodape.php"); ?>