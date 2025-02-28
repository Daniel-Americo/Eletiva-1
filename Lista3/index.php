<?php 
//IF E ELSEIF E ELSE.
    $idade = 20;
    if ($idade >= 18)
        echo "Você é maior de idade.";
    else 
        echo "Você é menor de idade.";

    $nota = 6;

    if ($nota > 6)
        echo "Acima da Média";
    elseif ($nota == 6)
        echo "Na Média.";
    else
        echo "Abaixo da Média.";

    //operador ternario só funciona se a resposta for sim ou não
    echo $idade >= 18 ? "Maior de idade!" : "Menor de idade;"; //fica no lugar do if funciona da mesma maneira.



    $mes = 1;
    switch ($mes){
        case 1:
            echo "Janeiro";
            break;
        
        case 2:
            echo "Fevereiro";
            break;
        
        default:
            echo "Nenhuma das opções";
    }



//Estruturas de Repetição

$i = 1;
while($i <= 10){
    echo "$i<br/>";
    $i++;
}

//do while

do {
    echo "$i <br/>";
    $i++;

} while ($i <= 10);

//for // se colocar o (-- ou ++) antes do incremento ($i), ele realiza a logica e após o final da logica ele incrementa.
for($i = 0; $i <= 10; $i++){
    echo "$i<br/>";
}
?>