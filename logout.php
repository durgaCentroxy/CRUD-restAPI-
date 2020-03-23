<?php
    session_start();
    $get_url_token = $_GET['token'];
    if($get_url_token == $_SESSION['token'])
    {
        session_destroy();
        header("location: login.html");
    }
    else
    {
        echo "error";
    }
?>