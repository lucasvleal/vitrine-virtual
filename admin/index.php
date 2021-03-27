<?php
    //Verifica se está logado, caso não redireciona para a pagina de login
    if(!isset($_SESSION)){ 
        session_start(); 
    };

    if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('location:login.php');
    }

    require("../model/connect.php");

    //Busca as categorias para a tabela principal
    $query = "SELECT * FROM categoria";
    $select = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Vitrine Virtual</title>

        <!-- Custom fonts for this template -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
        
        <!-- Custom CSS -->
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="../css/myStyles.css" rel="stylesheet" />
        <link href="../css/geral.css" rel="stylesheet" />

        <!-- CSS importado -->
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    </head>

    <body class="sb-nav-fixed">
        <?php include '../components/admin/header.php' ?>

        <div id="layoutSidenav">
            <?php include '../components/admin/menuLateral.php' ?>

            <!-- CONTEUDO -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Início</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Início</li>
                        </ol>
                        
                        <!-- TABELA CATEGORIAS -->
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-th-list mr-1"></i>Categorias</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="categoriasTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                                <th>Ação</th>
                                            </tr>
                                        </tfoot>

                                        <tbody>
                                            <?php while($categoria = mysqli_fetch_array($select)){ ?>
                                            <tr>
                                                <td><?php echo $categoria['nome'] ?></td>
                                                <td><?php echo $categoria['descricao'] ?></td>
                                                <td></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /TABELA CATEGORIAS -->
                    </div>
                </main>
                
                <?php include '../components/admin/footer.php' ?>
            </div>
            <!-- /Conteudo -->
        </div>

        <!-- JS importado -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        
        <!-- Custom JS -->
        <script src="../js/scripts.js"></script>
        <script src="../js/geral.js"></script>
        
        <!-- JS importado -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/datatables-demo.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json" crossorigin="anonymous"></script>
        
    </body>
</html>