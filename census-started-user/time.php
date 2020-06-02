<?php
$conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
if ($conn) {
    $sql = "SELECT * FROM popisi WHERE status=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    if($row){
        echo $row[2];
    }
}else {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_close($conn);
?>