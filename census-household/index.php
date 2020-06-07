<?php
	
    session_start();
    require('../config/config.php');
	require('../config/db.php');
    $jmbg_array = $_SESSION['jmbg_array'];

    
    
    
	// Check For Submit
	if(isset($_POST['submit'])){
        
        
        // Get census name
        
        
        
        $sql = "SELECT * FROM popisi WHERE status=1";
        if(mysqli_query($conn, $sql)){    
            $popis = mysqli_fetch_row(mysqli_query($conn, $sql));
            $name_dom = $popis[0]."_domacinstvo";
            $name_citz = $popis[0]."_gradjani";

            // Get form data
            $broj = mysqli_real_escape_string($conn, $_POST['broj']);
            $opstina = mysqli_real_escape_string($conn, $_POST['opstina']);
            $naselje = mysqli_real_escape_string($conn, $_POST['naselje']);
            $tip_naselja = mysqli_real_escape_string($conn, $_POST['tip_naselja']);
            $kuca = mysqli_real_escape_string($conn, $_POST['kuca']);
            $zarada = mysqli_real_escape_string($conn, $_POST['zarada']);
            
        
            
            
            $help = 0;
            $query = "INSERT INTO $name_dom (`id_dom`, `br_ukucana`, `opstina`, `naselje`, `tip_naselja`, `tip_kuce`, `zarada`) VALUES (NULL, '$broj', '$opstina', '$naselje', '$tip_naselja', '$kuca', '$zarada')";
            if(mysqli_query($conn, $query) ){
                $query1 = "SELECT max(id_dom) FROM $name_dom";

                // Get Result
                $result = mysqli_query($conn, $query1);
                

                // Fetch Data
                if($result){
                    $id = mysqli_fetch_row($result);
                }else{
                    $id[0] = 1;
                }
                

                $help++;
            }
                else {
                echo 'ERROR: '. mysqli_error($conn) ;
            }
            
            for ($i=0;$i<count($jmbg_array);$i++){
                echo $id[0];
                $query2 = "UPDATE $name_citz SET 
                        id_dom = '$id[0]'
                            WHERE jmbg = '$jmbg_array[$i]' ";
                if(mysqli_query($conn, $query2) and mysqli_query($conn, $query1)){
                    $help++;
                    
                }
                else {
                echo 'ERROR: '. mysqli_error($conn);
            }
            }
            if ($help === count($jmbg_array)+1){          
                session_destroy();
                header('Location: ../home/index.php');
                
            }
        }else{
            session_destroy();
            header('Location: ../home/index.php');
        }
        
        
    }
        
    
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <h3>Izabrali ste opciju POPIŠI DOMAĆINSTVO.</h3>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
               <div class="form-part f1">
                <div class="input-ukucani">
                    1. Unesite broj članova Vašeg domaćinstva:
                    <input type="number" name="broj" class="broj-ukucana" min="1" required>
                </div>
                
                
                
               </div> 
               <div class="form-part f2" >
                   <div class="opstina">
                    2. Izaberite opštinu:    
                    <select class="select-opstina" name="opstina">
                         <option value="Andrijevica">Andrijevica</option>
                         <option value="Bar">Bar</option>
                         <option value="Berane">Berane</option>
                         <option value="Bijelo Polje">Bijelo Polje</option>
                         <option value="Budva">Budva</option>
                         <option value="Cetinje">Cetinje</option>
                         <option value="Danilovgrad">Danilovgrad</option>
                         <option value="Gusinje">Gusinje</option>
                         <option value="Herceg Novi">Herceg Novi</option>
                         <option value="Kolašin">Kolašin</option>
                         <option value="Kotor">Kotor</option>
                         <option value="Mojkovac">Mojkovac</option>
                         <option value="Nikšić">Nikšić</option>
                         <option value="Petnjica">Petnjica</option>
                         <option value="Plav">Plav</option>
                         <option value="Plužine">Plužine</option>
                         <option value="Pljevlja">Pljevlja</option>
                         <option value="Podgorica" selected>Podgorica</option>
                         <option value="Rožaje">Rožaje</option>
                         <option value="Šavnik">Šavnik</option>
                         <option value="Tivat">Tivat</option>
                         <option value="Tuzi">Tuzi</option>
                         <option value="Ulcinj">Ulcinj</option>
                         <option value="Žabljak">Žabljak</option>
                    </select>
                   </div>
                   
                   
                    
               </div>
               <div class="form-part f3">
                   3. Unesite ime naselja: <input type="text" name="naselje" class="ime-naselja" required><br><br>
                   Izaberite tip naselja:
                    <select class="tip-naselja" name="tip_naselja" required>
                        <option value="grad">Grad</option>
                        <option value="selo">Selo</option>
                   </select>
                   
                    
               </div>
               <div class="form-part f4">
                    4. Živite u: 
                    <select class="kuca"  name="kuca" required>
                        <option value="kuća">Kući</option>
                        <option value="stan">Stanu</option>
                   </select>
                   
                    
               </div>
               <div  class="form-part f5">
                   5. Unesite (prosječnu) ukupnu zaradu na nivou domaćinstva: <input type="number" name="zarada" class="zarada" min=1 required> (€)
                   
                   
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