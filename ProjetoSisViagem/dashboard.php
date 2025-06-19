<?php
require_once('cabecalho.php');
require_once("conexao.php");

function retornaPacotesPorDestino($pdo) {
    try {
        $sql = "SELECT d.cidade, COUNT(p.idpacotes) AS total_pacotes 
                FROM destinos d
                LEFT JOIN pacotes p ON d.id_destinos = p.destino_id_destino
                GROUP BY d.cidade
                ORDER BY total_pacotes DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao consultar destinos: " . $e->getMessage());
    }
}

function retornaContagemVendasPorStatus($pdo) {
    try {
        $sql = "SELECT status_reserva, COUNT(id_vendas) AS total_vendas
                FROM vendas
                GROUP BY status_reserva
                ORDER BY total_vendas DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die("Erro ao consultar os dados de vendas: " . $e->getMessage());
    }
}

$dados_destinos = retornaPacotesPorDestino($pdo);
$dados_vendas = retornaContagemVendasPorStatus($pdo);
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Dashboard Geral</h1>
        <a href="relatorios.php" target="_blank" class="btn btn-success btn-sm">Ver Relatórios</a>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div id="barchart_div" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div id="piechart_div" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(desenharGraficos);

    function desenharGraficos() {
        desenharGraficoDeBarras();
        desenharGraficoDePizza();
    }

    function desenharGraficoDeBarras() {
        var data = google.visualization.arrayToDataTable([
            ['Cidade', 'Total de Pacotes', { role: 'style' }],
            <?php
                $colors = ['#4285F4', '#DB4437', '#F4B400', '#0F9D58', '#AB47BC'];
                $colorIndex = 0;
                foreach($dados_destinos as $d){
                    $cidade = $d['cidade'];
                    $total_pacotes = $d['total_pacotes'];
                    $color = $colors[$colorIndex % count($colors)];
                    echo "['$cidade', $total_pacotes, '$color'],";
                    $colorIndex++;
                }
            ?>
        ]);

        var options = {
            title: 'Pacotes de Viagem por Destino',
            chartArea: {width: '60%', height: '80%'},
            hAxis: { title: 'Total de Pacotes', minValue: 0, format: '0' },
            vAxis: { title: 'Cidade' },
            legend: { position: 'none' }
        };

        var chart = new google.visualization.BarChart(document.getElementById('barchart_div'));
        chart.draw(data, options);
    }

    function desenharGraficoDePizza() {
        var data = google.visualization.arrayToDataTable([
            ['Status da Reserva', 'Quantidade de Vendas'],
            <?php
                foreach($dados_vendas as $venda) {
                    echo "['" . htmlspecialchars($venda['status_reserva']) . "', " . $venda['total_vendas'] . "],";
                }
            ?>
        ]);

        var options = {
            title: 'Distribuição de Vendas por Status',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_div'));
        chart.draw(data, options);
    }
</script>

<?php require_once('rodape.php'); ?>