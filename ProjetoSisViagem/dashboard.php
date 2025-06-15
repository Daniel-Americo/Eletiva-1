<?php
require_once('cabecalho.php');
require_once("conexao.php");

function retornaDestinos($pdo) {
    try {
        $sql = "SELECT d.cidade, COUNT(p.idpacotes) AS total_pacotes 
                FROM destinos d
                LEFT JOIN pacotes p ON d.id_destinos = p.destino_id_destino
                GROUP BY d.cidade
                ORDER BY total_pacotes DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        die("Erro ao consultar destinos: " . $e->getMessage());
    }
}

$destinos = retornaDestinos($pdo);
?>

<h1> Dashboard </h1>

<button onclick="window.open('relatorios.php', '_blank')"
   style="
     display: inline-block;
     padding: 10px 20px;
     margin: 10px 0;
     background-color: #28a745; /* Cor verde base, similar à imagem */
     color: white;
     text-align: center;
     text-decoration: none;
     border: 1px solid #1e7e34; /* Borda um pouco mais escura para profundidade */
     border-radius: 5px;
     cursor: pointer;
     font-family: Arial, sans-serif;
     font-size: 16px;
   ">
   Ver Relatório de Destinos
</button>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="chart_div"></div>
<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {
        var data = google.visualization.arrayToDataTable([
            ['Cidade', 'Total de Pacotes'],
            <?php
                foreach($destinos as $d){
                    $cidade = $d['cidade'];
                    $total_pacotes = $d['total_pacotes'];
                    echo "['$cidade', $total_pacotes],";
                }
            ?>
        ]);

        var options = {
            title: 'Pacotes de Viagem por Destino',
            chartArea: {width: '50%'},
            hAxis: {
                title: 'Total de Pacotes',
                minValue: 0
            },
            vAxis: {
                title: 'Cidade'
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

<?php require_once('rodape.php'); ?>