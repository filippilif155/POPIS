<?php
    function mysqli_fetch_all_alt($result) {
        $select = array();
    
        while( $row = mysqli_fetch_assoc($result) ) {
            $select[] = $row;
        }
    
        return $select;
    }