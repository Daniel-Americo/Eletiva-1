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
        $itens = array();
        try {
            for($i =0; $i < count($_POST['nome']); $i ++){
                $nome = $_POST['nome'][$i]; //obtemm o nome atual no indice
                $preco = (float) $_POST['preco'][$i]; //obtem o telefone atual no indice
                $preco *= 1.15;
                $itens[$nome] = $preco;
                }

            uasort ($itens, function($a, $b){   //ordena os itens pelo valor
                return $a <=> $b;  //seguindo está condição de comparar de 2 em 2 os menores valores primeiro.
            });

            foreach($itens as $nome => $preco)
            {
                echo "Nome: $nome <br>";
                echo "Preço: R$ $preco<br>"; 
            }
    
        }catch(Exception $e){
            echo $e->getMessage();}

    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  </body>
</html>