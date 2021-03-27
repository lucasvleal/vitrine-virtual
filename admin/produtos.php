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

    //Busca as categorias para o select do cadastro
    $query = "SELECT * FROM categoria";
    $select = mysqli_query($link, $query);

    //Busca os produtos para a tabela
    $queryProd = "SELECT * FROM produto";
    $selectProd = mysqli_query($link, $queryProd);
    // print_r($select);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Produtos</title>

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
                        <h1 class="mt-4">Produtos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a class="link-breadcrumb" href="index.php">Início</a></li>
                            <li class="breadcrumb-item active">Produtos</li>
                        </ol>

                        <div class="row justify-content-center align-items-center mb-4">
                            <p class="text-muted">
                                Pesquise e/ou registre os produtos que deverão aparecer na vitrine virtual.
                            </p>                            
                        </div>
                        
                        <!-- AREA DE REGISTRO -->
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-plus mr-1"></i>Registrar produto</div>
                            <div class="card-body">
                                <form id="produto" enctype="multipart/form-data" method="POST" action="" class="">
                                    <!-- linha: Nome / Categoria -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label class="label-title" for="inputNome">Nome</label>
                                          <input type="text" class="form-control" name="nomeProduto" id="inputNome" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                          <label class="label-title" for="inputCategoria">Categoria</label>
                                          <select id="inputCategoria" class="form-control" name="categoriaProduto" required>
                                            <option disabled>Escolha...</option>
                                            <?php while($categoria = mysqli_fetch_array($select)){ ?>
                                                <option value="<?php echo $categoria['id_categoria']?>"><?php echo $categoria['nome'] ?></option>
                                            <?php } ?>
                                          </select>
                                        </div>
                                    </div>

                                    <!-- linha: Descrição / Resto -->
                                    <div class="form-row">
                                        <!-- Descrição -->
                                        <div class="form-group col-md-6">
                                            <label class="label-title" for="inputDescricao">Descrição</label>
                                            <textarea rows="4" type="text" name="descProduto" class="form-control mb-4" id="inputDescricao"></textarea>
                                        </div>

                                        <!-- Resto -->
                                        <div class="form-group col-md-6">
                                            <label class="label-title" for="inputImagem">Imagem</label>
                                            <input type="file" class="form-control mb-4" name="imgProduto" id="inputImagem">

                                            <!-- linha: Promoção / Preço Atual / Preço Antigo -->
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label class="label-title" for="inputAddress">Promoção?</label>

                                                    <div class="form-check form-check-inline">
                                                        <input required class="form-check-input" type="radio" name="radioPromocao" id="radioPromocao1" value="sim" >
                                                        <label class="form-check-label label-radio" for="radioPromocao1">
                                                          Sim
                                                        </label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input checked required  class="form-check-input" type="radio" name="radioPromocao" id="radioPromocao2" value="nao">
                                                        <label class="form-check-label label-radio" for="radioPromocao2">
                                                          Não
                                                        </label>
                                                     </div>
                                                </div>

                                                <div class="form-group col-md-5">
                                                    <label class="label-title" for="inputPrecoAtual">Preço atual</label>
                                                    <input required type="text" name="precoAtualProduto" class="form-control" id="inputPrecoAtual" placeholder="R$">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label class="label-title" for="inputPrecoAntigo">Preço antigo</label>
                                                    <input type="text" name="precoAntigoProduto" class="form-control" id="inputPrecoAntigo" placeholder="R$">
                                                </div>
                                            </div>
                                        </div>                                            
                                    </div>

                                    <button id="btnCadProduto" type="button" class="btn btn-add btn-registro width-full">REGISTRAR</button>
                                    <button id="btnDelProduto" type="button" class="btn btn-del btn-registro width-full">DELETAR</button>
                                    <button id="btnEditProduto" type="button" class="btn btn-edit btn-registro width-full">EDITAR</button>
                                </form>
                            </div>
                        </div>
                        <!-- /AREA DE REGISTRO -->

                        <!-- TABELA CATEGORIAS -->
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-cart-plus mr-1"></i>Produtos </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="produtosTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                                <th>Categoria</th>
                                                <th>Promoção</th>
                                                <th>Preço Atual</th>
                                                <th>Preço Antigo</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                                <th>Categoria</th>
                                                <th>Promoção</th>
                                                <th>Preço Atual</th>
                                                <th>Preço Antigo</th>
                                                <th>Ação</th>
                                            </tr>
                                        </tfoot>

                                        <tbody>
                                            <?php while($produto = mysqli_fetch_array($selectProd)){ ?>
                                            <tr>
                                                <td><?php echo $produto['id_produto'] ?></td>
                                                <td><?php echo $produto['nome'] ?></td>
                                                <td><?php echo $produto['descricao'] ?></td>
                                                <td><?php echo $produto['categoria'] ?></td>
                                                <td><?php echo $produto['promocao'] ?></td>
                                                <td>R$<?php echo $produto['preco_atual'] ?></td>
                                                <td>R$<?php echo $produto['preco_antigo'] ?></td>
                                                <td></td>
                                            </tr>
                                            <?php } ?>
                                            <!-- <tr>
                                                <td>Prato muito doido</td>
                                                <td>Lorem Ipsum</td>
                                                <td>Pratos</td>
                                                <td>Não</td>
                                                <td>25.00</td>
                                                <td>0.00</td>
                                            </tr>
                                            <tr>
                                                <td>Copo muito doido</td>
                                                <td>Lorem Ipsum</td>
                                                <td>Copos</td>
                                                <td>Não</td>
                                                <td>55.00</td>
                                                <td>0.00</td>
                                            </tr>
                                            <tr>
                                                <td>Caneca muito doido</td>
                                                <td>Lorem Ipsum</td>
                                                <td>Canecas</td>
                                                <td>Sim</td>
                                                <td>35.00</td>
                                                <td>40.00</td>
                                            </tr>
                                            <tr>
                                                <td>Talher muito doido</td>
                                                <td>Lorem Ipsum</td>
                                                <td>Talhers</td>
                                                <td>Não</td>
                                                <td>10.00</td>
                                                <td>0.00</td>
                                            </tr>
                                            <tr>
                                                <td>Secadora muito doido</td>
                                                <td>Lorem Ipsum</td>
                                                <td>Seca Louças</td>
                                                <td>Sim</td>
                                                <td>125.00</td>
                                                <td>250.00</td>
                                            </tr> -->
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
            <!-- /CONTEUDO -->
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="../js/geral.js"></script>
        <script src="../js/ajax.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/datatables-demo.js"></script>

    </body>
</html>