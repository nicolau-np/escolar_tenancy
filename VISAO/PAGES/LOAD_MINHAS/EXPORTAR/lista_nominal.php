<meta charset="utf-8">
<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../../CONTROLO/Conexao.php';
include_once '../../../../MODELO/Estudante.php';
include_once '../../../../MODELO/Turma.php';
include_once '../../../../DAO/EstudanteDAO.php';

$objEstudante = new Estudante();
$objTurma = new Turma();
$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);

 $arquivo_saida = "lista_nominal_".$_SESSION['turmaMINHA']."_".$_SESSION['ano_lectivoMINHA'].".xls";

 // configuracao header para forcar download
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified:". gmdate("D,d M YH:i:s")."GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename=\"{$arquivo_saida}\"");
header("Content-Description: PHP Generated Data");
//fim
 
 
if (isset($_SESSION['turmaMINHA']) && $_SESSION['turmaMINHA'] != null):
    $objEstudante->setAno_lectivo($_SESSION['ano_lectivoMINHA']);
    $objTurma->setTurma($_SESSION['turmaMINHA']);
    $res = $objEstudanteDAO->buscarEstudantes_turma($objEstudante, $objTurma);

    ?>
        <table class="table align-items-center table-flush" border='1' style="font-family: arial; font-size: 13px;">
            <thead class="thead-light">
                <tr>
                    <th colspan="4">LISTA NOMINAL &nbsp;&nbsp;&nbsp;TURMA: <?php echo $_SESSION['turmaMINHA'];?>&nbsp;&nbsp;&nbsp; ANO: <?php echo $_SESSION['ano_lectivoMINHA'];?> </th>
                   
                </tr>
                <tr>
                    <th scope="col">Nº</th>
                    <th scope="col">Nome do estudante</th>
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

    <?php
else:
    echo "nenhum estudante encontrado";
endif;


exit;
?>




