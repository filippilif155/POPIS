<?php
	require('../config/config.php');
  require('../config/db.php');
  if(isset($_POST['submit'])){
        $sql = "SELECT * FROM popisi WHERE status=1";
        if(mysqli_query($conn, $sql)){
          $popis = mysqli_fetch_row(mysqli_query($conn, $sql));
          $name_ntfc = $popis[0]."_obavjestenja";
          $ime = mysqli_real_escape_string($conn, $_POST['ime']);
          $prezime = mysqli_real_escape_string($conn, $_POST['prezime']);
          $jmbg = mysqli_real_escape_string($conn, $_POST['jmbg']);
          $kontakt = mysqli_real_escape_string($conn, $_POST['kontakt']);
          $tip_zahtjeva = mysqli_real_escape_string($conn, $_POST['tip_zahtjeva']);
          $tekst_zahtjeva = mysqli_real_escape_string($conn, $_POST['tekst']);

          $query = "INSERT INTO $name_ntfc (`jmbg`, `ime`, `prezime`, `kontakt`, `tip_zahtjeva`, `tekst_zahtjeva`) VALUES ('$jmbg', '$ime', '$prezime', '$kontakt', '$tip_zahtjeva', '$tekst_zahtjeva')";
          if(mysqli_query($conn, $query)){
            header('Location: ../redirect/index.html');
          } 
        else {
            echo 'ERROR: '. mysqli_error($conn);
        }
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
    <div class="background">
        <div class="container">
          <div class="screen">
            <div class="screen-header">
              <div class="screen-header-left">
                <div class="screen-header-button close"></div>
                <div class="screen-header-button maximize"></div>
                <div class="screen-header-button minimize"></div>
              </div>
              <div class="screen-header-right">
                <div class="screen-header-ellipsis"></div>
                <div class="screen-header-ellipsis"></div>
                <div class="screen-header-ellipsis"></div>
              </div>
            </div>
            <div class="screen-body">
              <div class="screen-body-item left">
                <div class="app-title">
                  <span>KONTAKTIRAJ</span>
                  <span>NAS</span>
                </div>
                <div class="app-contact">KONTAKT BROJ : +62 81 314 928 595</div>
              </div>
              <div class="screen-body-item">
                <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                  <div class="app-form">
                    <div class="app-form-group">
                      <input type="text"class="app-form-control" name="ime" placeholder="IME">
                    </div>
                    <div class="app-form-group">
                      <input type="text"class="app-form-control" name="prezime" placeholder="PREZIME">
                    </div>
                    <div class="app-form-group">
                      <input type="number" class="app-form-control"name="jmbg" placeholder="JMBG">
                    </div>
                    <div class="app-form-group">
                      <input type="text" class="app-form-control"name="kontakt" placeholder="KONTAKT INFO">
                    </div>
                    <div class="app-form-group grey" >
                        IZABERITE TIP ZAHTJEVA:<br><br>
                        
                        <input type="radio" name="tip_zahtjeva" id="brisanje_popisa_i" value="individualno" >
                        <label for="brisanje_popisa_i">Brisanje individualnog popisa </label><br><br>
                        <input type="radio" name="tip_zahtjeva" id="brisanje_popisa_d" value="domacinstvo" >
                        <label for="brisanje_popisa_d">Brisanje popisa domacinstva (automatski briše i individualni) </label><br><br>
                        
                        <input type="radio" name="tip_zahtjeva" id="drugo" value="drugo" > 
                        <label for="drugo">Drugo</label>
                        


                    </div>
                    
                    <div class="app-form-group message">
                      <textarea class="app-form-control" name="tekst" placeholder="TEKST ZAHTJEVA"></textarea>
                    </div>
                    <div class="app-form-group buttons">
                      <button class="app-form-button">NAZAD</button>
                      <button class="app-form-button" name="submit">POŠALJI</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
         
          </div>
            
        </div>
      </div>
      <footer></footer>
  <script>
		$('.handle').on('click', function(){
			$('nav ul').toggleClass('showing');
		});
	</script>
</body>
</html>