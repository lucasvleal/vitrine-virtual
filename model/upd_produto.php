<?php
    require("connect.php");

    $nome = $_POST['nomeProduto'];
    $descricao = $_POST['descProduto'];
    $id = $_POST['idProduto'];
    $categoria = $_POST['categoriaProduto'];

    $promocao = $_POST['radioPromocao'];
    $getPANTIGO = $_POST['precoAntigoProduto'];
    $getPATUAL = $_POST['precoAtualProduto'];
    $preco_atual = floatval(preg_replace("/[^-0-9\.]/","", $getPATUAL));

    if(!empty($_FILES['imgProduto']['tmp_name'])){
        $img = $_FILES['imgProduto']['tmp_name'];
        $tamanho = $_FILES['imgProduto']['size'];
        $tipo = $_FILES['imgProduto']['type'];

        if ( $img != "none" ) {
            $fp = fopen($img, "rb");
            $conteudo_img = fread($fp, $tamanho);
            $conteudo_img = addslashes($conteudo_img);
            fclose($fp);
        }

        $queryEditImage = "UPDATE imagem_produto SET tamanho = '$tamanho', tipo = '$tipo', imagem = '$conteudo_img' WHERE id_produto = '$id'";
        $editImage = mysqli_query($link, $queryEditImage);
    }


    $editImage = true;    

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

    $queryEdit = "UPDATE produto SET nome = '$nome', descricao = '$descricao', categoria = '$categoria', promocao = '$promocao', preco_antigo = '$preco_antigo', preco_atual = '$preco_atual' WHERE id_produto = '$id'";
    $edit = mysqli_query($link, $queryEdit);

    

    if($edit and $editImage){
        $response = array("success" => true);
    } else {
        if(!$edit) {
            $response = array("success" => false);          
        } else {
            $response = array("success" => 3);
        }
    }

    //RESPOSTA
    header('Content-type: application/json');
    echo json_encode($response);
?>