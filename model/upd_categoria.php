<?php
    require("connect.php");

    $nome = $_POST['nomeCategoria'];
    $descricao = $_POST['descCategoria'];
    $id = $_POST['idCategoria'];

    if($descricao == "" || $descricao == null){
        $descricao = "Sem descrição.";
    }

    $query = "UPDATE categoria SET nome = '$nome', descricao = '$descricao' WHERE id_categoria = '$id'";
    $update = mysqli_query($link,$query);

    if($update){
        $response = array("success" => true);
    } else{        
        $response = array("success" => false);
    }
    
    //RESPOSTA
    header('Content-type: application/json');
    echo json_encode($response);
?>