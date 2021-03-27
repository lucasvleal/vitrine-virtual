<?php
    require("connect.php");

    $nome = $_POST['nomeCategoria'];
    $descricao = $_POST['descCategoria'];

    if($descricao == "" || $descricao == null){
        $descricao = "Sem descrição.";
    }

    $query = "INSERT INTO categoria (nome, descricao) VALUES ('$nome', '$descricao')";
    $insert = mysqli_query($link,$query);
    if($insert){
        $response = array("success" => true);
    } else{        
        $response = array("success" => false);
    }
    
    //RESPOSTA
    header('Content-type: application/json');
    echo json_encode($response);
?>