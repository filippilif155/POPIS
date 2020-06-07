<?php
    require '../config/config.php';
    if(isset($_POST['jmbg'])){
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn) {
            $sql = "SELECT * FROM popisi WHERE status=1";
            if(mysqli_query($conn, $sql)){
                $popis = mysqli_fetch_row(mysqli_query($conn, $sql));
                $jmbg = $_POST['jmbg'];
                $name = $popis[0]."_obavjestenja";
                $sql = "DELETE FROM {$name} WHERE jmbg='{$jmbg}'";
                if(mysqli_query($conn, $sql)){
                    echo "1";
                }                
            }else{
                echo "0";
            }
        }else{
            echo "0";
        }
    mysqli_close($conn);
    }  
?>