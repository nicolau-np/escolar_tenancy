<?php
ob_start();
session_start();

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/SalaDAO.php';

$objSalaDAO = new SalaDAO($_SESSION['dbname']);
$sala = addslashes(htmlspecialchars($_GET['sala']));
$res1 = $objSalaDAO->search($sala);
?>

<table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Designação</th>
                        <th scope="col">Quant. estudantes</th>
                        <th scope="col">Tipo de sala</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($view1 = $res1->fetch(PDO::FETCH_OBJ)):
                        ?>
                        <tr>
                            <td class="nr">
                                <?php echo $view1->id_sala; ?>
                            </td>
                            <th scope="row">
                                <?php echo $view1->designacao; ?>
                            </th>
                            <td>
                                <?php echo $view1->quant_estudantes; ?>
                            </td>

                            <td>
                                <?php echo $view1->tipo; ?>
                            </td>

                            <td class="text-right">
                                <a href="#" class="bt_editar" title="Editar"><i class="fa fa-edit fa-2x"></i></a>&nbsp;&nbsp;
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
