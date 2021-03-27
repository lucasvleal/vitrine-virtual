<?php
    require("connect.php");

    $id = $_POST['idProduto'];      

    //Select das infos do produto com o id passado
    $query = "SELECT * FROM produto WHERE id_produto = '$id'";
    $select = mysqli_query($link, $query);
    $produto = mysqli_fetch_assoc($select);

    //Monta a response
    if($select){
        $response = array("success" => true, "produto" => $produto);
    } else {        
        $response = array("success" => false);
    }

    //RESPOSTA
    header('Content-type: application/json');
    echo json_encode($response);
?>