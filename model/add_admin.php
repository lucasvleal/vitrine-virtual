<?php
    require("connect.php");

    $nome = $_POST['nomeAdm'];
    $email = $_POST['emailAdm'];
    $senha = $_POST['senhaAdm'];    

    $query = "INSERT INTO administrador (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
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