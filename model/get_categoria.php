<?php
    require("connect.php");    

    $id = $_POST['idCategoria'];
    $myArray = array();
    
    //Select das infos da categoria com o id passado
    $query = "SELECT * FROM categoria WHERE id_categoria = '$id'";
    $selectCat = mysqli_query($link,$query);
    $categoria = mysqli_fetch_array($selectCat, MYSQLI_ASSOC);

    //Select das infos dos produtos que tem o mesmo id da categoria com o id passado    
    $queryProds = "SELECT * FROM produto WHERE categoria = '$id'";
    $selectProds = mysqli_query($link,$queryProds);

    //Adiciona cada linha de um produto retornado em um array e monta a response
    if($selectCat and $selectProds){
        while($row = mysqli_fetch_array($selectProds, MYSQLI_ASSOC)) {
            $myArray[] = $row;
        }

        $response = array("success" => true, "categoria" => $categoria, "produtos" => $myArray);
    } else{        
        $response = array("success" => false);
    }    

   //Manipula o JSON em razão dos caracteres UTF-8
   $show_json = json_encode($response , JSON_UNESCAPED_UNICODE);
   if(json_last_error_msg()=="Malformed UTF-8 characters, possibly incorrectly encoded" ){
      $show_json = json_encode($response, JSON_PARTIAL_OUTPUT_ON_ERROR );
   }
   if($show_json !== false ){
      echo($show_json);
   } else {
      die("json_encode fail: " . json_last_error_msg());
   }
?>