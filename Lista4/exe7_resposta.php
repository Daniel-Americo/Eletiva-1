<?php 
    declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>lista 4 </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
        <?php 
        function calcularDiferencaDatas(string $data1, string $data2): void {
            $data1_formatada = DateTime::createFromFormat('d/m/Y', $data1);
            $data2_formatada = DateTime::createFromFormat('d/m/Y', $data2);

            if (!$data1_formatada || !$data2_formatada) {
                echo "Formato de data inválido! Use o formato dd/mm/YYYY.";
                return;
            }

            $diferenca = $data1_formatada->diff($data2_formatada);

            echo "A diferença entre as datas é de {$diferenca->days} dias.";
        }

      
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            try {
                $data1 = $_POST['data1'];
                $data2 = $_POST['data2'];
                calcularDiferencaDatas($data1, $data2);
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  </body>
</html>