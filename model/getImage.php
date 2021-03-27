<?php
    require("connect.php");
    
    $produto = $_GET['id_produto'];
    $query = "SELECT imagem, tipo, tamanho FROM imagem_produto WHERE id_produto = '$produto'";
    $resultado = mysqli_query($link, $query);
    $imagem = mysqli_fetch_array($resultado,MYSQLI_ASSOC);
    

    if($imagem['tipo'] != null) header("Content-type: " . $imagem['tipo']);
    else header("Content-type: image/jpeg");
    echo $imagem['imagem'];
?>