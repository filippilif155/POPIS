<?php
    session_start();
    if($_SESSION['username']){
        $str = $_SESSION['username'];
    }else{
        header('Location: ../home/index.php');
    }
    $active = "";
    $html_heading = "Popis je u toku!";
    $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
    if ($conn) {
        $sql = "SELECT * FROM popisi WHERE status=1";
        $result = mysqli_query($conn, $sql);
        $popis = mysqli_fetch_row($result)[0];
        if(!$popis){
            $active = "disabled";
            $html_heading = "Popis nije u toku!";
        }else{
            //pass
        }
    }else {
        die("Connection failed: " . mysqli_connect_error());
    }
    if(isset($_SESSION['post_response'])){
        if($_SESSION['post_response'] === 2){
            echo "postoji pod tim imenom";
        }elseif($_SESSION['post_response'] === 3){
            echo "Popis je u toku";            
        }
        else{
            echo "Upisan";            
        }
    }
    //echo $str;

    //session_destroy();
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../home/montenegro.png" type="image/x-icon">
    <title>Admin</title>
</head>
<body>
    
    <header>
        <nav class="nav-bar container">
            <input type="radio" name="bar" value="ntfc" class="radio radio1" id="ntfc" checked>
            <label for="ntfc"><li class="nav-bar-li">OBAVJEŠTENJA</li></label>
            <input type="radio" name="bar" value="census" class="radio radio2" id="census" >
            <label for="census"><li class="nav-bar-li">NOVI POPIS</li></label">
        </nav>
    </header>

    <form action="logout.php" method="POST">
        <input type="submit" name="submit" value="Odjavi se" class="logout">
    </form>

    <div class="container" id="ntfc-div">
        <h1><?php echo $html_heading;?></h1>
        <div class="notifications" id="notifications">
            <div class="header">
                <div>JMBG</div>
                <div>ZAHTJEV</div>
            </div>
            <div class="header header-two">
                <div>JMBG</div>
                <div>ZAHTJEV</div>
            </div>
            <div class="notification">
                <h3 class="ntfc-jmbg">12312312312311</h3>
                <div class="request">DOMAĆINSTVO</div>
                <div class="contact hidden">1233312232</div>
                <div class="text hidden">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam pariatur quia dolorem quasi? Consequuntur, ex ut suscipit repellat sint aut, quos in alias recusandae reprehenderit, vel hic temporibus maxime nemo?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed ipsam ipsa quaerat! Minima ipsum ratione possimus quasi optio reprehenderit facere asperiores ipsa saepe minus! Iure totam delectus sunt possimus hic.</div>
            </div>
            <div class="notification">
                <h3 class="ntfc-jmbg">12312312312311</h3>
                <div class="request">DOMAĆINSTVO</div>
                <div class="contact hidden">1233312232</div>
                <div class="text hidden">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam pariatur quia dolorem quasi? Consequuntur, ex ut suscipit repellat sint aut, quos in alias recusandae reprehenderit, vel hic temporibus maxime nemo?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed ipsam ipsa quaerat! Minima ipsum ratione possimus quasi optio reprehenderit facere asperiores ipsa saepe minus! Iure totam delectus sunt possimus hic.</div>
            </div>
            <div class="notification">
                <h3 class="ntfc-jmbg">12312312312311</h3>
                <div class="request">DOMAĆINSTVO</div>
                <div class="contact hidden">1233312232</div>
                <div class="text hidden">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam pariatur quia dolorem quasi? Consequuntur, ex ut suscipit repellat sint aut, quos in alias recusandae reprehenderit, vel hic temporibus maxime nemo?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed ipsam ipsa quaerat! Minima ipsum ratione possimus quasi optio reprehenderit facere asperiores ipsa saepe minus! Iure totam delectus sunt possimus hic.</div>
            </div>
            <div class="notification">
                <h3 class="ntfc-jmbg">12312312312311</h3>
                <div class="request">DRUGO</div>
                <div class="contact hidden">1233312232</div>
                <div class="text hidden">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam pariatur quia dolorem quasi? Consequuntur, ex ut suscipit repellat sint aut, quos in alias recusandae reprehenderit, vel hic temporibus maxime nemo?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed ipsam ipsa quaerat! Minima ipsum ratione possimus quasi optio reprehenderit facere asperiores ipsa saepe minus! Iure totam delectus sunt possimus hic.</div>
            </div>
            <div class="notification">
                <h3 class="ntfc-jmbg">12312312312311</h3>
                <div class="request">DOMAĆINSTVO</div>
                <div class="contact hidden">1233312232</div>
                <div class="text hidden">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam pariatur quia dolorem quasi? Consequuntur, ex ut suscipit repellat sint aut, quos in alias recusandae reprehenderit, vel hic temporibus maxime nemo?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed ipsam ipsa quaerat! Minima ipsum ratione possimus quasi optio reprehenderit facere asperiores ipsa saepe minus! Iure totam delectus sunt possimus hic.</div>
            </div>
            <div class="notification">
                <h3 class="ntfc-jmbg">12312312312311</h3>
                <div class="request">INDIVIDUALNO</div>
                <div class="contact hidden">1233312232</div>
                <div class="text hidden">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam pariatur quia dolorem quasi? Consequuntur, ex ut suscipit repellat sint aut, quos in alias recusandae reprehenderit, vel hic temporibus maxime nemo?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed ipsam ipsa quaerat! Minima ipsum ratione possimus quasi optio reprehenderit facere asperiores ipsa saepe minus! Iure totam delectus sunt possimus hic.</div>
            </div>
        </div>
    </div>
    
    
    <div class="container hidden" id="census-div">
        <form class="form" action="post_census.php" method="POST">
            <label for="census-name">Unesite ime popisa: </label>
            <input type="text" name="census-name" id="census-name" class="census-name"  minlength="3" maxlength="15" required> 
            <label for="date">Unesite rok popisa: </label>
            <input type="date" name="date" id="date" class="date" min="<?php echo date("Y-m-d");?>" max="<?php echo date('Y-m-d',strtotime(date("Y-m-d") . " + 365 day"));?>" required>
            <br><br><br>
            <input type="submit" value="Napravi popis" class="btn <?php echo $active;?>">
        </form>    

    </div>
    <div class="modal hidden" id="modal">
        <div class="modal-jmbg" id="modal-jmbg"></div>
        <div class="modal-request" id="modal-request"></div>
        <div class="modal-contact" id="modal-contact"></div>
        <div class="modal-text" id="modal-text"></div>
        <button class="btn btn-modal refuse" id="refuse">ODOBIJ</button>
        <button class="btn btn-modal allow" id="allow">ODOBRI</button>
        <button class="btn-close" onclick="hideModal()">X</button>
    </div>

    <div class="mask hidden" id="mask"></div>

    <footer></footer>

    <script src="custom.js"></script>

</body>

</html>