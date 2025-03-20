<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sessoes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php
      session_start(); //estabelece a conexão para armazenar dados// obrigatorio
      $_SESSION['usuario']= "João ";
      //variavel $_SESSION É UM ARRAY DO SERVIDOR, gerenciados pelo servidor
      //toda vez q quiser armazenar o valor "permanente" usa session_start()
      //cria a posicao ['usuario'] ou qualquer outra e atribui o que quiser.

    ?>
    <h1>Bem Vindo <?= $_SESSION['usuario'] ?></h1>


 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  </body>
</html>