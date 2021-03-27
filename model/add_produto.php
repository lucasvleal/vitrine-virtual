<?php
    require("connect.php");

    $nome = $_POST['nomeProduto'];
    $descricao = $_POST['descProduto'];

    $promocao = $_POST['radioPromocao'];
    $getPANTIGO = $_POST['precoAntigoProduto'];
    $getPATUAL = $_POST['precoAtualProduto'];
    $preco_atual = floatval(preg_replace("/[^-0-9\.]/","", $getPATUAL));

    $img = $_FILES['imgProduto']['tmp_name'];
    $tamanho = $_FILES['imgProduto']['size'];
    $tipo = $_FILES['imgProduto']['type'];

    $categoria = $_POST['categoriaProduto'];

    $id = uniqid();

    // print_r($nome, $descricao, $promocao, $preco_antigo, $preco_atual, $categoria);

    if ( $img != "none" ) {
        $fp = fopen($img, "rb");
        $conteudo_img = fread($fp, $tamanho);
        $conteudo_img = addslashes($conteudo_img);
        fclose($fp);
    }

    if($promocao == "sim") {
        $promocao = true;
    } else if($promocao == "nao") {
        $promocao = false;
    }

    if($getPANTIGO !== "" || $getPANTIGO !== null){
        $preco_antigo = floatval(preg_replace("/[^-0-9\.]/","", $getPANTIGO));
    } else {
        $preco_antigo = 0.0;
    }

    if($descricao == "" || $descricao == null){
        $descricao = "Sem descrição.";
    }

    $query = "INSERT INTO produto (id_produto, nome, descricao, promocao, preco_antigo, preco_atual, categoria) VALUES ('$id', '$nome', '$descricao', '$promocao', '$preco_antigo', '$preco_atual', '$categoria')";
    $insert = mysqli_query($link, $query);

    $queryImage = "INSERT INTO imagem_produto (id_produto, imagem, tamanho, tipo) VALUES ('$id', '$conteudo_img','$tamanho','$tipo')";
    $insertImage = mysqli_query($link, $queryImage);

    if($insert and $insertImage){
        $response = array("success" => true);
    } else {
        if(!$insert) {
            $response = array("success" => false);            
        } else {
            $response = array("success" => 3);
        }
    }

    //RESPOSTA
    header('Content-type: application/json');
    echo json_encode($response);
?>