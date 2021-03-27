<?php
    require("connect.php");

    $nome = $_POST['nomeCategoria'];
    $descricao = $_POST['descCategoria'];
    $id = $_POST['idCategoria'];

    if($descricao == "" || $descricao == null){
        $descricao = "Sem descrição.";
    }

    $query = "DELETE FROM categoria WHERE id_categoria = '$id'";
    $delete = mysqli_query($link,$query);

    if($delete){
        $response = array("success" => true);
    } else{        
        $response = array("success" => false);
    }
    
    //RESPOSTA
    header('Content-type: application/json');
    echo json_encode($response);
?>