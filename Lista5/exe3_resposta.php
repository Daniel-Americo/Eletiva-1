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
        $produtos = array();
        try {
            for($i = 0; $i < count($_POST['codigo']); $i ++){
                $codigo = $_POST['codigo'][$i];
                $nome = $_POST['nome'][$i];
                $preco = $_POST['preco'][$i];

                if ($preco > 100) {
                    $preco *= 0.9;
                }

                $produtos[$codigo] = ['codigo'=> $codigo, 'nome' => $nome, 'preco'=> $preco];
            }
            uasort($produtos, function($a, $b) { //ordena o vetor produtos em ordem alfabetica pelo nome, utilizando a função de comparação
                return strcmp($a['nome'], $b['nome']);
            });
            

            foreach ($produtos as $produto => $info){
                echo "Código: {$info['codigo']}<br>";
                echo "Nome: {$info['nome']}<br>";
                echo "Preço: R$ {$info['preco']}<br>";
                echo "------------------<br>";
            }

        }catch(Exception $e){
            echo $e->getMessage();}

    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  </body>
</html>