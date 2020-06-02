<?php 
    session_start();
    print_r($_SESSION["jmbg-array"]);
    session_destroy();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <ul>
            <li>POČETNA STRANA</li>
            <li>POPIŠI SE</li>
            <li>REZULTATI POPISA</li>
        </ol>
    </nav>
    <div class="main">
        <div class="map"><img src="map.png" alt="map" class="map-image"></div>
        <div class="form">
            <h3>Izabrali ste opciju POPIŠI DOMAĆINSTVO.</h3>
            <form>
               <div class="form-part f1">
                <div class="input-ukucani">
                    1. Unesite broj članova Vašeg domaćinstva:
                    <input type="number" class="broj-ukucana" min="1" required>
                </div>
                
                
                
               </div> 
               <div class="form-part f2" >
                   <div class="opstina">
                    2. Izaberite opštinu:    
                    <select class="select-opstina">
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
                   3. Unesite ime naselja: <input type="text" class="ime-naselja" required><br><br>
                   Izaberite tip naselja:
                    <select class="tip-naselja" required>
                        <option value="grad">Grad</option>
                        <option value="selo">Selo</option>
                   </select>
                   
                    
               </div>
               <div class="form-part f4">
                    4. Živite u: 
                    <select class="kuca" required>
                        <option value="kuća">Kući</option>
                        <option value="stan">Stanu</option>
                   </select>
                   
                    
               </div>
               <div  class="form-part f5">
                   5. Unesite (prosječnu) ukupnu zaradu na nivou domaćinstva: <input type="number" class="zarada" min=1 required> (€)
                   
                   
               </div>
               
               
               <button class="tick">&#10004;</button>
               <button class="back">&larr;</button>
                <input type="submit" value="Predaj odgovore" class="submit">
            </form>
            <p>*pritisnite štrik nakon što odgovorite na pitanje</p>
            <img src="people.jpg" alt="people" class="people">
        </div>
    </div>

    <footer></footer>
    <script src="index.js"></script>
</body>
</html>