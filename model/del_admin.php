<?php
    require("connect.php");

    $nome = $_POST['nomeAdm'];
    $email = $_POST['emailAdm'];
    $senha = $_POST['senhaAdm'];
    $id = $_POST['idAdmin'];

    $query = "DELETE FROM administrador WHERE id_administrador = '$id'";
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