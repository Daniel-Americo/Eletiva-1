<?php 
//função que inclui o arquivo que eu quiser.
//include ("cabecalho.php"); se der erro em alguma parte ele continua a executar o restante do codigo
//---------------------------------------------------------------------------------
//mais seguro pois se der erro, ele para a execução.
require_once("cabecalho.php"); //_once verifica se ja foi executado algo igual

  echo "<h2>usuario: ". $_SESSION['usuario']." </h2>"
?>
    <p><a href="sair.php" class="btn btn-danger">Sair</a></p>
<?php
  require_once("rodape.php");
?>