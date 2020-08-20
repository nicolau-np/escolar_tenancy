<?php
ob_start();
session_start();
include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/DisciplinasDAO.php';

$objDisciplinasDAO = new DisciplinasDAO($_SESSION['dbname']);
?>
<html>
    <head>
        <title>carrinho</title>
        <script type = "text/javascript">
            jQuery(document).ready(function () {
                $(".del").click(function () {
                    var $acao = "del";
                    var $item = $(this).closest("tr").find(".nr").text();

                    $.ajax({
                        type: "POST",
                        url: "LOAD_INSTITUCIONAL/session.php",
                        data: {'acao': $acao, 'id_disciplina': $item},
                        success: function () {
                            $("#carrega44").load("LOAD_INSTITUCIONAL/carrinho.php");
                        }
                    });
                    return false;
                });
            });
        </script>
    </head>
    <body>

        <?php
        if (isset($_SESSION["favoritos"]) && $_SESSION["favoritos"] != null) {
            ?>
            <div class="table-responsive" id="carrega">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome disciplina</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($_SESSION["favoritos"] as $key => $value) {
                            $id_disciplina = $_SESSION["favoritos"][$key];
                            $res4 = $objDisciplinasDAO->ID_buscarDisciplina($id_disciplina);
                            while ($view4 = $res4->fetch(PDO::FETCH_OBJ)):
                                ?>
                                <tr>
                                    <th class="nr"><?php echo $view4->id_disciplina; ?></th>
                                    <th scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="mb-0 text-sm"><?php echo $view4->nome_disciplina; ?></span>
                                </div>
                            </div>
                            </th>
                            <td class="text-right">
                                <button type="button" class="del"><i class="fas fa-minus"></i></button>
                             
                            </td>
                            </tr>
                            <?php
                        endwhile;
                    }
                    ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo"nenhuma disciplina selecionada";
            }
            ?>
            </div>
    </body>
</html>
