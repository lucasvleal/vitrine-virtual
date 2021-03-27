<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    };

    if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('location:login.php');
    }    
?>

<!-- MENU LATERAL -->
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Principal</div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    Início
                </a>

                <div class="sb-sidenav-menu-heading">Registrar</div>
                <a class="nav-link" href="categorias.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                    Categorias
                </a>
                <a class="nav-link" href="produtos.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
                    Produtos
                </a>
                <a class="nav-link" href="administradores.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                    Administradores
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logado como:</div>
            <?php echo $_SESSION['nome'] ?>
        </div>
    </nav>
</div>
<!-- /Menu lateral -->