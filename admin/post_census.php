<?php 
    session_start();
    if(isset($_POST['date'])){
        $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
        if($conn){
            $name = stripcslashes($_POST['census-name']);
            $date = stripcslashes($_POST['date']);
            $name = mysqli_real_escape_string($conn, $name);
            $date = mysqli_real_escape_string($conn, $date);
            $sql = "SELECT * FROM popisi WHERE ime_popisa='$name'";
            
            echo "$sql<br>";
            $result = mysqli_query($conn, $sql);
            $popis = mysqli_fetch_row($result);
            $sql = "SELECT * FROM popisi WHERE status=1";
            $result_status = mysqli_query($conn, $sql);
            $popis_status = mysqli_fetch_row($result_status)[0];
            if($popis){
                $_SESSION['post_response'] = 2;
            }elseif($popis_status){
                $_SESSION['post_response'] = 3;
            }
            else{    
                $sql = "INSERT INTO `popisi` (`ime_popisa`, `status`, `rok`) VALUES ('$name','1','$date')";    
                mysqli_query($conn, $sql);   
                $_SESSION['post_response'] = 1;         
            }
        }else{
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    mysqli_close($conn);
    header('Location: admin.php');

?>