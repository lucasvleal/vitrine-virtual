<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Produto</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/geral.css" rel="stylesheet">
  <link href="css/shop-item.css" rel="stylesheet">

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom JavaScript -->
  <script src="./js/geral.js"></script>

  <script>
    var id = queryString("id");
    var image = `model/getImage.php?id_produto=${id}`;

    $.ajax({
        method: "POST",
        url: "model/get_produto.php",
        async: true,
        data: `idProduto=${id}`
    })
    .done(function(resp){
        const response = resp;
        
        if(response.success) {
           console.log(response.produto);
           var produto = response.produto;
           
           document.title = produto.nome;
           $('.title-produto').text(produto.nome);
           $('.preco-atual').text(`R$${produto.preco_atual}`);
           $('.preco-antigo').text(`R$${produto.preco_antigo}`);
           $('.description-produto').text(produto.descricao);
           $('.card-img-top').attr("src", image);

           if(produto.promocao == "1"){
             $('.promocao-antigo').css("display", "inline");
             $('.normal-preco-box').css("display", "none");
           } else {
              $('.promocao-box').css("display", "none");
           }

        } else {
            alert(`Ocorreu um erro ao carregar o produto. \n\n Por favor, tente novamente mais tarde.`);
            console.log("Erro ao carregar o produto.");
        }
    })
    .fail(function(jqXHR, textStatus, msg){
      // alert(`Ocorreu um erro ao ${action}r ${title}. Tente novamente mais tarde`);
      console.log(`Ocorreu um erro ao carregar o produto. Tente novamente mais tarde`);
      console.log(msg);
    });
  </script>  
</head>

<body>
  <?php include './components/header.php' ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">
      <?php include './components/menuLateral.php'; ?>

      <!-- CONTAINER PRODUTO -->
      <div class="col-lg-9">

        <div class="card mt-4 ">
          <img class="card-img-top img-fluid" src="#" alt="Imagem produto">
          <div class="card-body">
            <div id="title-box-produto" class="row padding-certo-esq" data-toggle="modal" data-target="#exampleModalCenter">
              <h3 class="card-title title-produto"></h3>
              <a href="#" class="btn-contato">ENTRE EM CONTATO</a>
            </div> 
            <!-- se o produto estiver em promoção -->
            <div class="row promocao-box">
              <h5 class="text-roboto-slab preco-atual promocao-atual">R$ 0.00</h5>
              <span class="text-roboto-slab preco-antigo promocao-antigo">R$ 0.00</span>               
            </div>

            <!-- se não estiver  -->
            <div class="normal-preco-box">
              <h5 class="text-roboto-slab preco-atual">R$ 0.00</h5>
            </div>      
            <p class="card-text text-muted description-produto">Descrição</p>
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 CONTAINER PRODUTO -->

    </div>

  </div>
  <!-- /.container -->
 
  <?php include './components/footer.php' ?>
  <?php include './components/modalContato.php' ?>

</body>

</html>
