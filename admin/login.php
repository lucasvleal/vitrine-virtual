<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    };

    if((!isset ($_SESSION['email']) !== true) and (!isset ($_SESSION['senha']) !== true))
    {       
        header('location:index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login | Vitrine Virtual</title>

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
    </head>

    <body class="">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h1 class="text-center text-uppercase title-login font-weight-bold my-4">
                                            Login
                                        </h1>
                                    </div>

                                    <div class="card-body">
                                        <form id="login" method="POST" action="">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailLogin">Email</label>
                                                <input name="emailLogin" class="form-control py-4" id="inputEmailLogin" type="email" placeholder="Digite seu email cadastrado" required/>
                                            </div>

                                            <div class="form-group">
                                                <label class="small mb-1" for="inputSenhaLogin">Senha</label>
                                                <input name="senhaLogin" class="form-control py-4" id="inputSenhaLogin" type="password" placeholder="Digite sua senha cadastrada" required/>
                                            </div>
                                            
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small esqueceuSenha" href="#" data-toggle="modal" data-target="#modalEsqueceu">Esqueceu a senha?</a>
                                                <button id="btnLogin" type="button" class="btn btn-registro" >Login</a>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="card-footer text-center box-pedirCadastro">
                                        <div class="small "><a class="text-pedirCadastro" data-toggle="modal" data-target="#modalCadastro" href="#">Nâo tem cadastro?</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            <div id="layoutAuthentication_footer">
                <footer class="py-4 footer-login shadow-lg mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-center small">
                            <div class=""><strong>Copyright &copy; Vitrine Virtual 2020</strong></div>                            
                        </div>
                    </div>
                </footer>
            </div>
        </div>
  
        <!-- Modal Esqueceu -->
        <div class="modal fade" id="modalEsqueceu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Esqueceu sua senha?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row justify-content-start align-items-center">
                        <div class="col-md-12">
                            <h3 class="title-modal-contato">Entre em contato com um administrador para recuperá-la:</h3>

                            <div class="row modal-info-box justify-content-star align-items-center">
                                <i class="far fa-envelope icon-modal"></i>
                                <a href="mailto:contato@gmail.com" class="mail-to">
                                    <span class="text-info-modal">contato@gmail.com</span> 
                                </a>          
                            </div>
                    
                            <div class="row modal-info-box justify-content-start align-items-center">
                                <i class="fas fa-phone-alt icon-modal"></i>
                                <a href="tel:5518999999999" class="mail-to">
                                    <span class="text-info-modal">+55 18 99999-9999</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-modal" data-dismiss="modal">FECHAR</button>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal Cadastro -->
        <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Precisa se cadastrar?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row justify-content-start align-items-center">
                        <div class="col-md-12">
                            <h3 class="title-modal-contato">Entre em contato com um administrador para criar sua conta com as seguintes informações:</h3>

                            <div class="row modal-info-box justify-content-star align-items-center">
                                <i class="fas fa-user-plus icon-modal"></i>
                                <span class="text-info-modal">Seu nome</span>          
                            </div>

                            <div class="row modal-info-box justify-content-star align-items-center">
                                <i class="far fa-envelope icon-modal"></i>
                                <span class="text-info-modal">Um email válido</span>          
                            </div>
                    
                            <div class="row modal-info-box justify-content-start align-items-center">
                                <i class="fas fa-lock icon-modal"></i>
                                <span class="text-info-modal">Uma senha</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-modal" data-dismiss="modal">FECHAR</button>
                </div>
            </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="../js/ajax.js"></script>

        <script>
            $(document).keypress(function(e) {
                if(e.which == 13) {
                    e.preventDefault();
                    $('#btnLogin').click();
                }
            })
        </script>
    </body>
</html>
