<?php
    require("connect.php");

    $nome = $_POST['nomeAdm'];
    $email = $_POST['emailAdm'];
    $senha = $_POST['senhaAdm'];
    $id = $_POST['idAdmin'];

    $query = "UPDATE administrador SET nome = '$nome', email = '$email', senha = '$senha' WHERE id_administrador = '$id'";
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