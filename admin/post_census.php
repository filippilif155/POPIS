<?php 
    session_start();
    require '../config/config.php';
    if(isset($_POST['date'])){
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($conn){
            $name = stripcslashes($_POST['census-name']);
            $date = stripcslashes($_POST['date']);
            $name = mysqli_real_escape_string($conn, $name);
            $date = mysqli_real_escape_string($conn, $date);
            $sql = "SELECT * FROM popisi WHERE ime_popisa='$name'";
            
            $result = mysqli_query($conn, $sql);
            $sql = "SELECT * FROM popisi WHERE status=1";
            $result_status = mysqli_query($conn, $sql);
            if(mysqli_fetch_row($result)){
                $_SESSION['post_response'] = 2;
            }elseif(mysqli_fetch_row($result_status)){
                $_SESSION['post_response'] = 3;
            } 
            else{
                $sql = "INSERT INTO `popisi` (`ime_popisa`, `status`, `rok`) VALUES ('$name','1','$date')";    
                if(mysqli_query($conn, $sql)){    
                    $dom_name = $name."_domacinstvo";
                    $sql = "CREATE TABLE {$dom_name} (id_dom int(11) AUTO_INCREMENT PRIMARY KEY, br_ukucana int(2), opstina varchar(20), naselje varchar(30), tip_naselja varchar(4), tip_kuce varchar(4), zarada int(11))";    
                    if(mysqli_query($conn, $sql)){

                        $citz_name = $name."_gradjani"; 
                        $sql = "CREATE TABLE {$citz_name} AS (SELECT * FROM gradjani)";    
                        
                        if(mysqli_query($conn, $sql)){  
                            
                            $sql = "ALTER TABLE `{$citz_name}` ADD `id_dom` int(11), ADD INDEX (`id_dom`)";   
                            if(mysqli_query($conn, $sql)){ 
                                $sql = "ALTER TABLE `{$citz_name}` ADD FOREIGN KEY (`id_dom`) REFERENCES `{$dom_name}`(`id_dom`) ON DELETE RESTRICT ON UPDATE RESTRICT;";    
                                if(mysqli_query($conn, $sql)){   
                                    $sql = "ALTER TABLE {$citz_name} ADD status int(1)";    
                                    if(mysqli_query($conn, $sql)){    
                                        $res_name = $name."_rezultati";
                                        $sql = "CREATE TABLE {$res_name} (jmbg varchar(13) PRIMARY KEY, godiste varchar(4), pol varchar(6), nacija varchar(20), jezik varchar(30), vjera varchar(30), posao varchar(2), brak varchar(2), id_dom int(11))";
                                        if(mysqli_query($conn, $sql)){    
                                            $sql = "ALTER TABLE `{$res_name}` ADD FOREIGN KEY (`id_dom`) REFERENCES `{$dom_name}`(`id_dom`) ON DELETE RESTRICT ON UPDATE RESTRICT;";
                                            if(mysqli_query($conn, $sql)){        
                                                $ntfc_name = $name."_obavjestenja";             
                                                $sql = "CREATE TABLE {$ntfc_name} (jmbg varchar(13) PRIMARY KEY, ime varchar(30), prezime varchar(30), kontakt varchar(30), tip_zahtjeva varchar(30), tekst_zahtjeva varchar(300))";
                                                if(mysqli_query($conn, $sql)){
                                                    //pass
                                                }else{
                                                    $_SESSION['post_response'] = 4;
                                                }
                                            }else{
                                                $_SESSION['post_response'] = 4;
                                            }
                                        }else{
                                            $_SESSION['post_response'] = 4;
                                        }
                                    }else{
                                        $_SESSION['post_response'] = 4;
                                    }
                                }else{
                                    $_SESSION['post_response'] = 4;
                                }
                            }else{
                                $_SESSION['post_response'] = 4;                             
                            }
                        }else{
                            $_SESSION['post_response'] = 4;                             
                        }

                    }else{
                        $_SESSION['post_response'] = 4;                             
                    }
                }else{
                    $_SESSION['post_response'] = 4;                             
                }

                
                
                

                $_SESSION['post_response'] = 1;         
            }
        }else{
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    mysqli_close($conn);
    header('Location: admin.php');

?>