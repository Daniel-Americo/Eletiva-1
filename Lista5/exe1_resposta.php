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
        try { 
          $contato = array();

          for($i =0; $i < count($_POST['nome']); $i ++){
            $nome = strtoupper($_POST['nome'][$i]); //obtemm o nome atual no indice
            $tel = $_POST['tel'][$i]; //obtem o telefone atual no indice

            if(array_key_exists($nome, $contato)){
            echo "O nome $nome, já existe.";
              continue; //se cair neste if, ele aparece o $nome duplicado e mostra na tela
            }
            elseif (in_array($tel, $contato)){
              echo "<br>O Telefone $tel, já existe.";
              continue;
            }

          $contato[$nome] = $tel;
          }
          ksort($contato);

          
          echo "<ul>";
          foreach ($contato as $nome => $tel) {
            echo "<li>Nome do Contato: $nome, Telefone: $tel</li>"; }
          echo "</ul>";

        }catch(Exception $e){
            echo $e->getMessage();}

    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  </body>
</html>