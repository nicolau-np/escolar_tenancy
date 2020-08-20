<?php
ob_start();
session_start();

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/TurmaDAO.php';

$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);
$nome_turma = addslashes(htmlspecialchars($_GET['nome_turma']));
$res1 = $objTurmaDAO->search($nome_turma);
?>


<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col">Nome turma</th>
            <th scope="col">Curso</th>
            <th scope="col">Classe</th>
            <th scope="col">Turno</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($view1 = $res1->fetch(PDO::FETCH_OBJ)):
            ?>
            <tr>
                <th scope="row">
        <div class="media align-items-center">
            <div class="media-body">
                <span class="mb-0 text-sm"><?php echo $view1->turma ?></span>
            </div>
        </div>
    </th>
    <td>
        <?php echo $view1->nome_curso; ?>
    </td>
    <td>
        <?php echo $view1->classe; ?>
    </td>
    <td>
        <?php echo $view1->turno; ?>
    </td>

    <td class="text-right">
        <a href="#" class="bt_editar" title="Editar"><i class="fa fa-edit fa-2x"></i></a>&nbsp;&nbsp;
        <a href="#" class="bt_horario" title="Horário de trabalho"><i class="fa fa-clock fa-2x"></i></a>

    </td>
    </tr>
    <?php
endwhile;
?>
</tbody>
</table>
