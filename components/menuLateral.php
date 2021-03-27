<?php
    require("model/connect.php");

    //Busca as categorias para o menu
    $query = "SELECT * FROM categoria";
    $select = mysqli_query($link, $query);
?>

<!-- MENU LATERAL -->
<div class="col-lg-3 menu-lateral">

  <h1 class="my-4 text-kaushan">Vitrine Virtual</h1>
  
  <div class="list-group list-group-flush">
    <a href="./" class="list-group-item item-categoria">Início</a>
    <?php while($categoria = mysqli_fetch_array($select)){ ?>
      <a href="#" class="list-group-item item-categoria" onclick="redirectionChangeCategoria(<?php echo $categoria['id_categoria'] ?>)"><?php echo $categoria['nome'] ?></a>
    <?php } ?>
  </div>

</div>
<!-- /.col-lg-3 MENU LATERAL -->