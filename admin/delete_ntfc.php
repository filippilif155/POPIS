<?php
    if(isset($_POST['jmbg'])){
        $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
        if ($conn) {
            $sql = "SELECT * FROM popisi WHERE status=1";
            $result = mysqli_query($conn, $sql);
            $popis = mysqli_fetch_row($result);
            if($popis){
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