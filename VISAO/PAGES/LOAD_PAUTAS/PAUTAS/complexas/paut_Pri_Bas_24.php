<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
        . 'window.location.href="login.php";'
        . '</script>';
endif;

if (isset($_SESSION["favoritosPA"]) && $_SESSION["favoritosPA"] != null):


include_once '../../../../../CONTROLO/Conexao.php';
include_once '../../../../../CONTROLO/Globals.php';
include_once '../../../../../CONTROLO/Estilos.php';
include_once '../../../../../MODELO/Turma.php';
include_once '../../../../../MODELO/Estudante.php';
include_once '../../../../../MODELO/Trimestrais.php';
include_once '../../../../../MODELO/Finais.php';
include_once '../../../../../DAO/EstudanteDAO.php';
include_once '../../../../../DAO/DISCursoDAO.php';
include_once '../../../../../DAO/TurmaDAO.php';
include_once '../../../../../DAO/DisciplinasDAO.php';
include_once '../../../../../DAO/TrimestraisDAO.php';
include_once '../../../../../DAO/FinaisDAO.php';

$objConexao = new Conexao();
$objGlobals = new Globals();
$objTurma = new Turma();
$objEstudante = new Estudante();
$objTrimestrais = new Trimestrais();
$objFinais = new Finais();
$objEstilos = new Estilos();

$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);
$objDISCursoDAO = new DISCursoDAO($_SESSION['dbname']);
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);
$objDisciplinasDAO = new DisciplinasDAO($_SESSION['dbname']);
$objTrimestraisDAO = new TrimestraisDAO($_SESSION['dbname']);
$objFinaisDAO = new FinaisDAO($_SESSION['dbname']);

$objTurma->setTurma($_SESSION['turmaP']);
$objEstudante->setAno_lectivo($_SESSION['ano_lectivoP']);
$objFinais->setAno_lectivoF($_SESSION['ano_lectivoP']);
$objTrimestrais->setAno_lectivoT($_SESSION['ano_lectivoP']);

