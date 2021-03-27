<?php
    session_start();
    session_unset();
    session_destroy();

    session_start();
    require("connect.php");

    $email = $_POST['emailLogin'];
    $senha = $_POST['senhaLogin'];

    $sql = "SELECT * FROM administrador WHERE email ='$email'  AND senha = '$senha' ";
    
    $autenticar = mysqli_query($link, $sql);
    $total = mysqli_num_rows($autenticar); 
     
    if($total == 0){
        $response = array("success" => false);
    } else {
        $dados = mysqli_fetch_array($autenticar, MYSQLI_ASSOC);

        $_SESSION['id'] = $dados['id_administrador'];
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['nome'] = $dados['nome'];

        $response = array("success" => true);
    }
    
    //RESPOSTA
    header('Content-type: application/json');
    echo json_encode($response);
?>