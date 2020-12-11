<?php

    function systemMSG($state, $msg) {
        if ($state == 'info'){
            echo '<div class="info"><span>INFO | '. $msg .'</span></div>';
        } elseif ($state == 'warning') {
            echo '<div class="warning"><span>WARNING | '. $msg .'</span></div>';
        } elseif ($state == 'success') {
            echo '<div class="success"><span>SUCCESS | '. $msg .'</span></div>';
        } elseif ($state == 'error') {
            echo '<div class="error"><span>ERROR | '. $msg .'</span></div>';
        }
    }

?>