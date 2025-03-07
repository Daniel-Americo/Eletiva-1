<?php 
    declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>exemplo uso de função </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php 

    //aspas duplas na hr de declarar uma variavel $_post[""] pode receber uma variavel e pegar o valor do formulario.
    function compararString(string $palavra1, string $palavra2) : void {
        echo strpos($palavra1, $palavra2) ? "A segunda palavra: $palavra2 está contida em: $palavra1" : "Não está contida.";
    }



    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        try {
            $palavra1 = $_POST['palavra1'];
            $palavra2 = $_POST['palavra2'];
            compararString($palavra1, $palavra2);


        }catch(Exception $e){
            echo $e->getMessage();}

    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  </body>
</html>