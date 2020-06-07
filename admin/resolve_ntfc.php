<?php

    require '../config/config.php';
    if(isset($_POST['request'])){
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn) {
            $sql = "SELECT * FROM popisi WHERE status=1";
            if( mysqli_query($conn, $sql)){
                $popis = mysqli_fetch_row(mysqli_query($conn, $sql));
                $jmbg = $_POST['jmbg'];
                $request = $_POST['request'];
                if($request === "INDIVIDUALNO"){
                    $name = $popis[0]."_rezultati";
                    $sql = "DELETE FROM {$name} WHERE jmbg='{$jmbg}'";
                    if(mysqli_query($conn, $sql)){ 
                        $name = $popis[0]."_gradjani";
                        $sql = "UPDATE {$name} SET `status`=NULL WHERE jmbg='{$jmbg}'";
                        if(mysqli_query($conn, $sql)){
                            $name = $popis[0]."_obavjestenja";
                            $sql = "DELETE FROM {$name} WHERE jmbg='{$jmbg}'";
                            if(mysqli_query($conn, $sql)){
                                echo "1";
                            } else{
                                echo "0";
                            }
                        }else{
                            echo "0";
                        }
                    }else{
                        echo "0";
                    }
                }else{
                    $name = $popis[0]."_gradjani";
                    $sql = "SELECT id_dom FROM `{$name}` WHERE jmbg='{$jmbg}'";
                    if(mysqli_query($conn, $sql)){  
                        $id_dom = mysqli_fetch_row(mysqli_query($conn, $sql));
                        $id_dom = $id_dom[0];
                        $name = $popis[0]."_rezultati";
                        $sql = "DELETE FROM {$name} WHERE id_dom='{$id_dom}'";
                        if(mysqli_query($conn, $sql)){
                            $name = $popis[0]."_gradjani";
                            $sql = "UPDATE {$name} SET status=NULL WHERE id_dom='{$id_dom}'";
                            if(mysqli_query($conn, $sql)){
                                $sql = "UPDATE {$name} SET id_dom=NULL WHERE id_dom='{$id_dom}'";
                                if(mysqli_query($conn, $sql)){
                                    $name = $popis[0]."_domacinstvo";
                                    $sql = "DELETE FROM {$name} WHERE id_dom='{$id_dom}'";
                                    if(mysqli_query($conn, $sql)){
                                        $name = $popis[0]."_obavjestenja";
                                        $sql = "DELETE FROM {$name} WHERE jmbg='{$jmbg}'";
                                        if(mysqli_query($conn, $sql)){
                                            echo "1";
                                        } else{
                                            echo "0";
                                        }
                                    }else{
                                        echo "0";
                                    }   
                                }else{
                                    echo "0";
                                }
                            }else{
                                echo "0";
                            } 
                        }else{
                            echo "0";
                        }             
                    }else{
                        echo "0";
                    }
                    
                }             
            }else{
                echo "0";
            }
        }else{
            echo "0";
        }
    mysqli_close($conn);
    }  
?>