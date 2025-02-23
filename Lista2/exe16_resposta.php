<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>exe 16</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  
  <?php 
    if($_SERVER['REQUEST_METHOD']== 'POST'){
      try{
        $preco = $_POST['preco'];
        $desconto = $_POST['desconto'];
        $valordesconto = ($preco * $desconto) / 100;
        $precodesconto = $preco - $valordesconto;
        echo "O preço com desconto é: $precodesconto";
        
      }catch(Exception $e){
          echo $e->getMessage();
      }
  }
      ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
