<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>exe 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php 
  if($_SERVER['REQUEST_METHOD']== 'POST'){
    try{
    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];
    
    if($valor1 > $valor2){
      echo "$valor2 $valor1";
    }
    if($valor2 > $valor1){
      echo "$valor1 $valor2";
    }
    elseif($valor1 == $valor2){
      echo "Os valores iguais $valor1";
    }


      
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>