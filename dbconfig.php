<?php
    
    $conn = mysqli_connect('localhost','root','','music_portal');
    if(!$conn){
        die('Connection Failed!' . mysqli_connect_error());
        exit();
    }
    

?>