<?php 
$conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
if ($conn) {
    $sql = "SELECT * FROM popisi WHERE status=1";
    $result = mysqli_query($conn, $sql);
    $popis = mysqli_fetch_row($result)[0];
    if($popis){
        $_SESSION['popis'] = $popis;
        header("Location: ../census-started-user/index.php");
    }else{
        header("Location: ../census-didnt-start-usr/index.html");
    }
    
}else {
    die("Connection failed: " . mysqli_connect_error());
}
?>