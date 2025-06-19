<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['acesso']) || !$_SESSION['acesso']) {
    header("location: index.php?mensagem=acesso_negado");
    exit();
}

require_once("conexao.php");

function retornaDadosParaRelatorio($pdo) {
    try {
        $sql = "SELECT 
                    d.id_destinos,
                    d.cidade,
                    d.estado,
                    d.pais,
                    COUNT(p.idpacotes) AS total_pacotes,
                    AVG(p.valor) AS valor_medio
                FROM 
                    destinos d
                LEFT JOIN 
                    pacotes p ON d.id_destinos = p.destino_id_destino
                GROUP BY 
                    d.id_destinos, d.cidade, d.estado, d.pais
                ORDER BY 
                    d.cidade";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao consultar dados para o relatório: " . $e->getMessage());
    }
}

$dados_relatorio = retornaDadosParaRelatorio($pdo);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Destinos e Pacotes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 20px;
        }
        .no-print {
            margin-bottom: 20px;
        }
        .print-button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                font-size: 10px;
                padding: 0;
                margin: 20px;
            }
            .tabela th {
                background-color: #f2f2f2 !important;
                -webkit-print-color-adjust: exact; 
            }
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header .titulo {
            font-size: 22px;
            font-weight: bold;
        }
        .header .data {
            font-size: 12px;
            color: #555;
        }
        .tabela {
            width: 100%;
            border-collapse: collapse;
        }
        .tabela th, .tabela td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .tabela th {
            background-color: #f2f2f2;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

    <div class="no-print">
        <button class="print-button" onclick="window.print()">Imprimir / Salvar como PDF</button>
    </div>

    <div class="header">
        <div class="titulo">Relatório de Destinos e Pacotes</div>
        <div class="data">Gerado em: <?= date('d/m/Y H:i:s') ?></div>
    </div>

    <table class="tabela">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>País</th>
                <th class="text-center">Total de Pacotes</th>
                <th class="text-right">Valor Médio (R$)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dados_relatorio as $d): ?>
            <tr>
                <td><?= htmlspecialchars($d['id_destinos']) ?></td>
                <td><?= htmlspecialchars($d['cidade']) ?></td>
                <td><?= htmlspecialchars($d['estado']) ?></td>
                <td><?= htmlspecialchars($d['pais']) ?></td>
                <td class="text-center"><?= htmlspecialchars($d['total_pacotes']) ?></td>
                <td class="text-right">
                    <?= $d['valor_medio'] ? htmlspecialchars(number_format($d['valor_medio'], 2, ',', '.')) : 'N/A' ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($dados_relatorio)): ?>
                <tr>
                    <td colspan="6" class="text-center">Nenhum destino para exibir.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>