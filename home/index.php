<?php
    session_start();
    $hidden = "hidden";
    if(isset($_POST['submit'])){ 
        $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
        if ($conn) {
            $username = stripcslashes($_POST["user"]);
            $password = stripcslashes($_POST["pass"]);
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);
            $sql = "SELECT * FROM admini WHERE username='$username' and password='$password'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            if($row){
                $_SESSION['username'] = $username;
                header("Location: ../admin/admin.php");
            }else{
                $hidden = "";
            }
        }else {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPIS</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="montenegro.png" type="image/x-icon">
<body>
    <nav>
        <ul>
            <li>POČETNA STRANA</li>
            <li>POPIŠI SE</li>
            <li>REZULTATI POPISA</li>
        </ol>
    </nav>
    <div class="main">
        <div class="welcome-message">
            <p class="above-title">POPIS STANOVNIŠTVA</p>
            <p class="title">DOBRODOŠLI!</p>
            <p class="text">Hvala što ispunjavate svoju građansku dužnost. Da nastavite, izaberite GOST opciju.</p>
            <button onclick="redirectGost()">GOST</button>
            <button id="admin">ADMIN</button>
        </div>
        <div class="home-images">
            <img src="population.jpg" alt="population" class="population">
            <img src="montenegro.png" alt="montenegro" class="montenegro">
        </div>
    </div>
    <div class="admin-form <?php echo $hidden;?>" id="admin-form">
        <h4 class="bad-input <?php echo $hidden;?>" id="bad-input">Pogrešno korisničko ime ili lozinka!</h4>
        <form method="POST" action="">
            
            <label for="user">Korisničko ime:</label>
            <input type="text" name="user" class="admin-inp" required>
            <label for="pass">Lozinka:</label>
            <input type="password" name="pass" class="admin-inp" required>
            <br>
            <input type="submit" name="submit" value="PRIJAVI SE" class="btn admin-submit-btn">
            
        </form>
        <button class="btn admin-form-close" id="admin-form-close">X</button>
    </div>
    <div class="form-mask <?php echo $hidden;?>" id="mask"></div>
    <footer>

    </footer>

    <script src="custom.js"></script>
</body>
</html>