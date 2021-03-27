<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Vitrine Virtual</title>

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
  <link href="css/shop-homepage.css" rel="stylesheet">

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom JavaScript -->
  <script src="./js/geral.js"></script>

  <script>
    var loc = location.search.substring(1, location.search.length);

    if  (loc != "") {
      const id = queryString("idCategoria");
      changeCategoria(id);
    }
  </script>
</head>

<body>  
  <?php include './components/header.php'; ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">
      <?php include './components/menuLateral.php'; ?>

      <!-- CONTAINER PRODUTOS -->
      <div class="col-lg-9 my-4">         

        <div class="description-area">
          <h3 class="title-categoria">Página Inicial</h3>
          <p class="text-muted description-categoria">
            Seja bem vindo(a) à nossa vitrine virtual.
            <br />
            Escolha uma categoria ao lado para verificar nossos os produtos.
          </p>
        </div>

        <div id="box-produtos" class="row">
          
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 CONTAINER PRODUTOS -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container --> 

  <?php include './components/footer.php' ?>
  <?php include './components/modalContato.php' ?>
</body>

</html>
