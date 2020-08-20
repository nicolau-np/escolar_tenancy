<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Estudante.php';
include_once '../../../MODELO/Turma.php';
include_once '../../../DAO/EstudanteDAO.php';

$objEstudante = new Estudante();
$objTurma = new Turma();
$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);

if (isset($_SESSION['turmaMINHA']) && $_SESSION['turmaMINHA'] != null):
    $objEstudante->setAno_lectivo($_SESSION['ano_lectivoMINHA']);
    $objTurma->setTurma($_SESSION['turmaMINHA']);
    $res = $objEstudanteDAO->buscarEstudantes_turma($objEstudante, $objTurma);
    ?>
    <div class="row" id="lista" style="font-family: arial; font-size: 13px;">
        <div class="col-md-1">
            <div class="text-left">
                <a href="#" id="voltar" title="Voltar"><i class="fa fa-angle-double-left"></i></a>
            </div>
        </div>
        <div class="col-md-10">
            <div class="text-center">LISTA NOMINAL <?php echo $_SESSION['turmaMINHA']; ?></div>
        </div>
        <div class="col-md-1">
            <a href="LOAD_MINHAS/EXPORTAR/lista_nominal.php" title="Exportar"><i class="fa fa-file-excel"></i></a>
        </div>
    </div>
    <hr/>
    <div class="table-responsive" id="carregar_dados2">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nº</th>
                    <th scope="col">Nome estudante</th>
                    <th scope="col">Gênero</th>
                    <th scope="col">Idade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cont = 0;
                while ($view = $res->fetch(PDO::FETCH_OBJ)):
                    $cont ++;
                    ?>
                    <tr>
                        <td><?php echo $cont; ?></td>
                        <td scope="row">
                            <?php echo $view->nome; ?>
                        </td>
                        <td>
                            <?php echo $view->genero; ?> 
                        </td>
                        <td>
                            <?php
                            $string = explode("-", $view->data_nascimento);
                            $idadeDB = ($_SESSION['ano_lectivoMINHA'] - $string[0]);
                            echo $idadeDB;
                            ?>
                        </td>


                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php
else:
    echo "nenhum estudante encontrado";
endif;
?>
