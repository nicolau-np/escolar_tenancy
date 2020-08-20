<?php 
ob_start();
session_start();

if ((isset($_SESSION['dbname'])) && (isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="index.php?prin";'
    . '</script>';
endif;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            2kMOon - Iniciar Sessão
        </title>
        <!-- Favicon -->
        <link href="../../ACTIVOS/img/brand/log.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <!-- Icons -->
        <link href="../../ACTIVOS/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
        <link href="../../ACTIVOS/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
        <!-- CSS Files -->
        <link href="../../ACTIVOS/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
        <script type="text/javascript" src="../../ACTIVOS/js/jquery-1.5.2.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $("#form_login").submit(function (e) {
                    e.preventDefault();
                    $("#resultado_sucesso1").css({"display": "none"});
                    $("#resultado_erro1").css({"display": "none"});
                    $("#carregando1").css({"display": "block"});

                    var dados = $(this).serialize();
                    $.ajax({
                        method: "POST",
                        url: "LOAD_LOGIN/Control_login.php",
                        data: dados,
                        success: function (resultado) {
                            if (resultado == 1) {
                                $("#carregando1").css({"display": "none"});
                                $("#resultado_sucesso1").css({"display": "block"});
                                $("#resultado_erro1").css({"display": "none"});
                                $("#form_login")[0].reset();
                                $(location).attr('href', 'index.php?prin');
                            } else {
                                $("#carregando1").css({"display": "none"});
                                $("#resultado_sucesso1").css({"display": "none"});
                                $("#resultado_erro1").css({"display": "block"});

                                $("#mostra_erro1").html(resultado);
                            }
                        }
                    });

                });
            });
        </script>
    </head>

    <body class="bg-default">
        <div class="main-content">
            <!-- Navbar -->
            <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
                <div class="container px-4">
                    <a class="navbar-brand" href="../../index.php?prin" title="2kMOon">
                        <img src="../../ACTIVOS/img/brand/log.png" style="width: 15%; height: 5em; "/>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar-collapse-main">
                        <!-- Collapse header -->
                        <div class="navbar-collapse-header d-md-none">
                            <div class="row">
                                <div class="col-6 collapse-brand">
                                    <a href="index.php">
                                        <img src="../../ACTIVOS/img/brand/log.png">
                                    </a>
                                </div>
                                <div class="col-6 collapse-close">
                                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                                        <span></span>
                                        <span></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Navbar items -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link nav-link-icon" href="index.php">
                                    <i class="ni ni-planet"></i>
                                    <span class="nav-link-inner--text">Principal</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-icon" href="register.php">
                                    <i class="ni ni-circle-08"></i>
                                    <span class="nav-link-inner--text">Registrar</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-icon" href="login.php">
                                    <i class="ni ni-key-25"></i>
                                    <span class="nav-link-inner--text">Login</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-icon" href="profile.php">
                                    <i class="ni ni-single-02"></i>
                                    <span class="nav-link-inner--text">Perfil</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Header -->
            <div class="header bg-gradient-primary py-7 py-lg-8">
                <div class="container">
                    <div class="header-body text-center mb-7">

                    </div>
                </div>
                <div class="separator separator-bottom separator-skew zindex-100">
                    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                    </svg>
                </div>
            </div>
            <!-- Page content -->
            <div class="container mt--8 pb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7">
                        <div class="card bg-secondary shadow border-0">
                        
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-center text-muted mb-4">
                                    <small class="resposta">
                                        <span id="mostra_erro1" style="font-size: 11px; font-family: arial; background: none; color: red;"></span>
                                    </small> 
                                </div>
                                <form role="form" method="POST" action="login.php" name="form_login" id="form_login">
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Nome de usuário" type="text" name="usuario" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Palavra-Passe" type="password" name="senha" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-settings"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Código escolar" type="text" name="codigo" required="">
                                        </div>
                                    </div>
                                    
                                    <div class="form-inline">
                                        <span id="carregando1" style="display: none;">
                                            <img src="../../ACTIVOS/img/theme/load.gif" style="height: 20px; widows: 20px;"/>
                                        </span>  
                                        <span id="resultado_sucesso1" style="display: none;">
                                            <img src="../../ACTIVOS/img/theme/success.png" style="height: 20px; widows: 20px;"/>
                                        </span>
                                        <span id="resultado_erro1" style="display: none;">
                                            <img src="../../ACTIVOS/img/theme/error.png" style="height: 20px; widows: 20px;"/>
                                        </span>
                                        &nbsp;&nbsp;
                                        <button type="submit" class="btn btn-primary" name="entrar" >Entrar</button> 
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <a href="#" class="text-light"><small>Esqueceu a Palavra-Passe?</small></a>
                            </div>
                            <div class="col-6 text-right">
                                <a href="#" class="text-light"><small>Criar nova conta</small></a>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <footer class="py-5">
                <?php
                include_once 'INCLUDE/rodape.php';
                ?>
            </footer>
        </div>
        <!--   Core   -->
        <script src="../../ACTIVOS/js/plugins/jquery/dist/jquery.min.js"></script>
        <script src="../../ACTIVOS/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!--   Optional JS   -->
        <!--   Argon JS   -->
        <script src="../../ACTIVOS/js/argon-dashboard.min.js?v=1.1.0"></script>
        <script>
            window.TrackJS &&
                    TrackJS.install({
                        token: "ee6fab19c5a04ac1a32a645abde4613a",
                        application: "argon-dashboard-free"
                    });
        </script>
    </body>

</html>
