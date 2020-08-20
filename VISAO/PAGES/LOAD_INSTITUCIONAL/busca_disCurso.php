<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
        . 'window.location.href="login.php";'
        . '</script>';
endif;
include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/DISCursoDAO.php';

$nome_curso = addslashes(htmlspecialchars($_GET['nome_curso']));
$objDISCursoDAO = new DISCursoDAO($_SESSION['dbname']);
$res6 = $objDISCursoDAO->search($nome_curso);

?>
<table class="table align-items-center table-flush">
    <thead class="thead-light">
    <tr>
        <th scope="col">Curso</th>
        <th scope="col">Classe</th>
        <th scope="col">Disciplinas</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($view = $res6->fetch(PDO::FETCH_OBJ)):
        $res7 = $objDISCursoDAO->conta_disciplinas($view->nome_curso, $view->classe);

        ?>
        <tr>
            <th><?php echo $view->nome_curso;?></th>
            <td><?php echo $view->classe;?></td>
            <td>
                <?php
                $a = 0;
                while ($view7 = $res7->fetch(PDO::FETCH_OBJ)):
                    $a ++;
                    ?>
                    <?php echo $a.". ".strtoupper($view7->nome_disciplina)."<br/>";?>
                <?php endwhile;?>
            </td>
        </tr>
    <?php endwhile;?>
    </tbody>

</table>
