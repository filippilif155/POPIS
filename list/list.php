<?php
    require '../config/config.php';
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn) {
        $sql = "SELECT ime_popisa FROM popisi";
        $html_select = "U bazi nema popisa!";
        if(mysqli_query($conn, $sql)){
            $popis = mysqli_fetch_all(mysqli_query($conn, $sql));
            $html_select = '<label for="popisi">Izaberite popis: </label>
            <select name="popisi" id="popisi">';
            foreach ($popis as $elem) {
                $html_select =  $html_select.'<option value="'.$elem[0].'">'.$elem[0].'</option>';
            }
            $html_select = $html_select."</select>";

        }else{

        }

    }else {
        die("Connection failed: " . mysqli_connect_error());
    }


?>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/3cb4a77e3d.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POPIS</title>
    <link href="https://fonts.googleapis.com/css?family=Merriweather|Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../navbar/style.css">
    <link rel="shortcut icon" href="../home/montenegro.png" type="image/x-icon">


</head>




<body>

    <nav>
        <ul>
            <a href="../home/index.php"><li>POČETNA STRANA</li></a>
            <a href="../contact_us/index.php"><li>KONTAKTIRAJ NAS</li></a>
            <a href="#"><li>REZULTATI POPISA</li></a>
            
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
    
    <form action="rezultati.php" target="_blank" method="GET">
        <div class="select">
            <?php echo $html_select;?>
        </div>
   <main>
       
    <button type="button"  id="prev" class= "fas fa-chevron-left"></button>  
    <div class="slider" id="slide">
        <div class="visibleslide">
            <div class="item" >
                <label class="checkbox" for="pol" style ='background-image: url("./ISimage/gender.png"); background-position: center; 
                background-repeat: no-repeat; 
                background-size: 80%;'>
                    Pol
                <input type="checkbox" style="opacity: 0;" value="Pol" name="form[]" id="pol" >            
                </label>
            </div>
            <div class="item" >
                <label class="checkbox" style="background-image: url('./ISimage/nat.png'); background-position: center; 
                background-repeat: no-repeat; 
                background-size:60%   ;" for="nacija">
                    Nacija
                <input type="checkbox" style="opacity: 0;" value="Nacija" name="form[]" id="nacija">            
                </label>
            </div>
            <div class="item" >
                <label class="checkbox" for="jezik" style="background-image: url('./ISimage/len.png'); background-position: center; 
                background-repeat: no-repeat; 
                background-size:80%   ;">
                    Jezik
                <input type="checkbox" style="opacity: 0;" value="Jezik"  name="form[]" id="jezik" >            
                </label>
            </div>
            </div>
        <div class="visibleslide">
            <div class="item" >
                <label class="checkbox" for="vjera" style="background-image: url('./ISimage/rel.png'); background-position: center; 
                background-repeat: no-repeat; 
                background-size:80%   ;">
                    Vjera
                <input type="checkbox" style="opacity: 0;" value="Vjera"   name="form[]" id="vjera" >            
                </label>
            </div>
            <div class="item" >
                <label class="checkbox" for="zaposlenje" style ='background-image: url("./ISimage/work.png"); background-position: center; 
                background-repeat: no-repeat; 
                background-size: 70%;'>
                    Zaposlenje
                <input type="checkbox" style="opacity: 0;" value="Zaposlenje"  name="form[]" id="zaposlenje" >            
                </label>
            </div>
            <div class="item">
                <label class="checkbox" for="brak" style ='background-image: url("./ISimage/mar.png"); background-position: center; 
                background-repeat: no-repeat; 
                background-size: 80%;'>
                    Bracni status
                <input type="checkbox" style="opacity: 0;" value="Brak"  name="form[]" id="brak" >            
                </label>
            </div>
            </div>
            <div class="visibleslide">
                <div class="item">
                    <label class="checkbox" for="brojstanovnika" style ='background-image: url("./ISimage/people.png"); background-position: center; 
                    background-repeat: no-repeat; 
                    background-size: 80%;'>
                        Broj stanovnika
                    <input type="checkbox" style="opacity: 0;" value="BrojStanovnika"   name="form[]" id="brojstanovnika" >            
                    </label>
                </div>
                <div class="item">
                    <label class="checkbox" for="tip" style ='background-image: url("./ISimage/tip.png"); background-position: center; 
                    background-repeat: no-repeat; 
                    background-size: 80%;'>
                        Tip naselja
                    <input type="checkbox" style="opacity: 0;" value="Tip"   name="form[]" id="tip" >            
                    </label>
                </div>
                <div class="item">
                    <label class="checkbox" for="zarada" style ='background-image: url("./ISimage/money.png"); background-position: center; 
                    background-repeat: no-repeat; 
                    background-size: 80%;'>
                        Zarada
                    <input type="checkbox" style="opacity: 0;" value="Zarada"   name="form[]" id="zarada" >            
                    </label>
                </div>
                </div>
            
    </div> 
    <button id="next" type="button" class= "fas fa-chevron-right" ></button>
   </main>
   <div class ="inputp">
   <input type="submit" name="" id="submitbtn" value="Pretraži">
   </div>
   </form> 

   <footer class="footer">
       <p>Kontakt: popis@mne.com</p>
   </footer>
   <script src="./search.js" ></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
		$('.handle').on('click', function(){
			$('nav ul').toggleClass('showing');
		});
    </script>
</body>
</html>