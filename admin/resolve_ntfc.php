<?php
    $_POST['request'] = "INDIVIDUALNO";
    $_POST['jmbg'] = "1231231231231";
    if(isset($_POST['request'])){
        $conn = mysqli_connect('localhost', 'root', '', 'baza_popis');
        if ($conn) {
            $sql = "SELECT * FROM popisi WHERE status=1";
            $result = mysqli_query($conn, $sql);
            $popis = mysqli_fetch_row($result);
            if($popis){
                $jmbg = $_POST['jmbg'];
                $request = $_POST['request'];
                if($request === "INDIVIDUALNO"){
                    $name = $popis[0]."_rezultati";
                    $sql = "DELETE FROM {$name} WHERE jmbg='{$jmbg}'";
                    if(mysqli_query($conn, $sql)){ 
                        $name = $popis[0]."_gradjani";
                        $sql = "UPDATE {$name} SET status_popisa=NULL WHERE jmbg='{$jmbg}'";
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
                    $id_dom = mysqli_query($conn, $sql);
                    $id_dom = mysqli_fetch_row($id_dom);
                    $id_dom = $id_dom[0];
                    if($id_dom){
                        $name = $popis[0]."_rezultati";
                        $sql = "DELETE FROM {$name} WHERE id_dom='{$id_dom}'";
                        if(mysqli_query($conn, $sql)){
                            $name = $popis[0]."_gradjani";
                            $sql = "UPDATE {$name} SET status_popisa=NULL WHERE id_dom='{$id_dom}'";
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