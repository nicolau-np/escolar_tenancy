<?php 
ob_start();
session_start();
include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/DisciplinasDAO.php';

$nome_disciplina = addslashes(htmlspecialchars($_GET['nome_disciplina']));
$objDisciplinasDAO = new DisciplinasDAO($_SESSION['dbname']);
$res1 = $objDisciplinasDAO->search($nome_disciplina);
?>
<table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nome disciplina</th>
                        <th scope="col">Sígla</th>
                        <th scope="col">Componente</th>
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
                            <span class="mb-0 text-sm"><?php echo $view1->nome_disciplina; ?></span>
                        </div>
                    </div>
                    </th>
                    <td>
                        <?php echo $view1->sigla; ?>
                    </td>
                    <td>
                        <?php echo $view1->componente; ?>
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
