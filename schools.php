<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registar Instituição</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">

        <!-- Favicon -->
        <link href="ACTIVOS/img/brand/log.png" rel="icon" type="image/png">

        <link rel="stylesheet" href="CLIENTE_ACTIVOS/css/open-iconic-bootstrap.min.css">
        <link rel="stylesheet" href="CLIENTE_ACTIVOS/css/animate.css">

        <link rel="stylesheet" href="CLIENTE_ACTIVOS/css/owl.carousel.min.css">
        <link rel="stylesheet" href="CLIENTE_ACTIVOS/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="CLIENTE_ACTIVOS/css/magnific-popup.css">

        <link rel="stylesheet" href="CLIENTE_ACTIVOS/css/aos.css">

        <link rel="stylesheet" href="CLIENTE_ACTIVOS/css/ionicons.min.css">

        <link rel="stylesheet" href="CLIENTE_ACTIVOS/css/flaticon.css">
        <link rel="stylesheet" href="CLIENTE_ACTIVOS/css/icomoon.css">
        <link rel="stylesheet" href="CLIENTE_ACTIVOS/css/style.css">

        <script type="text/javascript" src="ACTIVOS/js/jquery-1.5.2.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $("#form_school").submit(function (e) {
                    e.preventDefault();
                    $("#resultado_sucesso").css({"display": "none"});
                    $("#resultado_erro").css({"display": "none"});
                    $("#carregando").css({"display": "block"});
                    var dados = $(this).serialize();
                    $.ajax({
                        method: "POST",
                        url: "z_controls/controls_school.php",
                        data: dados,
                        success: function (resultado) {
                            if (resultado == 1) {
                                $("#carregando").css({"display": "none"});
                                $("#resultado_sucesso").css({"display": "block"});
                                $("#resultado_erro").css({"display": "none"});
                                $("#form_school")[0].reset();
                            } else {
                                $("#carregando").css({"display": "none"});
                                $("#resultado_sucesso").css({"display": "none"});
                                $("#resultado_erro").css({"display": "block"});
                                $("#mostra_erro").html(resultado);
                            }
                        }
                    });

                });

                $("#form_bd").submit(function (e) {
                    e.preventDefault();
                    $("#resultado_sucesso1").css({"display": "none"});
                    $("#resultado_erro1").css({"display": "none"});
                    $("#carregando1").css({"display": "block"});
                    $("#bt_ren").hide();
                    var dados = $(this).serialize();
                    $.ajax({
                        method: "POST",
                        url: "z_controls/controls_bd.php",
                        data: dados,
                        success: function (resultado) {
                            if (resultado == 1) {
                                $("#carregando1").css({"display": "none"});
                                $("#resultado_sucesso1").css({"display": "block"});
                                $("#resultado_erro1").css({"display": "none"});
                                $("#form_bd")[0].reset();
                                $("#bt_ren").show();
                            } else {
                                $("#carregando1").css({"display": "none"});
                                $("#resultado_sucesso1").css({"display": "none"});
                                $("#resultado_erro1").css({"display": "block"});
                                $("#bt_ren").show();
                                $("#mostra_erro1").html(resultado);
                            }
                        }
                    });

                });


            });
        </script>

    </head>
    <body>
        <div class="py-2 bg-primary">
            <div class="container">
                <div class="row no-gutters d-flex align-items-start align-items-center px-3 px-md-0">
                    <div class="col-lg-12 d-block">
                        <div class="row d-flex">
                             <div class="col-md-3 pr-10 d-flex topper align-items-center">
                                <div class="icon bg-fifth mr-2 d-flex justify-content-center align-items-center"><a href="index.php" title=""><span><img src="ACTIVOS/img/brand/log.png" style="width:100%; height:30px;"></span></a></div>
                                <span class="text">2kMOon</span>
                            </div>
                            <div class="col-md-3 pr-4 d-flex topper align-items-center">
                                <div class="icon bg-info mr-2 d-flex justify-content-center align-items-right"><a href="schools.php" title="Registrar Instituição"><span class="icon-build"></span></a></div>
                                
                            </div>
                            <div class="col-md-3 pr-4 d-flex topper align-items-center">
                                <div class="icon bg-tertiary mr-2 d-flex justify-content-center align-items-right"><a href="VISAO/PAGES/login.php" title="Iniciar sessão"><span class="icon-user"></span></a></div>
                                
                            </div>
                            <div class="col-md-3 pr-4 d-flex topper align-items-center">
                                <div class="icon bg-secondary mr-2 d-flex justify-content-center align-items-center"><a href="#" title="Consulta estudante" id="abrir_modal"><span class="icon-search"></span></a></div>
                                
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- END nav -->

        <section class="hero-wrap hero-wrap-2" style="background-image: url('CLIENTE_ACTIVOS/images/bg_2.jpg');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 ftco-animate text-center">
                        <h1 class="mb-2 bread">Registrar Instituição</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Registro <i class="ion-ios-arrow-forward"></i></span></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section ftco-no-pt ftco-no-pb contact-section">
            <div class="container">
                <div class="row d-flex align-items-stretch no-gutters">
                    <div class="col-md-6 p-4 p-md-5 order-md-last bg-light">


                        <form action="" name="form_school" method="POST" id="form_school">

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nº Licença" required="" name="licenca"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nome da Instituição" required="" name="nome"/>
                            </div>
                            <div class="form-group">
                                <select size="1" name="provincia" id="provincia" onChange="escolha()" class="form-control" required="">
                                    <option value="">Província</option>
                                    <option value="Namibe">Namibe</option>
                                    <option value="Huíla">Huíla</option>
                                    <option value="Bié">Bié</option>
                                    <option value="Moxico">Moxico</option>
                                    <option value="Luanda">Luanda</option>
                                    <option value="Benguela">Benguela</option>
                                    <option value="Cuando Cubango">Cuando Cubango</option>
                                    <option value="Lunda Sul">Lunda Sul</option>
                                    <option value="Malanje">Malanje</option>
                                    <option value="Uíge">Uíge</option>
                                    <option value="Zaire">Zaire</option>
                                    <option value="Cunene">Cunene</option>
                                    <option value="Cuanza Sul">Cuanza Sul</option>
                                    <option value="Lunda Norte">Lunda Norte</option>
                                    <option value="Cuanza Norte">Cuanza Norte</option>
                                    <option value="Lunda Sul">Lunda Sul</option>
                                    <option value="Huambo">Huambo</option>
                                    <option value="Bengo">Bengo</option>
                                    <option value="Cabinda">Cabinda</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <select size="1" name="municipio" id="municipio" class="form-control">
                                    <option>Município</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Bairro" required="" name="bairro"/>  
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Telefone" required="" name="telefone"/>  
                            </div>
                            <div class="form-inline">
                                <span id="carregando" style="display: none;">
                                    <img src="ACTIVOS/img/theme/load.gif" style="height: 20px; widows: 20px;"/>
                                </span>  
                                <span id="resultado_sucesso" style="display: none;">
                                    <img src="ACTIVOS/img/theme/success.png" style="height: 20px; widows: 20px;"/>
                                </span>
                                <span id="resultado_erro" style="display: none;">
                                    <img src="ACTIVOS/img/theme/error.png" style="height: 20px; widows: 20px;"/>
                                </span>
                                &nbsp;&nbsp;
                                <button type="submit" name="btn_salvar" class="btn btn-primary py-3 px-5">Salvar</button>
                                &nbsp;&nbsp;<span id="mostra_erro" style="font-size: 11px; font-family: arial; background: none; color: red;"></span>
                            </div>
                        </form>

                        <br/>

                        <form name="form_bd" id="form_bd" method="POST" enctype="multipart/form-data"> 
                            <div class="form-group">
                                <input type="text" placeholder="codigo escola" name="codigo" required="" class="form-control"/>
                            </div>
                            <div class="form-inline">
                                <span id="carregando1" style="display: none;">
                                    <img src="ACTIVOS/img/theme/load.gif" style="height: 20px; widows: 20px;"/>
                                </span>  
                                <span id="resultado_sucesso1" style="display: none;">
                                    <img src="ACTIVOS/img/theme/success.png" style="height: 20px; widows: 20px;"/>
                                </span>
                                <span id="resultado_erro1" style="display: none;">
                                    <img src="ACTIVOS/img/theme/error.png" style="height: 20px; widows: 20px;"/>
                                </span>
                                &nbsp;&nbsp;
                                <button type="submit" name="bt_ren" id="bt_ren" class="btn btn-primary py-3 px-5"> Enviar</button>   
                                &nbsp;&nbsp;<span id="mostra_erro1" style="font-size: 11px; font-family: arial; background: none; color: red;"></span>
                            </div>
                        </form>

                    </div>
                    <div class="col-md-6 d-flex align-items-stretch">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </section>


        <footer class="ftco-footer ftco-bg-dark ftco-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-6 col-lg-3">
                        <div class="ftco-footer-widget mb-5">
                            <h2 class="ftco-heading-2">Have a Questions?</h2>
                            <div class="block-23 mb-3">
                                <ul>
                                    <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                                    <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                                    <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="ftco-footer-widget mb-5">
                            <h2 class="ftco-heading-2">Recent Blog</h2>
                            <div class="block-21 mb-4 d-flex">
                                <a class="blog-img mr-4" style="background-image: url(CLIENTE_ACTIVOS/images/image_1.jpg);"></a>
                                <div class="text">
                                    <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                                    <div class="meta">
                                        <div><a href="#"><span class="icon-calendar"></span> Dec 25, 2018</a></div>
                                        <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                        <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-21 mb-5 d-flex">
                                <a class="blog-img mr-4" style="background-image: url(CLIENTE_ACTIVOS/images/image_2.jpg);"></a>
                                <div class="text">
                                    <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                                    <div class="meta">
                                        <div><a href="#"><span class="icon-calendar"></span> Dec 25, 2018</a></div>
                                        <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                        <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="ftco-footer-widget mb-5 ml-md-4">
                            <h2 class="ftco-heading-2">Links</h2>
                            <ul class="list-unstyled">
                                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Home</a></li>
                                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>About</a></li>
                                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Services</a></li>
                                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Deparments</a></li>
                                <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="ftco-footer-widget mb-5">
                            <h2 class="ftco-heading-2">Subscribe Us!</h2>
                            <form action="schools.php" class="subscribe-form">
                                <div class="form-group">
                                    <input type="submit" value="Registro" class="form-control submit px-3">
                                </div>
                            </form>
                        </div>
                        <div class="ftco-footer-widget mb-5">
                            <h2 class="ftco-heading-2 mb-0">Connect With Us</h2>
                            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">

                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </footer>



        <!-- loader -->
        <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


        <script src="CLIENTE_ACTIVOS/js/jquery.min.js"></script>
        <script src="CLIENTE_ACTIVOS/js/jquery-migrate-3.0.1.min.js"></script>
        <script src="CLIENTE_ACTIVOS/js/popper.min.js"></script>
        <script src="CLIENTE_ACTIVOS/js/bootstrap.min.js"></script>
        <script src="CLIENTE_ACTIVOS/js/jquery.easing.1.3.js"></script>
        <script src="CLIENTE_ACTIVOS/js/jquery.waypoints.min.js"></script>
        <script src="CLIENTE_ACTIVOS/js/jquery.stellar.min.js"></script>
        <script src="CLIENTE_ACTIVOS/js/owl.carousel.min.js"></script>
        <script src="CLIENTE_ACTIVOS/js/jquery.magnific-popup.min.js"></script>
        <script src="CLIENTE_ACTIVOS/js/aos.js"></script>
        <script src="CLIENTE_ACTIVOS/js/jquery.animateNumber.min.js"></script>
        <script src="CLIENTE_ACTIVOS/js/scrollax.min.js"></script>
        <script src="CLIENTE_ACTIVOS/js/google-map.js"></script>
        <script src="CLIENTE_ACTIVOS/js/main.js"></script>
        <script type="text/javascript" src="CLIENTE_ACTIVOS/js/municipio.js"></script>

    </body>
</html>