$resEs = $objEstudanteDAO->buscarEstudantes_turma($objEstudante, $objTurma);
?>
<div class="pagina">
    <div class="row" style="font-family: arial; font-size: 13px;">
        <div class="col-md-1">
            <div class="text-left">
                <a href="#" id="voltar" title="Voltar"><i class="fa fa-angle-double-left"></i></a>
            </div>
        </div>

        <div class="col-md-10">
            <div class="text-righ">
                Curso: <?php echo $_SESSION['cursoP']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                Classe: <?php echo $_SESSION['classeP']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                Turma: <?php echo $_SESSION['turmaP']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                Ano Lectivo: <?php echo $_SESSION['ano_lectivoP']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                PAUTA FINAL
            </div>
        </div>
        <div class="col-md-1">
            <div class="text-right">
                <a href="LOAD_PAUTAS/PAUTAS/complexas/paut_Pri_Bas_24_export.php" id="export" title="Exportar"><i
                            class="fa fa-file-excel"></i></a>
            </div>
        </div>
    </div>
    <hr/>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th colspan="3" style="text-align:center;">Dados Pessoais</th>
                        <?php
                        foreach ($_SESSION["favoritosPA"] as $key => $value) {
                            $id_disciplina = $_SESSION["favoritosPA"][$key];
                            $resDis = $objDisciplinasDAO->ID_buscarDisciplina($id_disciplina);
                            $viewDis = $resDis->fetch(PDO::FETCH_OBJ);
                            ?>

                            <th colspan="12"><?php echo $viewDis->nome_disciplina; ?></th>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>

                        <th scope="col" style="width: 8%;">Proc</th>
                        <th scope="col">Nome estudante</th>
                        <th scope="col">Gênero</th>
                        <?php
                        foreach ($_SESSION["favoritosPA"] as $key => $value) {
                            ?>
                            <th scope="col">MAC</th>
                            <th scope="col">CPP</th>
                            <th scope="col">CT1</th>

                            <th scope="col">MAC</th>
                            <th scope="col">CPP</th>
                            <th scope="col">CT2</th>

                            <th scope="col">MAC</th>
                            <th scope="col">CPP</th>
                            <th scope="col">CT3</th>

                            <th scope="col">CAP</th>
                            <th scope="col">CPE</th>
                            <th scope="col">CF</th>
                            <?php
                        }
                        ?>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($viewEs = $resEs->fetch(PDO::FETCH_OBJ)):
                        $objEstudante->setId_estudante($viewEs->id_estudante);
                        ?>
                        <tr>

                            <td><?php echo $viewEs->id_estudante; ?></td>
                            <td>
                                <?php echo $viewEs->nome; ?>
                            </td>
                            <td>
                                <?php echo $viewEs->genero; ?>
                            </td>
                            <?php
                            foreach ($_SESSION["favoritosPA"] as $key => $value) {
                                $id_disciplina = $_SESSION["favoritosPA"][$key];
                                $objEstudante->setId_estudante($viewEs->id_estudante);

                                $objTrimestrais->setId_disciplina($id_disciplina);

                                $objTrimestrais->setEpoca(1);
                                $res1 = $objTrimestraisDAO->search_nota2($objTrimestrais, $objEstudante);
                                $view1 = $res1->fetch(PDO::FETCH_OBJ);

                                $objTrimestrais->setEpoca(2);
                                $res2 = $objTrimestraisDAO->search_nota2($objTrimestrais, $objEstudante);
                                $view2 = $res2->fetch(PDO::FETCH_OBJ);

                                $objTrimestrais->setEpoca(3);
                                $res3 = $objTrimestraisDAO->search_nota2($objTrimestrais, $objEstudante);
                                $view3 = $res3->fetch(PDO::FETCH_OBJ);

                                $objFinais->setId_disciplina($id_disciplina);
                                $resFi = $objFinaisDAO->search_nota2($objFinais, $objEstudante);
                                $viewFi = $resFi->fetch(PDO::FETCH_OBJ);
                                ?>

                                <!-- 1 trimestre-->
                                <td class="<?php if ($res1->rowCount() >= 1): echo $objEstilos->nota10($view1->mac); endif; ?>">
                                    <?php
                                    if ($res1->rowCount() >= 1): if ($view1->mac != ""):echo $view1->mac;
                                    else: echo "---";
                                    endif;
                                    else: echo "---";endif;
                                    ?>
                                </td>
                                <td class="<?php if ($res1->rowCount() >= 1): echo $objEstilos->nota10($view1->cpp); endif; ?>">
                                    <?php
                                    if ($res1->rowCount() >= 1): if ($view1->data_lancamento != ""):echo $view1->cpp;
                                    else: echo "---";
                                    endif;
                                    else: echo "---";endif;
                                    ?>
                                </td>
                                <td class="<?php if ($res1->rowCount() >= 1): echo $objEstilos->nota10($view1->ct); endif; ?>">
                                    <?php
                                    if ($res1->rowCount() >= 1): if ($view1->ct != ""):echo $view1->ct;
                                    else: echo "---";
                                    endif;
                                    else: echo "---";endif;
                                    ?>
                                </td>
                                <!-- 2 trimestre-->
                                <td class="<?php if ($res2->rowCount() >= 1): echo $objEstilos->nota10($view2->mac); endif; ?>">
                                    <?php
                                    if ($res2->rowCount() >= 1): if ($view2->mac != ""):echo $view2->mac;
                                    else: echo "---";
                                    endif;
                                    else: echo "---";endif;
                                    ?>
                                </td>
                                <td class="<?php if ($res2->rowCount() >= 1): echo $objEstilos->nota10($view2->cpp); endif; ?>">
                                    <?php
                                    if ($res2->rowCount() >= 1): if ($view2->data_lancamento != ""):echo $view2->cpp;
                                    else: echo "---";
                                    endif;
                                    else: echo "---";endif;
                                    ?>
                                </td>
                                <td class="<?php if ($res2->rowCount() >= 1): echo $objEstilos->nota10($view2->ct); endif; ?>">
                                    <?php
                                    if ($res2->rowCount() >= 1): if ($view2->ct != ""):echo $view2->ct;
                                    else: echo "---";
                                    endif;
                                    else: echo "---";endif;
                                    ?>
                                </td>
                                <!-- 3 trimestre-->
                                <td class="<?php if ($res3->rowCount() >= 1): echo $objEstilos->nota10($view3->mac); endif; ?>">
                                    <?php
                                    if ($res3->rowCount() >= 1): if ($view3->mac != ""):echo $view3->mac;
                                    else: echo "---";
                                    endif;
                                    else: echo "---";endif;
                                    ?>
                                </td>
                                <td class="<?php if ($res3->rowCount() >= 1): echo $objEstilos->nota10($view3->cpp); endif; ?>">
                                    <?php
                                    if ($res3->rowCount() >= 1): if ($view2->data_lancamento != ""):echo $view3->cpp;
                                    else: echo "---";
                                    endif;
                                    else: echo "---";endif;
                                    ?>
                                </td>
                                <td class="<?php if ($res3->rowCount() >= 1): echo $objEstilos->nota10($view3->ct); endif; ?>">
                                    <?php
                                    if ($res3->rowCount() >= 1): if ($view3->ct != ""):echo $view3->ct;
                                    else: echo "---";
                                    endif;
                                    else: echo "---";endif;
                                    ?>
                                </td>
                                <!-- finais-->
                                <td class="<?php if ($resFi->rowCount() >= 1): echo $objEstilos->nota10($viewFi->cap); endif; ?>">
                                    <?php
                                    if ($resFi->rowCount() >= 1): if ($viewFi->cap != ""):echo $viewFi->cap;
                                    else: echo "---";
                                    endif;
                                    else: echo "---";endif;
                                    ?>
                                </td>

                                <td class="<?php if ($resFi->rowCount() >= 1): echo $objEstilos->nota10($viewFi->cpe); endif; ?>">
                                    <?php
                                    if ($resFi->rowCount() >= 1): if ($viewFi->data_lancamento != ""):echo $viewFi->cpe;
                                    else: echo "---";
                                    endif;
                                    else: echo "---";endif;
                                    ?>
                                </td>
                                <td class="<?php if ($resFi->rowCount() >= 1): echo $objEstilos->nota10($viewFi->cf); endif; ?>">
                                    <?php
                                    if ($resFi->rowCount() >= 1): if ($viewFi->cf != ""):echo $viewFi->cf;
                                    else: echo "---";
                                    endif;
                                    else: echo "---";endif;
                                    ?>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <?php
    else:
        echo 'deve selecionar disciplinas';
    endif;
    ?>

    <script>
        $(document).ready(function () {

            $("#voltar").click(function (e) {
                $.ajax({
                    type: "POST",
                    url: "LOAD_PAUTAS/buscar_disciplinas.php",
                    success: function (resposta) {
                        $("#carrega_pauta").text('').append(resposta);
                    }
                });
                return false;
            });

        });
    </script>
