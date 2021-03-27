<?php
    require("connect.php");

    $nome = $_POST['nomeProduto'];
    $descricao = $_POST['descProduto'];
    $categoria = $_POST['categoriaProduto'];
    $id = $_POST['idProduto'];

    if($descricao == "" || $descricao == null){
        $descricao = "Sem descrição.";
    }    

    $queryDelete = "DELETE FROM produto WHERE id_produto = '$id'";
    $delete = mysqli_query($link, $queryDelete);

    $queryDeleteImage = "DELETE FROM imagem_produto WHERE id_produto = '$id'";
    $deleteImage = mysqli_query($link, $queryDeleteImage);

    if($delete and $deleteImage){
        $response = array("success" => true);
    } else {
        if(!$delete) {
            $response = array("success" => false);          
        } else {
            $response = array("success" => 3);
        }
    }

    //RESPOSTA
    header('Content-type: application/json');
    echo json_encode($response);
?>