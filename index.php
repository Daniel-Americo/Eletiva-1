<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Boa Noite! hoje é 
        <?php
            echo date("d/m/Y");
        ?>
    </h1>
    <p>
        <?php
        $nome = "Daniel"; 
        echo "O nome é: $nome"; //se utilizar "" vai exibir o conteudo da variavel, '' com aspas simples mostra $nome a variavel e nao o valor.//
        ?>
    </p>
    <p>
        <?php
            echo 'O nome é: '.$nome; //para exibir com aspas simples é apenas por .$nome q concatena.
        ?>
    <p>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>