<?php
require '../config/config.php';
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn) {
    $sql = "SELECT * FROM popisi WHERE status=1";
    if(mysqli_query($conn, $sql)){
        $row = mysqli_fetch_row(mysqli_query($conn, $sql));
        echo $row[2];
    }
}else {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_close($conn);
?>