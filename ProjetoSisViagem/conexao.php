<?php

declare(strict_types =1);

$dominio = 'mysql:host=localhost;dbname=bancophp'; //dbname é o nome do arquivo de banco de dados.
$usuario = 'root'; //nome do usuario padrao do bd é root.
$senha = ''; //senha do banco de dados se tiver.

try{
    $pdo = new PDO($dominio, $usuario, $senha);

}catch(PDOException $e){
    die("Erro ao conectar ao banco! " .$e->getMessage());
}


?>