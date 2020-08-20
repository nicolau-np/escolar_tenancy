<?php 
include_once '../PAGES/array_permicao.php';
?>
<div class="collapse navbar-collapse" id="sidenav-collapse-main">
    <!-- Collapse header -->
    <div class="navbar-collapse-header d-md-none">
        <div class="row">
            <div class="col-6 collapse-brand">
                <a href="index.php">
                    <img src="../../ACTIVOS/img/brand/log.png">
                </a>
            </div>
            <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>
    <!-- Form -->
    <form class="mt-4 mb-3 d-md-none">
        <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-search"></span>
                </div>
            </div>
        </div>
    </form>
    <!-- Navigation -->
    <ul class="navbar-nav">
        <li class="<?php
        if (addslashes(htmlspecialchars(isset($_GET['prin'])))): echo 'nav-item active';
        else: echo 'nav-item';
        endif;
        ?>">
            <a class="<?php
            if (addslashes(htmlspecialchars(isset($_GET['prin'])))): echo 'nav-link active';
            else: echo 'nav-link';
            endif;
            ?>" href="index.php?prin"> <i class="ni ni-tv-2 text-primary"></i> PRINCIPAL
            </a>
        </li>
        <?php 
        if($data_permicao['all'] == "sim" || $data_permicao['super_restrit'] == "sim"):
        ?>
        <li class="<?php
        if (addslashes(htmlspecialchars(isset($_GET['usua'])))): echo 'nav-item active';
        else: echo 'nav-item';
        endif;
        ?>">
            <a class="<?php
            if (addslashes(htmlspecialchars(isset($_GET['usua'])))): echo 'nav-link active';
            else: echo 'nav-link';
            endif;
            ?>" href="icons.php?usua">
                <i class="ni ni-single-02 text-yellow"></i> CADASTRO
            </a>
        </li>
        <?php endif;?>
        
        <?php if($data_permicao['restrit1'] == "sim" || $data_permicao['restrit2'] == "sim"):?>
        <li class="<?php
        if (addslashes(htmlspecialchars(isset($_GET['lanca'])))): echo 'nav-item active';
        else: echo 'nav-item';
        endif;
        ?>">
            <a class="<?php
            if (addslashes(htmlspecialchars(isset($_GET['lanca'])))): echo 'nav-link active';
            else: echo 'nav-link';
            endif;
            ?>" href="maps.php?lanca">
                <i class="ni ni-pin-3 text-orange"></i> LANÇAMENTOS
            </a>
        </li>
        <?php endif;?>
        
       <?php if($data_permicao['restrit1'] == "sim" || $data_permicao['restrit2'] == "sim"):?> 
       <li class="<?php
        if (addslashes(htmlspecialchars(isset($_GET['mini_paut'])))): echo 'nav-item active';
        else: echo 'nav-item';
        endif;
        ?>">
            <a class="<?php
            if (addslashes(htmlspecialchars(isset($_GET['mini_paut'])))): echo 'nav-link active';
            else: echo 'nav-link';
            endif;
            ?>" href="mini_pautas.php?mini_paut">
                <i class="ni ni-circle-08 text-pink"></i> MINI PAUTAS
            </a>
        </li>
        <?php endif;?>
        
        <?php if($data_permicao['restrit2'] == "sim"):?>
        <li class="<?php
        if (addslashes(htmlspecialchars(isset($_GET['m_tur'])))): echo 'nav-item active';
        else: echo 'nav-item';
        endif;
        ?>">
            <a class="<?php
            if (addslashes(htmlspecialchars(isset($_GET['m_tur'])))): echo 'nav-link active';
            else: echo 'nav-link';
            endif;
            ?>" href="minha_turma.php?m_tur">
                <i class="ni ni-ungroup text-black-50"></i> MINHA TURMA
            </a>
        </li>
        <?php endif;?>
        
        <?php if($data_permicao['all'] == "sim"):?>
        <li class="<?php
        if (addslashes(htmlspecialchars(isset($_GET['paut'])))): echo 'nav-item active';
        else: echo 'nav-item';
        endif;
        ?>">
            <a class="<?php
            if (addslashes(htmlspecialchars(isset($_GET['paut'])))): echo 'nav-link active';
            else: echo 'nav-link';
            endif;
            ?>" href="pautas.php?paut">
                <i class="ni ni-planet text-blue"></i> PAUTAS
            </a>
        </li>
        <?php endif;?>
        
        <?php if($data_permicao['all'] == "sim" || $data_permicao['super_restrit'] == "sim"):?>
        <li class="<?php
        if (addslashes(htmlspecialchars(isset($_GET['rela'])))): echo 'nav-item active';
        else: echo 'nav-item';
        endif;
        ?>">
            <a class="<?php
            if (addslashes(htmlspecialchars(isset($_GET['rela'])))): echo 'nav-link active';
            else: echo 'nav-link';
            endif;
            ?>" href="tables.php?rela">
                <i class="ni ni-bullet-list-67 text-red"></i> RELATÓRIOS
            </a>
        </li>
        <?php endif;?>
        
       <?php if($data_permicao['all'] == "sim" || $data_permicao['super_restrit'] == "sim"):?>
        <li class="<?php
        if (addslashes(htmlspecialchars(isset($_GET['esta'])))): echo 'nav-item active';
        else: echo 'nav-item';
        endif;
        ?>">
            <a class="<?php
            if (addslashes(htmlspecialchars(isset($_GET['esta'])))): echo 'nav-link active';
            else: echo 'nav-link';
            endif;
            ?>" href="estatisticas.php?esta">
                <i class="ni ni-chart-bar-32 text-green"></i> ESTATÍSTICA
            </a>
        </li>
        <?php endif;?>

        
    </ul>
    <!-- Divider -->
    <hr class="my-3">
    <?php if($data_permicao['all'] == "sim"):?>
    <!-- Heading -->
    <h6 class="navbar-heading text-muted">CONFIGURAÇÕES</h6>
    <!-- Navigation -->
    <ul class="navbar-nav mb-md-3">
        <li class="<?php if (addslashes(htmlspecialchars(isset($_GET['inst'])))): echo 'nav-item active';
               else: echo 'nav-item';
               endif;
            ?>">
            <a class="<?php if (addslashes(htmlspecialchars(isset($_GET['inst'])))): echo 'nav-link active';
               else: echo 'nav-link';
               endif;
            ?>" href="institucional.php?inst">
                <i class="ni ni-spaceship"></i> INSTITUCIONAL
            </a>
        </li>
        
        <li class="<?php if (addslashes(htmlspecialchars(isset($_GET['extr'])))): echo 'nav-item active';
               else: echo 'nav-item';
               endif;
            ?>">
            <a class="<?php if (addslashes(htmlspecialchars(isset($_GET['extr'])))): echo 'nav-link active';
               else: echo 'nav-link';
               endif;
            ?>" href="extras.php?extr">
                <i class="ni ni-settings"></i> EXTRAS
            </a>
        </li>
      
        <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.php">
                <i class="ni ni-ui-04"></i> COMPONENTES
            </a>
        </li>
    </ul>
    <?php endif;?>
</div>


































