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
                        url: "LOAD_MINHAS/session.php",
                        data: {'acao': $acao, 'id_disciplina': $item},
                        success: function () {
                            $("#carrega44").load("LOAD_MINHAS/carrinho.php");
                        }
                    });
                    return false;
                });
            });
        </script>
    </head>
    <body>

        <?php
        if (isset($_SESSION["favoritosBO"]) && $_SESSION["favoritosBO"] != null) {
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
                        $a = 0;
                        foreach ($_SESSION["favoritosBO"] as $key => $value) {
                            $id_disciplinaBO = $_SESSION["favoritosBO"][$key];
                            $res4 = $objDisciplinasDAO->ID_buscarDisciplina($id_disciplinaBO);
                            while ($view4 = $res4->fetch(PDO::FETCH_OBJ)):
                                $a ++;
                                ?>
                                <tr>
                                    <td class="nr"><?php echo $view4->id_disciplina; ?></td>
                                    <td scope="row">
                                    <?php echo $view4->sigla; ?>
                               
                            </td>
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





