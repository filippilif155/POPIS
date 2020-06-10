<?php 
    require '../config/config.php';
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn) {
        $sql = "SELECT * FROM popisi WHERE status=1";
        $result = mysqli_query($conn, $sql);
        if(mysqli_fetch_row($result)){
            $popis = mysqli_fetch_row($result)[0];
            $_SESSION['popis'] = $popis;
            header("Location: ../census-started-user/index.php");
        }else{
            header("Location: ../census-didnt-start-user/index.html");
        }
        
    }else {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($conn);
?>