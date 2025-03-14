
<?php
    declare(stroct_types=1);
    function diferencaEntreDatas(DateTime $data1, DateTime $data2): void {
        $difereca = $data1 -> diff ($data2);
        echo "Diferença de dias entre as dastas: ".$diferenca->d;
    }

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        try {
            $data1 = new DateTime($_POST['data1']);
            $data2 = new DateTime($_POST['data2']);

            diferencaEntreDatas($data1, $data2);
            //<input type="date" name="data1">
        }catch(Exception $e){
            echo $e->getMessage();}

    }
?>