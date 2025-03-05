<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>exe </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php 
  if($_SERVER['REQUEST_METHOD']== 'POST'){
    try{
      
      $numero1 = $_POST["numero1"];
      $numero2 = $_POST["numero2"];
      $numero3 = $_POST["numero3"];
      $numero4 = $_POST["numero4"];
      $numero5 = $_POST["numero5"];
      $numero6 = $_POST["numero6"];
      $numero7 = $_POST["numero7"];

      $menor = $numero1;
      $posicao = 1;

      if ($numero2 < $menor) { $menor = $numero2; $posicao = 2; }
      if ($numero3 < $menor) { $menor = $numero3; $posicao = 3; }
      if ($numero4 < $menor) { $menor = $numero4; $posicao = 4; }
      if ($numero5 < $menor) { $menor = $numero5; $posicao = 5; }
      if ($numero6 < $menor) { $menor = $numero6; $posicao = 6; }
      if ($numero7 < $menor) { $menor = $numero7; $posicao = 7; }

        echo "O menor valor inserido é: $menor ";
        echo "E sua posição de inserção é: $posicao ";
      
    }catch(Exception $e){
        echo $e->getMessage();
    }
    }
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>