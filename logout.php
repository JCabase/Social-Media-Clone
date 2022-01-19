<?php
session_start();
        session_destroy();
        unset($_SESSION['displayname']);
        unset($_SESSION['senduserID']);
        header('location: index.php');
    
    ?>