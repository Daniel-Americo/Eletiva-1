<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lista 5 Exemplo</title>
</head>
<body>
    <form action="exemplo_array.php" method="post">
        <?php for($i =0; $i <10; $i++): //declaração do for para repetir o imput, Lembrar de por : dps do comando for
            //para armazenar em vetor, varios inputs' o name recebe[]
            //<?= $i? > para mostrar os indices ?> 

            <input type = "number" name="valor[]" 
            placeholder= "Informe o valor <?= $i ?>"  />

        <?php endfor; //da fim a repetição do for, sempre precisa ter.?>
        <button type="submit"> Enviar </button>

        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                try{
                    $valores = $_POST['valor'];
                    echo "O primeiro valor do array é: ". $valores[0];
                    echo "<br/>";
                    //print_r($valores);//printa o vetor com conteudo e indice do vetor
                    //var_dump($valores); //printa com o type dos elementos do vetor

                    $valores['texto'] = 'dados';//criando posição nova no mapa.
                    unset($valores['texto']); // apaga uma posição do array
                    echo "<br/>";
                    
                    //quer exibir a posição e o valor usa $c => $v
                    //para exibir apenas o valor $v
                    foreach ($valores as $c => $v) {
                        echo "<p>Posição: $c - Valor: $v </p>";
                    }
                    //Chave 
                    $array = [10, 11, 12, 13];
                    $array2 = array("uva", "maça", "pêra");//função pronta pra criar array passando os valores.
                    $array3 = [
                        "uva" => 3,
                        "maça" => 4,
                        "Pêra" => 5
                    ];
                    


                }catch (Exception $e){
                    echo $e->getMessage();
                }
            }
        
        
        ?>



    </form>




</body>
</html>