<?php 
    declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista 5 </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php 

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $estoque = array();
        try {
            for($i = 0; $i < count($_POST['titulo']); $i ++){
                $titulo = $_POST['titulo'][$i];
                $quant = (float)$_POST['quant'][$i];
                if($quant < 5){
                    echo "Alerta o livro:<strong> $titulo</strong>, Atingiu a Quantidade minima: $quant no estoque atingida<br>";
                    continue;
                }
                $estoque[$titulo]= $quant;
            }
            asort($estoque);

            foreach($estoque as $titulo => $quant){
                echo "<strong>Titulo do livro:</strong> $titulo, <strong>Quantidade em estoque:</strong> $quant <br>";
            }
    
        }catch(Exception $e){
            echo $e->getMessage();}

    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  </body>
</html>