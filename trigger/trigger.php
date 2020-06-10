<?php
    require '../config/config.php';
    require '../config/fetch.php';
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn) {
        $sql = "SELECT * FROM popisi WHERE status=1";
        $result = mysqli_query($conn, $sql);
        if(mysqli_fetch_all_alt($result)){
            $popis = mysqli_fetch_all_alt($result);
            for($i = 0; $i < count($popis); $i++){
                if($popis[$i]['rok'] <= date('Y-m-d')){
                    $sql = "UPDATE popisi SET status=0 WHERE ime_popisa='{$popis[$i]['ime_popisa']}'";
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
