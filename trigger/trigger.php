<?php
    $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
    if ($conn) {
        $sql = "SELECT * FROM popisi WHERE status=1";
        $result = mysqli_query($conn, $sql);
        $popis = mysqli_fetch_all($result);
        if($popis){
            echo "<br>";
            for($i = 0; $i < count($popis); $i++){
                if($popis[$i][2] <= date('Y-m-d')){
                    $sql = "UPDATE popisi SET status=0 WHERE ime_popisa='{$popis[$i][0]}'";
                    mysqli_query($conn, $sql);
                }
            }
        }else{
            //pass
        }
    }else {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($conn);
?>
