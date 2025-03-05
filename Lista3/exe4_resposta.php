<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>exe 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php 
  if($_SERVER['REQUEST_METHOD']== 'POST'){
    try{

        $valor = $_POST['valor'];

        if($valor > 100){
            $valorDesconto = $valor * 0.15;
            $novoValor = $valor - $valorDesconto;
            echo "Novo valor com desconto de 15% Aplicado: $novoValor";
        }
        else
            echo"Valores Abaixo de 100$ não recebem o desconto.";
      
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>