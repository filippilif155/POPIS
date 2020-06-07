<?php
	require('../config/config.php');
	require('../config/db.php');

    
    
    
	// Check For Submit
	if(isset($_POST['submit'])){
        session_start();
        $jmbg = $_SESSION["jmbg"];
        $godiste = '1'.substr($jmbg, 4, 3);
        $id_dom = $_SESSION["id_dom"];
        $sql = "SELECT * FROM popisi WHERE status=1";
        if(mysqli_query($conn, $sql)){    
            $popis = mysqli_fetch_row(mysqli_query($conn, $sql));
            $name_ctzn = $popis[0]."_gradjani";
            $name_res = $popis[0]."_rezultati";

            // Get form data
            $pol = mysqli_real_escape_string($conn, $_POST['gender']);
            $nacija = mysqli_real_escape_string($conn, $_POST['nacija']);
            $jezik = mysqli_real_escape_string($conn, $_POST['jezik']);
            $vjera = mysqli_real_escape_string($conn, $_POST['vjera']);
            $posao = mysqli_real_escape_string($conn, $_POST['posao']);
            $brak = mysqli_real_escape_string($conn, $_POST['brak']);
            
            

            $query = "INSERT INTO $name_res (`jmbg`, `godiste`, `pol`, `nacija`, `jezik`, `vjera`, `posao`, `brak`, `id_dom`) VALUES ('$jmbg', '$godiste', '$pol', '$nacija', '$jezik', '$vjera', '$posao', '$brak', '$id_dom')";
            $query1 = "UPDATE $name_ctzn SET status = '1' WHERE jmbg = '$jmbg' ";
            if(mysqli_query($conn, $query) and mysqli_query($conn, $query1)){
                $_SESSION['popis'] = 1;
                header('Location: ../redirect/index.html');
            } 
            else {
                echo 'ERROR: '. mysqli_error($conn);
            }
        }
        else{
            header('Location: ../redirect/index.html');
        }
	}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPIS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../navbar/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../home/montenegro.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
    <nav>
        <ul>
            <a href="../home/index.php"><li>POČETNA STRANA</li></a>
            <a href="../contact_us/index.php"><li>KONTAKTIRAJ NAS</li></a>
            <a href="../list/list.php"><li>REZULTATI POPISA</li></a>
            
        </ul>
        <div class="handle">
				<p class="menu">MENU</p>
				<div class="menu_icon">
			      <div></div>
			      <div></div>
			      <div></div>
		        </div>
		</div>
    </nav>
    <div class="main">
        <div class="map"><img src="map.png" alt="map" class="map-image"></div>
        <div class="form">
            <h3>Izabrali ste opciju POPIŠI SE.</h3>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div  class="form-part f1">
                    1. Pol: <br>
                    <input type="radio" id="male" name="gender" value="Muški">
                    <label for="male">Muški</label><br>
                    <input type="radio" id="female" name="gender" value="Ženski">
                    <label for="female">Ženski</label>
                    
                </div>
               <div class="form-part f2">
                    2. Vaša nacionalna pripadnost:
                    <select class="select-nacija" name="nacija" required>
                        <option value="Crnogorac">Crnogorac</option>
                        <option value="Srbin">Srbin</option>
                        <option value="Bošnjak">Bošnjak</option>
                        <option value="Albanac">Albanac</option>
                        <option value="Musliman">Musliman</option>
                        <option value="Rom">Rom</option>
                        <option value="Hrvat">Hrvat</option>
                        <option value="neizjašnjen" selected>neizjašnjen</option>
                        <option value="ostalo">ostalo</option>
                    </select>
                
                
                
               </div> 
               <div class="form-part f3" >
                   <div class="jezik">
                    3. Izaberite maternji jezik:    
                    <select class="select-jezik" name="jezik" required>
                         <option value="crnogorski">crnogorski</option>
                         <option value="srpski">srpski</option>
                         <option value="bosanski">bosanski</option>
                         <option value="albanski">albanski</option>
                         <option value="romski">romski</option>
                         <option value="bošnjački">bošnjački</option>
                         <option value="hrvatski">hrvatski</option>
                         <option value="neizjašnjen" selected>neizjašnjen</option>
                         <option value="ostalo">ostalo</option>

                    </select>
                   </div>
                   
                   
                    
               </div>
               <div class="form-part f4">
                   4. Vaša vjerska pripadnost:
                    <select class="vjera" name="vjera" required>
                        <option value="Pravoslavna">Pravoslavna</option>
                        <option value="Katolička">Katolička</option>
                        <option value="Muslimanska">Muslimanska</option>
                        <option value="Adventist">Adventist</option>
                        <option value="Agnostik">Agnostik</option>
                        <option value="Budista">Budista</option>
                        <option value="neizjašnjen" selected>neizjašnjen</option>
                        <option value="ostalo">ostalo</option>

                   </select>
                   
                    
               </div>
               <div class="form-part f5">
                5. Zaposleni ste: <br>
                    <input type="radio" id="da" name="posao" value="da">
                    <label for="da">Da</label><br>
                    <input type="radio" id="ne" name="posao" value="ne">
                    <label for="ne">Ne</label><br>
                   
                    
               </div>
               
               <div  class="form-part f6">
                6. U braku ste: <br>
                <input type="radio" id="da1" name="brak" value="da">
                <label for="da1">Da</label><br>
                <input type="radio" id="ne1" name="brak" value="ne">
                <label for="ne1">Ne</label>
                
            </div>
               
               
               <button class="tick">&#10004;</button>
               <button class="back">&larr;</button>
               <input type="submit" name="submit" value="Predaj odgovore" class="submit">

            </form>
            <p class="napomena">*pritisnite štrik nakon što odgovorite na pitanje</p>
            <img src="people.jpg" alt="people" class="people">
        </div>
    </div>

    <footer></footer>
    <script src="index.js"></script>
    <script>
		$('.handle').on('click', function(){
			$('nav ul').toggleClass('showing');
		});
	</script>
</body>
</html>