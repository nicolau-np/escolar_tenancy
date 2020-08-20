<?php
ob_start();
session_start();
if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Curso.php';
include_once '../../../MODELO/Classes.php';
include_once '../../../MODELO/Estudante.php';

include_once '../../../DAO/EstudanteDAO.php';
include_once '../../../DAO/CursoDAO.php';
include_once '../../../DAO/ClassesDAO.php';
include_once '../../../DAO/TurmaDAO.php';

$objCurso = new Curso();
$objClasses = new Classes();
$objEstudante = new Estudante();
$objCursoDAO = new CursoDAO($_SESSION['dbname']);
$objClassesDAO = new ClassesDAO($_SESSION['dbname']);
$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);

$id_curso = addslashes(htmlspecialchars($_POST['id_curso']));
$id_classe = addslashes(htmlspecialchars($_POST['id_classe']));
$i_inicio = addslashes(htmlspecialchars($_POST['i_inicio']));
$i_fim = addslashes(htmlspecialchars($_POST['i_fim']));
$ano_lectivo = addslashes(htmlspecialchars($_POST['ano_lectivo']));

$_SESSION['ano_lectivoSS'] = $ano_lectivo;

$objCurso->setId_curso($id_curso);
$objClasses->setId_classe($id_classe);

$res = $objCursoDAO->buscarCurso_ID($objCurso);
$view = $res->fetch(PDO::FETCH_OBJ);

$res1 = $objClassesDAO->buscarClasse_ID($objClasses);
$view1 = $res1->fetch(PDO::FETCH_OBJ);

$objClasses->setNome_curso($view->nome_curso);
$objClasses->setClasse($view1->classe);
$objEstudante->setAno_lectivo($ano_lectivo);

$res2 = $objEstudanteDAO->buscarEst_Cur_cla($objEstudante, $objClasses);
$res3 = $objTurmaDAO->buscaTurma_cla_curso($objClasses);
?>



<div class="col-md-8">
    <div class="table-responsive">

        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col"><input type="checkbox" name="sele" id="selec"/></th>
                    <th scope="col">Nome estudante</th>
                    <th scope="col">Gênero</th>
                    <th scope="col">Idade</th>
                    <th scope="col">Turma</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($view2 = $res2->fetch(PDO::FETCH_OBJ)):
                    $data_array = explode("-", $view2->data_nascimento);
                    $idadeDB = ($_SESSION['ano_lectivoSS'] - $data_array[0]);
                    if($idadeDB >= $i_inicio && $idadeDB <= $i_fim || $idadeDB == $_SESSION['ano_lectivoSS']):
                    ?>
                    <tr>
                        <td><input type="checkbox" name="id_estudante[]" value="<?php echo $view2->id_estudante; ?>" class="id_estudante"/></td>

                        <th scope="row">
                <div class="media align-items-center">
                    <div class="media-body">
                        <span class="mb-0 text-sm"><?php echo $view2->nome; ?></span>
                    </div>
                </div>
                </th>
                <td>
                    <?php echo $view2->genero; ?>
                </td>
                <td>
                    <?php echo $idadeDB; ?>
                </td>
                <td>
                    <?php echo $view2->turma; ?>
                </td>
                </tr>
                <?php
                endif;
            endwhile;
            ?>

            </tbody>

        </table>

    </div>
</div>

<div class="col-md-3">
    <div class="input-group input-group-alternative">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-building"></i></span>
        </div>
        <select name="id_turma" class="form-control" required="" id="id_turma">
            <option value="">Turma</option>  
            <?php
            while ($view3 = $res3->fetch(PDO::FETCH_OBJ)):
                ?>
                <option value="<?php echo $view3->id_turma; ?>"><?php echo $view3->turma; ?></option>  
                <?php
            endwhile;
            ?>
        </select>
    </div>
</div>
<div class="col-md-1">
    <button class="btn btn-primary" name="btsave" type="submit"><i class="fa fa-save"></i></button>
</div>



<script type="text/javascript">
    $(document).ready(function () {
        $("#selec").click(function () {
            $(".id_estudante").each(
                    function () {
                        if ($(this).prop("checked")) {
                            $(this).prop("checked", false);
                        } else {
                            $(this).prop("checked", true);
                        }
                    }
            );
        });

        $("#form_modifiEstudante").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_CADASTRO/Contr_updateEstudante.php",
                data: dados,
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    if (data==1) {
                        $("#modal-alertaSucesso").modal("show");
                        $("#resultado_sucesso").text('Feito com sucesso');
                        jQuery("#form_modifiEstudante")[0].reset();
                    } else {
                        $("#modal-alertaErro").modal("show");
                        $(".resultado_erro").html(data);
                    }

                }
            });
            return false;
        });

    });
</script>







