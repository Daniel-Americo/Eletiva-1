<?php 
    declare(strict_types=1); //todas as paginas de resposta devem ter isso aqui.
    //ele obriga tudo a ser tipado com oq é funçoes e variaveis(int/string etc...)

?>
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
//function é a declaração de função depois o nome e passagem de parametro ou não



    function verificarMes(int $mes) : void{  //os parametros da função se declara o tipo// : void ou int se declara retorno
        //
    {
        switch ($mes) {
            case 1:
                echo "Janeiro";
                break;
            
            case 2:
                echo "Fevereiro";
                break;
            
            case 3:
                echo "Março";
                break;
            
            default:
                echo "Informe um valor válido";
                break;
            //return $mes caso precise de retorno para função
        }
    }
}

    if($_SERVER['REQUEST_METHOD']== 'POST'){
      try{
        $numero = intval ($_POST['numero']); //transforma em int o valor recebido
        verificarMes($numero); //chamada da função
        
    }catch(Exception $e){
      echo $e->getMessage();
      }
    }
    ?>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>