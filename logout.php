<?php

    session_start();

    unset($_SESSION['current_user']);

    header('location: index.php');

?>