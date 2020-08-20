<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            Perfil de usuário
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
                
                $("#form_profile").submit(function (e) {
                    e.preventDefault();
                    $("#resultado_sucesso").css({"display": "none"});
                    $("#resultado_erro").css({"display": "none"});
                    $("#carregando").css({"display": "block"});
                    var dados = $(this).serialize();
                    $.ajax({
                        method: "POST",
                        url: "LOAD_PROFILE/Controller_profile.php",
                        data: dados,
                        success: function (resultado) {
                            if (resultado == 1) {
                                $("#carregando").css({"display": "none"});
                                $("#resultado_sucesso").css({"display": "block"});
                                $("#resultado_erro").css({"display": "none"});
                                $("#form_profile")[0].reset();
                            } else {
                                $("#carregando").css({"display": "none"});
                                $("#resultado_sucesso").css({"display": "none"});
                                $("#resultado_erro").css({"display": "block"});
                                $("#mostra_erro").html(resultado);
                            }
                        }
                    });
                   
                });
            });
        </script>
    </head>

    <body class="">
        <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
            <div class="container-fluid">
                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Brand -->
                <a class="navbar-brand pt-0" href="index.php?prin">
                    <img src="../../ACTIVOS/img/brand/log.png" class="navbar-brand-img" alt="...">
                </a>
                <!-- User -->
                <?php
                include_once 'INCLUDE/header.php';
                ?>
                <!-- Collapse -->
                <?php
                include_once 'INCLUDE/menu.php';
                ?>
            </div>
        </nav>
        <div class="main-content">
            <!-- Navbar -->
            <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
                <div class="container-fluid">
                    <!-- Brand -->
                    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="profile.php">Perfil de usuário</a>
                    <!-- Form -->
                    <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                        <div class="form-group mb-0">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input class="form-control" placeholder="Search" type="text">
                            </div>
                        </div>
                    </form>
                    <!-- User -->
                    <?php
                    include_once 'INCLUDE/header_2.php';
                    ?>
                </div>
            </nav>
            <!-- End Navbar -->
            <!-- Header -->
            <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(../../ACTIVOS/img/theme/images.jpg); background-size: cover; background-position: center top;">
                <!-- Mask -->
                <span class="mask bg-gradient-default opacity-8"></span>
                <!-- Header container -->
                <div class="container-fluid d-flex align-items-center">
                    <div class="row">
                        <div class="col-lg-7 col-md-10">
                            <h1 class="display-2 text-white">Olá <?php echo $_SESSION['nome_usuarioLOG']; ?></h1>
                            <p class="text-white mt-0 mb-5">Esta é a sua pagina do perfil. You can see the progress you've made with your work and manage your projects or assigned tasks</p>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Page content -->
            <div class="container-fluid mt--7">
                <div class="row">
                    <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                        <div class="card card-profile shadow">
                            <div class="row justify-content-center">
                                <div class="col-lg-3 order-lg-2">
                                    <div class="card-profile-image">
                                        <a href="#">
                                            <img src="../../ACTIVOS/img/theme/animated.jpg" class="rounded-circle">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-sm btn-info mr-4">Conectar</a>
                                    <a href="#" class="btn btn-sm btn-default float-right">Mensagem</a>
                                </div>
                            </div>
                            <div class="card-body pt-0 pt-md-4">
                                <div class="row">
                                    <div class="col">
                                        <div class="card-profile-stats d-flex justify-content-center mt-md-5">

                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h3>
                                        <?php echo $_SESSION['nome_pessoaLOG']; ?><span class="font-weight-light">, <?php echo $_SESSION['idadeLOG']; ?></span>
                                    </h3>
                                    <div class="h5 font-weight-300">
                                        <i class="ni location_pin mr-2"></i><?php echo $_SESSION['provinciaLOG']; ?>, <?php echo $_SESSION['municipioLOG']; ?>
                                    </div>
                                    <div class="h5 mt-4">
                                        <i class="ni business_briefcase-24 mr-2"></i><?php echo $_SESSION['agenteLOG']; ?> - <?php echo $_SESSION['cargoLOG']; ?>
                                    </div>
                                    <div>
                                        <i class="ni education_hat mr-2"></i><?php echo $_SESSION['nome_escolaLOG']; ?>
                                    </div>
                                    <hr class="my-4" />
                                    <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.</p>
                                    <a href="#">Show more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 order-xl-1">
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">Minha conta</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="#!" class="btn btn-sm btn-primary">Configurações</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form name="form_profile" id="form_profile" action="" method="POST">
                                    <h6 class="heading-small text-muted mb-4">Informação do usuário</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Nome de usuário</label>
                                                    <input type="text" id="input-username" name="nome_usuario" class="form-control form-control-alternative" placeholder="Username" value="<?php echo $_SESSION['nome_usuarioLOG']; ?>" disabled="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-email">Email address</label>
                                                    <input type="email" id="input-email" name="telefone" class="form-control form-control-alternative" placeholder="jesse@example.com" value="<?php echo $_SESSION['telefoneLOG']; ?>" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Nome completo</label>
                                                    <input type="text" id="input-first-name" name="nome_pessoa" class="form-control form-control-alternative" placeholder="First name" value="<?php echo $_SESSION['nome_pessoaLOG']; ?>" disabled="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <!-- Address -->
                                    <h6 class="heading-small text-muted mb-4">Alterar palavra-passe</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-address">Palavra-Passe actual</label>
                                                    <input class="form-control form-control-alternative" name="passe_actual" placeholder="Palavra-Passe actual" type="password" required=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-city">Nova palavra-passe</label>
                                                    <input type="password" id="input-city" name="nova_passe" class="form-control form-control-alternative" placeholder="Nova palavra-passe" required=""/>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-country">Confirma palavra-passe</label>
                                                    <input type="password" id="input-country" name="nova_passe2" class="form-control form-control-alternative" placeholder="Confirma palavra-passe" required=""/>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-inline">
                                                    <span id="carregando" style="display: none;">
                                                        <img src="../../ACTIVOS/img/theme/load.gif" style="height: 20px; widows: 20px;"/>
                                                    </span>  
                                                    <span id="resultado_sucesso" style="display: none;">
                                                        <img src="../../ACTIVOS/img/theme/success.png" style="height: 20px; widows: 20px;"/>
                                                    </span>
                                                    <span id="resultado_erro" style="display: none;">
                                                        <img src="../../ACTIVOS/img/theme/error.png" style="height: 20px; widows: 20px;"/>
                                                    </span>
                                                    &nbsp;&nbsp; 
                                                    <button type="submit" name="bt_sav" class="btn btn-primary">Salvar</button>
                                                    &nbsp;&nbsp;<span id="mostra_erro" style="font-size: 11px; font-family: arial; background: none; color: red;"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <footer class="footer">
                    <?php
                    include_once 'INCLUDE/rodape.php';
                    ?>
                </footer>
            </div>
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
