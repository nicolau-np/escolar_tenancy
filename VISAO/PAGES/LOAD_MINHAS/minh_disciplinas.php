<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Horario.php';
include_once '../../../DAO/DISCursoDAO.php';
include_once '../../../DAO/HorarioDAO.php';

$objHorario = new Horario();
$objDISCursoDAO = new DISCursoDAO($_SESSION['dbname']);
$objHorarioDAO = new HorarioDAO($_SESSION['dbname']);

if (isset($_SESSION['turmaMINHA']) && $_SESSION['turmaMINHA'] != null):
    $res = $objDISCursoDAO->conta_disciplinas($_SESSION['cursoMINHA'], $_SESSION['classeMINHA']);
    ?>
    <div class="row" id="lista" style="font-family: arial; font-size: 13px;">
        <div class="col-md-1">
            <div class="text-left">
                <a href="#" id="voltar" title="Voltar"><i class="fa fa-angle-double-left"></i></a>
            </div>
        </div>
        <div class="col-md-10">
            <div class="text-center">DISCIPLINAS & PROFESSORES <?php echo $_SESSION['turmaMINHA']; ?></div>
        </div>
        <div class="col-md-1">
            <a href="#" title="Exportar Horário"><i class="fa fa-file-excel"></i></a>
        </div>
    </div>
    <hr/>
    <div class="table-responsive" id="carregar_dados2">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome Disciplina</th>
                    <th scope="col">Sígla</th>
                    <th scope="col">Professor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($view = $res->fetch(PDO::FETCH_OBJ)):
                    $res2 = $objHorarioDAO->buscar_professores($_SESSION['turmaMINHA'], $_SESSION['ano_lectivoMINHA'], $view->nome_disciplina);
                    if($res2->rowCount() >=1):
                        $resposta = "yes";
                       $view2 = $res2->fetch(PDO::FETCH_OBJ); 
                       else:
                         $resposta = "no";  
                    endif;
                   
                    ?>
                    <tr>
                        <td><?php echo $view->id_disciplina; ?></td>
                        <td scope="row">
                            <?php echo $view->nome_disciplina; ?>
                        </td>
                        <td>
                            <?php echo $view->sigla; ?> 
                        </td>
                        <td>
                            <?php
                            if ($resposta == "no"):
                                echo "sem professor";
                            else:

                                echo $view2->nome;
                            endif;
                            ?> 
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php
else:
    echo "nenhuma disciplina encontrada";
endif;
?>

























