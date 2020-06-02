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
            <h3>Izabrali ste opciju POPIŠI SE.</h3>
            <form>
                <div  class="form-part f1">
                    1. Pol: <br>
                    <input type="radio" id="male" name="gender" value="Muški">
                    <label for="male">Muški</label><br>
                    <input type="radio" id="female" name="gender" value="Ženski">
                    <label for="female">Ženski</label>
                    
                </div>
               <div class="form-part f2">
                    2. Vaša nacionalna pripadnost:
                    <select class="select-nacija" required>
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
                    <select class="select-jezik" required>
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
                    <select class="vjera" required>
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