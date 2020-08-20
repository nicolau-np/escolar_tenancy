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
            Pautas
        </title>
        <!-- Favicon -->
        <link href="../../ACTIVOS/img/brand/log.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <!-- Icons -->
        <link href="../../ACTIVOS/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
        <link href="../../ACTIVOS/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
        <!-- CSS Files -->
        <link rel="stylesheet" href="../../ACTIVOS/css/miniPautas.css"/>
        <link href="../../ACTIVOS/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
        <link href="../../ACTIVOS/css/tabs.css" rel="stylesheet" />
        <script type="text/javascript" src="../../ACTIVOS/js/carregador.js"></script>
        <script type="text/javascript" src="../../ACTIVOS/js/jquery-1.5.2.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $("#modal-carregamento").modal("show");
                $("#carrega_pauta").load("LOAD_PAUTAS/simples.php", function () {
                    $("#modal-carregamento").modal("hide");
                });

                $("#simples").click(function (e) {
                    e.preventDefault();
                    $("#modal-carregamento").modal("show");
                    $("#carrega_pauta").load("LOAD_PAUTAS/simples.php", function () {
                        $("#modal-carregamento").modal("hide");
                    });
                });
                
                 $("#complexa").click(function (e) {
                    e.preventDefault();
                    $("#modal-carregamento").modal("show");
                    $("#carrega_pauta").load("LOAD_PAUTAS/complexa.php", function () {
                        $("#modal-carregamento").modal("hide");
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
                    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="pautas.php">Pautas</a>
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
            <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
                <div class="container-fluid">
                    <div class="header-body">
                        <!-- Card stats -->
                        <div class="row">
                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <a href="#" id="simples">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">Simples</h5>
                                                    <span class="h2 font-weight-bold mb-0"></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                        <i class="fas fa-file-word"></i>
                                                    </div>
                                                </div>
                                            </div></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <a href="#" id="complexa">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">Complexa</h5>
                                                    <span class="h2 font-weight-bold mb-0"></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                        <i class="fas fa-file-archive"></i>
                                                    </div>
                                                </div>
                                            </div></a>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <a href="#" id="#">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0"><i class="fas fa-arrow-left"></i></h5>
                                                    <span class="h2 font-weight-bold mb-0"></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                                        <i class="fas fa-ad"></i>
                                                    </div>
                                                </div>
                                            </div></a>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <a href="#" id="#">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0"><i class="fas fa-arrow-right"></i></h5>
                                                    <span class="h2 font-weight-bold mb-0"></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                                        <i class="fas fa-ad"></i>
                                                    </div>
                                                </div>
                                            </div></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt--7">
                <!-- Table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">

                            <div class="card-body" id="carrega_pauta">

                            </div>
                        </div>
                    </div>
                </div>


                <!--inicio modais-->
                <!-- modal carregamento--> 
                <div class="modal" id="modal-carregamento" data-backdrop="static" >
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">
                            <!-- Cabeçalho do Modal -->
                            <div class="modal-header">
                                Carregando...

                            </div>
                            <!-- Corpo do Modal -->
                            <div class="modal-body">
                                <img src="../../ACTIVOS/img/theme/load.gif" style="width: 100px; height: 100px; margin: auto;position: absolute; top: 0; left: 0; bottom: 0; right: 0;"/>
                            </div>
                            <!-- Rodapé do Modal -->
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- fim-->  


                <!-- fim modal-->

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






















