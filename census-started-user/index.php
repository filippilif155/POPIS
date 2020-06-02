
<?php
session_start();
$html_errors = "";
$hidden = "hidden";


if(isset($_POST['jmbg']) || isset($_POST['jmbg-0'])){
    $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
    if ($conn) {
        
        $sql = "SELECT * FROM popisi WHERE status=1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        $table = $row[0]."_"."gra";

        if(!empty($_POST['jmbg'])){
            $jmbg = stripcslashes($_POST["jmbg"]);
            $jmbg = mysqli_real_escape_string($conn, $jmbg);
            $sql = "SELECT * FROM $table WHERE jmbg={$jmbg}";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            if($row){
                if(is_null($row[3])){
                    $html_errors = "<span>Da bi radili popis stanovništva prvo morate popisati svoje domaćinstvo!</span>";
                    $hidden = "";
                }elseif(!is_null($row[4])){
                    $html_errors = "<span>Već ste popisani! Ukoliko je došlo do greške kontaktirajte admina klikom <a href='#'>ovdje</a></span>";
                    $hidden = "";
                }else{
                    $_SESSION['jmbg'] = $jmgb;
                    header('Location: ../census-individual');
                }
            }
        }elseif(!empty($_POST['jmbg-0'])){
            $num = $_POST["num-of-fields"];
            $for_error = 0;
            for($i = 0; $i < $num; $i++){
                $str_current = "jmbg-{$i}";
                for($j = $i - 1; $j > 0; $j--){
                    $str_chck = "jmbg-{$j}";
                    if($_POST[$str_current] === $_POST[$str_chck]){
                        $html_errors = "<span>Vaš unos sadrži duplikate!<br></span>";
                        $for_error = 1;
                        break;
                    }
                }
                if($for_error === 1){
                    break;
                }
            }
            if($for_error === 1){
                $hidden = "";
            }else{
                $_SESSION["jmbg-array"] = [];
                for($i = 0; $i < $num; $i++){
                    $jmbg = stripcslashes($_POST["jmbg-{$i}"]);
                    $jmbg = mysqli_real_escape_string($conn, $jmbg);
                    $sql = "SELECT * FROM $table WHERE jmbg={$jmbg}";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_row($result);
                    if($row){
                        if(!is_null($row[3])){
                            $html_errors = $html_errors."<span>Osoba sa JMBG-om {$jmbg} je več popisala svoje domaćinstvo. <br></span>";    
                        }else{
                            array_push($_SESSION["jmbg-array"], $jmbg);
                        }
                    }else{
                        $html_errors = $html_errors."<span>Osoba sa JMBG-om {$jmbg} ne postoji. <br></span>";
                    }
                }
                if($html_errors !== ""){
                    $hidden = "";
                }else{
                    header('Location: ../census-household/index.php');
                }
            }


        }

    }else {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($conn);
}
?> 


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPIS</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../home/montenegro.png" type="image/x-icon">
</head>
<body>
    <h1>POPIS JE POČEO!</h1>
    <h3 id="time"></h3>
    <h3 class="time-left">PREOSTALO DO KRAJA POPISA</h3>
    <p class="text">Građanin najprije popisuje svoje domaćinstvo. Domaćinstvo se popisuje SAMO jedanput. Dakle, svaki idući član pomenutog popisuje se isključivo individualno. Ukoliko je Vaše domaćinstvo popisano, birate opciju POPIŠI SE.</p>
    <button id="show-dom-form">POPIŠI DOMAĆINSTVO</button>
    <button id="show-ind-form">POPIŠI SE</button>
    
    <img src="man.png" alt="man" class="man">


    <div class="dom-form-div hidden" id="dom">
    <form onsubmit="validateDomForm();" action="" method="POST" class="dom-form">
        
        <div class="num-of-fields-div">
            <label for="num-of-fields" class="num-of-fields-label">Broj ukućana: </label><input type="number" min-value="1" max-value="14" name="num-of-fields" id="num-of-fields" class="num-of-fields" value="1">
        </div>
        <div class="jmbg-cont" id="jmbg-cont">
            <input type="number" name="jmbg-0" class="box" placeholder="Upišite JMBG" required>
        </div>
        <input type="submit" name="submit" value="Započni popis" class="submit-dom"> 

    </form>
    <button class="btn-close" id="dom-close">X</button>
    </div>

    <div class="dom-form-div ind-form-div hidden" id="ind">
        <form class="dom-form ind-form" onsubmit="validateIndForm();" action="" method="POST">
            <label for="jmbg">Unesite vaš JMBG: </label>
            <input type="number" name="jmbg" class="jmbg" id="jmbg" required>
            <input type="submit" value="Započni popis" class="submit-ind">
        </form>
        <button class="btn-close" id="ind-close">X</button>
    </div>



    <div class="mask <?php echo $hidden;?>" id="mask"></div>

    <div class="html-error <?php echo $hidden;?>" id="html-error">
        <?php echo $html_errors;?>
        <span>Ukoliko želite da prijavite grešku kliknite <a href="#">ovdje</a>.</span>
        <button class="btn-close err-btn" id="error-close">X</button>
    </div>

    <script src="custom.js"></script>
</body>
</html>
