<?php
    $link = mysqli_connect("localhost", "root", "", "vitrine_virtual");
    
    if(!$link)
    {
     die('Não conectado : ' . mysqli_error($link));
    }
?>