<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../../CONTROLO/Conexao.php';
include_once '../../../../DAO/FuncionarioDAO.php';

$objFuncionarioDAO = new FuncionarioDAO($_SESSION['dbname']);

$pagina = addslashes(htmlspecialchars(isset($_GET['pagina']))) ? addslashes(htmlspecialchars($_GET['pagina'])) : 1;

$res = $objFuncionarioDAO->buscar_funcionarios();
$total = $res->rowCount();
$registros = 12;
$numpaginas = ceil($total / $registros);
$inicio = ($registros * $pagina) - $registros;

$res2 = $objFuncionarioDAO->funcionarios_paginacao($inicio, $registros);
$total2 = $res2->rowCount();
?>



<table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome funcionário</th>
                        <th scope="col">Gênero</th>
                        <th scope="col">Cargo</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($view = $res2->fetch(PDO::FETCH_OBJ)):
                        ?>
                        <tr>
                            <td class="nr"><?php echo $view->id_funcionario; ?></td>

                            <th scope="row">
                                <?php echo $view->nome; ?>
                            </th>
                            <td>
                                <?php echo $view->genero; ?>
                            </td>
                            <td>
                                <?php echo $view->cargo; ?> 
                            </td>


                            <td class="text-right">
                                <a href="#" class="bt_editar" title="Editar"><i class="fa fa-edit fa-2x"></i></a>&nbsp;&nbsp;
                                <a href="#" class="bt_detalhes" title="Detalhes"><i class="fa fa-newspaper fa-2x"></i></a>&nbsp;
                                <?php
                                if ($view->cargo == "Professor colaborador" || $view->cargo == "Professor efectivo"):
                                    ?>
                                    <a href="#" class="bt_horario" title="Horário de trabalho"><i class="fa fa-clock fa-2x"></i></a>&nbsp;&nbsp;
                                    <a href="#" class="bt_director" title="Director"><i class="fa fa-briefcase fa-2x"></i></a>&nbsp;
                                    <a href="#" class="bt_eliminar" title="Eliminar"><i class="fa fa-trash fa-2x"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

<script>
    $("document").ready(function (e) {
        //paginacao
        $("#registro_anterior").hide();
        $("#registro_seguinte").hide();
        $("#txtna").val(<?php echo $pagina; ?>);
        $("#txtna2").val(<?php echo $numpaginas; ?>);
        var a = $("#txtna").val();
        var b = $("#txtna2").val();
        if (a != 1)
        {
            $("#registro_anterior").show();
        }
        if (a != b)
        {
            $("#registro_seguinte").show();
        }
        //fim
        
                //modal horario
        $(".bt_horario").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            $("#modal_horario").modal("show");
            $("#ID_funcionario").val($item);
            jQuery.ajax({
                type: "POST",
                url: "LOAD_CADASTRO/buscar_nomeFunc.php",
                data: "id_funcionario=" + $item,
                success: function (data) {
                    $("#carrega_nomeH").text(data);
                    $("#iu").hide("fast");
                    $(".iu").hide("fast");
                }
            });
            return false;
        });
//fim

//modal editar
        $(".bt_editar").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            $("#modal_editar").modal("show");
            $("#carrega_nomeE").text($item);
        });
//fim

//modal director
      $(".bt_director").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            $("#modal_director").modal("show");
            $("#id_funcionarioDir").val($item);
            $("#carrega_nomeD").text($item);
        });
    //fim  
    });
</script>








