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
        $medias = array();
        try {
            for($i =0; $i < count($_POST['nome']); $i ++){
                $nome = $_POST['nome'][$i];
                $nota1 = $_POST['nota1'][$i];
                $nota2 = $_POST['nota2'][$i];
                $nota3 = $_POST['nota3'][$i];
                $media = ($nota1 + $nota2 + $nota3) / 3;
                $medias[$nome] = $media;
            }
            arsort($medias);

            foreach ($medias as $nome => $media){
                echo "</br>Nome do aluno: $nome e sua media é:  $media ";

            }


        }catch(Exception $e){
            echo $e->getMessage();}

    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  </body>
</html>