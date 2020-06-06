<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezultati</title>
    <style>
        table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
  margin-bottom: 100px;
  margin-top: 30px;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
    </style>
  <link rel="stylesheet" href="css/styles.css?v=1.0">




</head>
<body>





    <?php

    if(!isset($_GET['popisi'])){
        header('Location: ../home/index.php');   
    }
    $name= $_GET['popisi'];
    $name_citz = $name."_rezultati";
    $name_dom = $name."_{domacinstvo}";
    


    function IsChecked($chkname,$value)
    {
        if(!empty($_GET[$chkname]))
        {
            foreach($_GET[$chkname] as $chkval)
            {

                if($chkval == $value)
                {
                    return true;
                }
            }
        }
        return false;
    }
    if(IsChecked('form','Pol'))
    {
        pol();
    }
    if(IsChecked('form','Nacija')){
        nacija();

    }
    if(IsChecked('form','Jezik')){
        jezik();
    }
    if(IsChecked('form','Vjera')){
        vjera();
        
    }
    if(IsChecked('form','Zaposlenje')){
        zap();
        
    }
    if(IsChecked('form','Brak')){
        brak();
        
    }
    if(IsChecked('form','BrojStanovnika')){
        broj();
        
    }
    if(IsChecked('form','Tip')){
        tip();
        
    }
    if(IsChecked('form','Zarada')){
        zarada();
        
    }
    function pol()
    {
    global $name_citz, $name_dom;
    $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
    $sql = "SELECT 
    {$name_dom}.opstina as Grad,
    COUNT(CASE WHEN Pol ='Muski' then 1 ELSE NULL END) as Muski,
    COUNT(CASE WHEN Pol ='Zenski' then 1 ELSE NULL END) as Zenski,
    COUNT(*) as ukupno
    FROM {$name_citz} 
    JOIN {$name_dom} ON 
    {$name_citz}.id_dom = {$name_dom}.id_dom
    GROUP by Grad;";
        $result1 = mysqli_query($conn, $sql);
            print "<p>STANOVNIŠTVO PREMA POLU PO OPŠTINAMA </p>\n
            <table border='1' class = 'blueTable'>\n
            <th>Opština</th>\n
            <th>Muški</th>\n
            <th>Ženski</th>\n
            <th>Ukupno</th>\n
            <th>Procenat muškaraca</th>\n
            <th>Procenat žena</th>\n";
            if($result1){
                while($row = mysqli_fetch_assoc($result1)){
                    print "<tr>\n";
                    foreach ($row as $item) {
                        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    }
                    
                print "<td>". round($row['Muski']*100 /$row['ukupno']) . "%</td>\n
                    <td>". round($row['Zenski']*100 /$row['ukupno']) . "%</td>\n
                </tr>\n";
                }}
            print "</table>\n";
            mysqli_close($conn);
        
        }
   function nacija(){
    global $name_citz, $name_dom;
      $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
    $sql = "SELECT 
    {$name_dom}.opstina as Grad,
    COUNT(CASE WHEN Nacija ='Crnogorac' then 1 ELSE NULL END) as Crnogorci,
    COUNT(CASE WHEN Nacija ='Srbin' then 1 ELSE NULL END) as Srbi,
    COUNT(CASE WHEN Nacija ='Bošnjak' then 1 ELSE NULL END) as Bosnjaci, 
    COUNT(CASE WHEN Nacija ='Albanac' then 1 ELSE NULL END) as Albanci,
    COUNT(CASE WHEN Nacija ='Musliman' then 1 ELSE NULL END) as Muslimani,
    COUNT(CASE WHEN Nacija ='Rom' then 1 ELSE NULL END) as Romi,
    COUNT(CASE WHEN Nacija ='Hravat' then 1 ELSE NULL END) as Hrvati,
    COUNT(CASE WHEN Nacija ='Ostalo' then 1 ELSE NULL END) as Ostalo,
    COUNT(*) as ukupno
    FROM {$name_citz} 
    JOIN {$name_dom} ON 
    {$name_citz}.id_dom = {$name_dom}.id_dom
    GROUP by Grad;
    ";
        $result1 = mysqli_query($conn, $sql);
            print "<p>STANOVNIŠTVO PREMA NACIONALNOJ, ODNOSNO ETIČKOJ PRIPADNOSTI PO OPŠTINAMA </p>\n
            <table border='1' class = 'blueTable'>\n
                  <th>Opština</th>\n
                  <th>Crnogorci</th>\n
                  <th>Srbi</th>\n
                  <th>Bošnjaci</th>\n
                  <th>Albanci</th>\n
                  <th>Muslimani</th>\n
                  <th>Romi</th>\n
                  <th>Hrvati</th>\n
                  <th>Ostalo</th>\n
                  <th>Ukupno</th>\n";
                  if($result1){
                    while($row = mysqli_fetch_assoc($result1)){
                    print "<tr>\n";
                    foreach ($row as $item) {
                        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    }
                    print "</tr>\n";
                }}
            print "</table>\n";


            $result1 = mysqli_query($conn, $sql);
            print "<p>ODNOS STANOVNIŠTVO U PROCENTIMA PREMA NACIONALNOJ, ODNOSNO ETIČKOJ PRIPADNOSTI PO OPŠTINAMA </p>\n
            <table border='1' class = 'blueTable'>\n
                  <th>Opština</th>\n
                  <th>Crnogorci</th>\n
                  <th>Srbi</th>\n
                  <th>Bosnjaci</th>\n
                  <th>Albanci</th>\n
                  <th>Muslimani</th>\n
                  <th>Romi</th>\n
                  <th>Hrvati</th>\n
                  <th>Ostalo</th>\n
                  <th>Ukupno</th>\n";
                  if($result1){
                      while($row = mysqli_fetch_assoc($result1)){

                        print "
                            <tr>\n
                            <td> " .$row['Grad']  ."</td>\n
                            <td>". round($row['Crnogorci']*100/$row['ukupno']) . "%</td>\n
                            <td>\n". round($row['Srbi']*100/$row['ukupno']) . "%</td>\n
                            <td>\n". round($row['Bosnjaci']*100/$row['ukupno']) . "%</td>\n
                            <td>\n". round($row['Albanci']*100/$row['ukupno']) . "%</td>\n
                            <td>\n". round($row['Muslimani']*100/$row['ukupno']) . "%</td>\n
                            <td>\n". round($row['Romi']*100/$row['ukupno']) . "%</td>\n
                            <td>\n". round($row['Hrvati']*100/$row['ukupno']) . "%</td>\n
                            <td>\n".round($row['Ostalo']*100/$row['ukupno']) . "%</td>\n
                            <td>\n".$row['ukupno'] . "</td>
                            </tr>\n";
                }
            }
            
           print "</table>\n";


            mysqli_close($conn);
        }
        function jezik(){
            global $name_citz, $name_dom; 
      $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
      $sql = "SELECT 
      {$name_dom}.opstina as Grad,
      COUNT(CASE WHEN Jezik ='crnogorski' then 1 ELSE NULL END) as crnogorski,
      COUNT(CASE WHEN Jezik ='srpski' then 1 ELSE NULL END) as srpski,
      COUNT(CASE WHEN Jezik ='bosanski' then 1 ELSE NULL END) as bosanski, 
      COUNT(CASE WHEN Jezik ='albanski' then 1 ELSE NULL END) as albanski,
      COUNT(CASE WHEN Jezik ='romski' then 1 ELSE NULL END) as romski,
      COUNT(CASE WHEN Jezik ='bošnjački' then 1 ELSE NULL END) as bošnjački,
      COUNT(CASE WHEN Jezik ='hrvatski' then 1 ELSE NULL END) as hrvatski,
      COUNT(CASE WHEN Jezik ='neizjašnjeno' then 1 ELSE NULL END) as neizjašnjeno,
      COUNT(CASE WHEN Jezik ='ostalo' then 1 ELSE NULL END) as ostalo,
      COUNT(*) as ukupno
      FROM {$name_citz} 
      JOIN {$name_dom} ON 
      {$name_citz}.id_dom = {$name_dom}.id_dom
      GROUP by Grad;
      ";
          $result1 = mysqli_query($conn, $sql);
              print "<p>STANOVNIŠTVO PREMA MATERNJEM JEZIKU PO OPŠTINAMA</p>\n
              <table border='1' class = 'blueTable'>\n
                  <th>Opština</th>\n
                  <th>Crnogorski</th>\n
                  <th>Srpski</th>\n
                  <th>Bosanski</th>\n
                  <th>Albanski</th>\n
                  <th>Romski</th>\n
                  <th>Bošnjački</th>\n
                  <th>Hrvatski</th>\n
                  <th>Neizjašnjeni</th>\n
                  <th>Ostalo</th>\n
                  <th>Ukupno</th>\n";
                  if($result1){while($row = mysqli_fetch_assoc($result1)){
                    print "<tr>\n";
                    foreach ($row as $item) {
                        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    }
                    print "</tr>\n";
                }}
              print "</table>\n";
              
             

              $result1 = mysqli_query($conn, $sql);
              print "<p>ODNOS STANOVNIŠTVO U PROCENTIMA PREMA MATERNJEM JEZIKU PO OPŠTINAMA </p>\n
              <table border='1' class = 'blueTable'>\n
              <th>Opština</th>\n
              <th>Crnogorski</th>\n
              <th>Srpski</th>\n
              <th>Bosanski</th>\n
              <th>Albanski</th>\n
              <th>Romski</th>\n
              <th>Bošnjački</th>\n
              <th>Hrvatski</th>\n
              <th>Neizjašnjeni</th>\n
              <th>Ostalo</th>\n
              <th>Ukupno</th>\n";
              if($result1){while($row = mysqli_fetch_assoc($result1)){
    
                print "
                    <tr>\n
                    <td> " .$row['Grad']  ."</td>\n
                    <td>". round($row['crnogorski']*100/$row['ukupno']) . "%</td>\n
                    <td>\n". round($row['srpski']*100/$row['ukupno']) . "%</td>\n
                    <td>\n". round($row['bosanski']*100/$row['ukupno']) . "%</td>\n
                    <td>\n". round($row['albanski']*100/$row['ukupno']) . "%</td>\n
                    <td>\n". round($row['romski']*100/$row['ukupno']) . "%</td>\n
                    <td>\n". round($row['bošnjački']*100/$row['ukupno']) . "%</td>\n
                    <td>\n". round($row['hrvatski']*100/$row['ukupno']) . "%</td>\n
                    <td>\n".round($row['neizjašnjeno']*100/$row['ukupno']) . "%</td>\n
                    <td>\n".$row['ostalo']*100/$row['ukupno'] . "%</td>\n
                    <td>\n" . $row['ukupno'] . " </td>\n
                    </tr>\n";
                }}
              
             print "</table>\n";
  
  
              mysqli_close($conn);
        }
        
        function vjera(){
            global $name_citz, $name_dom;
          $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
          $sql = "SELECT 
          {$name_dom}.opstina as Grad,
          COUNT(CASE WHEN Vjera ='Pravoslavna' then 1 ELSE NULL END) as Pravoslavci,
          COUNT(CASE WHEN Vjera ='Katolička' then 1 ELSE NULL END) as Katolici,
          COUNT(CASE WHEN Vjera ='Muslimanska' then 1 ELSE NULL END) as Muslimani, 
          COUNT(CASE WHEN Vjera ='Adventist' then 1 ELSE NULL END) as Adventisti, 
          COUNT(CASE WHEN Vjera ='Agnostik' then 1 ELSE NULL END) as Agnostici, 
          COUNT(CASE WHEN Vjera ='Budista' then 1 ELSE NULL END) as Budisti, 
          COUNT(CASE WHEN Vjera ='neizjašnjen' then 1 ELSE NULL END) as neizjašnjeni,
          COUNT(CASE WHEN Vjera ='ostali' then 1 ELSE NULL END) as ostalo,
          COUNT(*) as ukupno
          FROM {$name_citz} 
          JOIN {$name_dom} ON 
          {$name_citz}.id_dom = {$name_dom}.id_dom
          GROUP by Grad;
          ";
              $result1 = mysqli_query($conn, $sql);
                  print "<p>STANOVNIŠTVO PREMA VJERSKOM OPREDJELJENJU PO OPŠTINAMA</p>\n
                  <table border='1' class = 'blueTable'>\n
                  <th>Opština</th>\n
                  <th>Pravoslavci</th>\n
                  <th>Katolici</th>\n
                  <th>Muslimani</th>\n
                  <th>Adventisti</th>\n
                  <th>Agnostici</th>\n
                  <th>Budisti</th>\n
                  <th>Neizjašnjeni</th>\n
                  <th>Ostalo</th>\n
                  <th>Ukupno</th>\n";
                    if($result1){ 
                       while($row = mysqli_fetch_assoc($result1)){
                        print "<tr>\n";
                        foreach ($row as $item) {
                            print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                        }
                        print "</tr>\n";
                    }
                }
                  print "</table>\n";
                  

                  
              $result1 = mysqli_query($conn, $sql);
              print "<p>ODNOS BROJA STANOVNIKA U PROCENTIMA PO VJERSKOM OPREDJELJENJU PO OPŠTINAMA </p>\n
              <table border='1' class = 'blueTable'>\n
              <th>Opština</th>\n
              <th>Pravoslavci</th>\n
              <th>Katolici</th>\n
              <th>Muslimani</th>\n
              <th>Adventisti</th>\n
              <th>Agnostici</th>\n
              <th>Budisti</th>\n
              <th>Neizjašnjeni</th>\n
              <th>Ostalo</th>\n;
              <th>Ukupno</th>\n";
              if($result1){
                while($row = mysqli_fetch_assoc($result1)){
    
                print "
                    <tr>\n
                    <td> " .$row['Grad']  ."</td>\n
                    <td>". round($row['Pravoslavci']*100/$row['ukupno']) . "%</td>\n
                    <td>\n". round($row['Katolici']*100/$row['ukupno']) . "%</td>\n
                    <td>\n". round($row['Muslimani']*100/$row['ukupno']) . "%</td>\n
                    <td>\n". round($row['Adventisti']*100/$row['ukupno']) . "%</td>\n
                    <td>\n". round($row['Agnostici']*100/$row['ukupno']) . "%</td>\n
                    <td>\n". round($row['Budisti']*100/$row['ukupno']) . "%</td>\n
                    <td>\n". round($row['neizjašnjeni']*100/$row['ukupno']) . "%</td>\n
                    <td>\n".$row['ostalo']*100/$row['ukupno'] . "%</td>\n
                    <td>\n" . $row['ukupno'] . " </td>\n
                    </tr>\n";
                }
            }
              
             print "</table>\n";
  
  
              mysqli_close($conn);
            }
            function zap(){
                global $name_citz, $name_dom;
              $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
              $sql = "SELECT 
              {$name_dom}.opstina as Grad,
              COUNT(CASE WHEN Posao ='Da' then 1 ELSE NULL END) as zaposlen,
              COUNT(CASE WHEN Posao ='Ne' then 1 ELSE NULL END) as nezaposlen
              FROM {$name_citz} 
              JOIN {$name_dom} ON 
              {$name_citz}.id_dom = {$name_dom}.id_dom
              GROUP by Grad;
              ";
                  $result1 = mysqli_query($conn, $sql);
                      print "<p>STANOVNIŠTVO PREMA ZAPOSLJENJU PO OPŠTINAMA</p>\n
                      <table border='1' class = 'blueTable'>\n";
                      if($result1){
                            while($row = mysqli_fetch_assoc($result1)){
                            print "<tr>\n";
                            foreach ($row as $item) {
                                print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                            }
                            print "</tr>\n";
                        }}
                      print "</table>\n";
                      
                      mysqli_close($conn);
        
                } 
                function brak(){
                    global $name_citz, $name_dom;
                  $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
                  $sql = "SELECT 
                  {$name_dom}.opstina as Grad,
                  COUNT(CASE WHEN Brak ='da' then 1 ELSE NULL END) as zauzet,
                  COUNT(CASE WHEN Brak ='ne' then 1 ELSE NULL END) as slobodan
                  FROM {$name_citz} 
                  JOIN {$name_dom} ON 
                  {$name_citz}.id_dom = {$name_dom}.id_dom
                  GROUP by Grad;
                  ";
                      $result1 = mysqli_query($conn, $sql);
                          print "<p>STANOVNIŠTVO PREMA BRAČNOM STATUSU PO OPŠTINAMA</p>\n
                          <table border='1' class = 'blueTable'>\n
                          <th>Opština</th> \n;
                          <th>Broj stanovnika u bračnoj zajednici</th>\n;
                          <th>Broj stanovnika u van bračne zajednici</th>\n";
                          if($result1){
                                while($row = mysqli_fetch_assoc($result1)){
                                print "<tr>\n";
                                foreach ($row as $item) {
                                    print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                                }
                                print "</tr>\n";
                            }
                        }
                          print "</table>\n";
                          
                          mysqli_close($conn);
            
                    } 
    function broj(){
        global $name_citz, $name_dom;
      $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
      $sql = "SELECT 
      {$name_dom}.opstina as Grad,
      COUNT(*) as broj
      FROM {$name_citz} 
      JOIN {$name_dom} ON 
      {$name_citz}.id_dom = {$name_dom}.id_dom
      GROUP by Grad;
      ";
      
      $sqlu = "SELECT 
      COUNT(*) as crnagorabroj
      FROM {$name_citz} ";
          $result2 = mysqli_query($conn, $sqlu);
              print "<p>BROJ STANOVNIKA PO OPŠTINAMA</p>\n
              <table border='1' class = 'blueTable'> \n
              <th>Opština</th> \n
              <th>Ukupan broj stanovnika</th>\n
              <th>%</th>";
                if($result2){ 
                $row2 = mysqli_fetch_assoc($result2);
                $result1 = mysqli_query($conn, $sql);
                if($result1){
                        while($row = mysqli_fetch_assoc($result1)){
                        print "<tr>\n
                        <td>" . $row['Grad'] . "</td>\n
                        <td>" . $row['broj'] ."</td>\n";
                            print "
                        <td>" . $row['broj']*100/$row2['crnagorabroj'] ."%</td>\n
                        </tr>\n";
                        
                    }}}
              print "</table>\n";
              
              mysqli_close($conn);
    }
    
    function zarada(){
        global $name_citz, $name_dom;
        $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
        $sql = "SELECT 
        {$name_dom}.opstina as Grad, 
        AVG({$name_dom}.zarada) as Zarada ,
        AVG({$name_dom}.br_ukucana) as br_ukucana       
        FROM {$name_dom}
        GROUP by Grad;";
            $result1 = mysqli_query($conn, $sql);
                print "<p>ZARADA I BROJ ČLANOVA PROSJEČNOG DOMAĆINSTVA PO OPŠTINAMA</p>\n
                <table border='1' class = 'blueTable'>\n
                 <th>Opština</th> \n
                 <th>Zarada prosječnog domaćinstva</th> \n
                 <th>Broj članova prosječnog domaćinstva</th>\n";
                 if($result1){
                        while($row = mysqli_fetch_assoc($result1)){
                        print "
                        <tr>\n
                        <td>" . $row['Grad']. "</td>\n
                            <td>" . $row['Zarada'] . "</td>\n
                            <td>" . round($row['br_ukucana']) . "</td>\n
                            </tr>\n";
                    }}

           
                print "</table>\n";
                mysqli_close($conn);
} 
    function tip(){
        global $name_citz, $name_dom;
      $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
      $sql = "SELECT 
      {$name_dom}.opstina as Grad, 
      COUNT(CASE WHEN tip_naselja ='selo' then 1 ELSE NULL END) as ruralno,
      COUNT(CASE WHEN tip_naselja ='grad' then 1 ELSE NULL END) as urbano,
      COUNT(*) as ukupno
                 
      FROM {$name_dom}
      GROUP by Grad;
      ";
          $result1 = mysqli_query($conn, $sql);
              print "<p>BROJ STANOVNIKA PO TIPU NASELJA PO OPŠTINAMA</p>\n
              <table border='1' class = 'blueTable'>\n
                 <th>Opština</th> \n
                 <th>Ruralno</th> \n
                 <th>Urbano</th>\n
                 <th>Ukupno</th>\n";
                if($result1){
                    while($row = mysqli_fetch_assoc($result1)){
                    print "<tr>\n";
                    foreach ($row as $item) {
                        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    }
                    print "</tr>\n";
                }}

              print "</table>\n";



              $result1 = mysqli_query($conn, $sql);
              print "<p>ODNOS BROJA STANOVNIKA U PROCENTIMA PO TIPU NASELJA PO OPŠTINAMA</p>\n
              <table border='1' class = 'blueTable'>\n
                 <th>Opština</th> \n
                 <th>Ruralno</th> \n
                 <th>Urbano</th>\n
                 <th>Ukupno</th>\n";
                 if($result1){
                    while($row = mysqli_fetch_assoc($result1)){
                    print "<tr>\n";
                    foreach ($row as $item) {
                        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    }
                    print "</tr>\n";
                }
            }
              print "</table>\n";
              
              mysqli_close($conn);
    }
    ?>
</body>
</html>

