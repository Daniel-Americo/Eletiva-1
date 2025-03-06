<?php 
    declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>exemplo uso de função 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php 
    //strlen é uma função propria do php q conta os carecteres
    function manipularString(string $palavra) : void {
        echo "A palavra possui. " . strlen($palavra). " caracteres</p>";
        echo "Letra A substituida por 4: ". str_replace("a", "4", $palavra)."</p>";
        //primeiro o alvo da substituição e depois oq vai entrar no local
    }

    function gerarValorAleatorio(int $inicial, int $final) : int {
         return rand($inicial, $final); //rand = numeros randomicos entro o inicial e final.
    }

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        try {
            $palavre = $_POST['palavra'];
            manipularString(strtolower($palavre));

            $valor = gerarValorAleatorio(1, 20);
            echo "<p>O valor gerado foi: $valor </p>";

            $numero = 3.55555555;
            echo "<p> Mostrando 2 casas decimais: " .number_format($numero, 2, ",","."."</p> ");
            //variavel, quantidade de casas decimais desejadas, Casa decimal, casa de milhar.

        }catch(Exception $e){
            echo $e->getMessage();}

    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  </body>
</html>