<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
        . 'window.location.href="login.php";'
        . '</script>';
endif;

include_once '../../../../CONTROLO/Conexao.php';
include_once '../../../../CONTROLO/Globals.php';
include_once '../../../../MODELO/Trimestrais.php';
include_once '../../../../DAO/TrimestraisDAO.php';
include_once '../../../../MODELO/Finais.php';
include_once '../../../../DAO/FinaisDAO.php';
include_once '../../../../MODELO/Avaliacao.php';
include_once '../../../../DAO/AvaliacaoDAO.php';
include_once '../../../../MODELO/Prova.php';
include_once '../../../../DAO/ProvaDAO.php';

$objGlobals = new Globals();
$objTrimestrais = new Trimestrais();
$objTrimestraisDAO = new TrimestraisDAO($_SESSION['dbname']);
$objFinais = new Finais();
$objFinaisDAO = new FinaisDAO($_SESSION['dbname']);
$objAvaliacao = new Avaliacao();
$objAvaliacaoDAO = new AvaliacaoDAO($_SESSION['dbname']);
$objProva = new Prova();
$objProvaDAO = new ProvaDAO($_SESSION['dbname']);

$objTrimestrais->setAno_lectivoT($objGlobals->getAno_lectivo());
$objTrimestrais->setNome_disciplina($_SESSION['nome_disciplinaS']);

$objFinais->setAno_lectivoF($objGlobals->getAno_lectivo());
$objFinais->setNome_disciplina($_SESSION['nome_disciplinaS']);

$objAvaliacao->setAno_lectivoA($objGlobals->getAno_lectivo());
$objAvaliacao->setNome_disciplina($_SESSION['nome_disciplinaS']);

$objProva->setAno_lectivoP($objGlobals->getAno_lectivo());
$objProva->setNome_disciplina($_SESSION['nome_disciplinaS']);
?>

<div class="col-md-9">
    <div class="table-responsive">
        <table class="table align-items-center table-flush" id="tblEditavel3A">
            <thead class="thead-light">
            <tr>
                <th title="id_avaliacao" scope="col" style="width: 4%;" rowspan="2">Nº</th>
                <th title="nome_estudante" scope="col" rowspan="2">Nome estudante</th>
                <th colspan="3" style="text-align:center;">Avaliações</th>
            </tr>
            <tr>
                <th title="ava1" scope="col">AGO</th>
                <th title="ava2" scope="col">SET</th>
                <th title="ava3" scope="col">OUT</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $a3 = 0;
            $objAvaliacao->setEpoca(3);
            $res3A = $objAvaliacaoDAO->buscarNotas($objAvaliacao, $_SESSION['turmaS']);
            while ($view3A = $res3A->fetch(PDO::FETCH_OBJ)):
                $a3++;
                ?>
                <tr>
                    <td title="id_avaliacao"><?php echo $a3; ?></td>
                    <th title="nome_estudante" scope="row">
                        <?php echo $view3A->nome; ?>
                    </th>

                    <td title="valor1">
                        <input type="number"
                               data-id_avaliacao="<?php echo $view3A->id_avaliacao; ?>"
                               style="width: 50px;"
                               value="<?php if ($view3A->valor1 != ""): echo $view3A->valor1; else: echo "---"; endif; ?>"
                               data-coluna="1" class="avaliacao"/>
                    </td>
                    <td title="valor2">
                        <input type="number"
                               data-id_avaliacao="<?php echo $view3A->id_avaliacao; ?>"
                               style="width: 50px;"
                               value="<?php if ($view3A->valor2 != ""): echo $view3A->valor2; else: echo "---"; endif; ?>"
                               data-coluna="2" class="avaliacao"/>
                    </td>
                    <td title="valor3">
                        <input type="number"
                               data-id_avaliacao="<?php echo $view3A->id_avaliacao; ?>"
                               style="width: 50px;"
                               value="<?php if ($view3A->valor3 != ""): echo $view3A->valor3; else: echo "---"; endif; ?>"
                               data-coluna="3" class="avaliacao"/>
                    </td>

                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

    </div>
</div>

<div class="col-md-3">
    <div class="table-responsive">
        <table class="table align-items-center table-flush" id="tblEditavel3P">
            <thead class="thead-light">
            <tr>
                <th style="visibility: hidden;" title="id_prova" scope="col" style="width: 4%;" rowspan="2">---</th>
                <th title="prova" scope="col">Prova</th>
            </tr>
            <tr>
                <th title="id_prova" scope="col">CPP</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $objProva->setEpoca(3);
            $res3P = $objProvaDAO->buscarNotas($objProva, $_SESSION['turmaS']);
            while ($view3P = $res3P->fetch(PDO::FETCH_OBJ)):
                ?>
                <tr>
                    <td style="visibility: hidden;"
                        title="id_prova"><?php echo $view3P->id_prova; ?></td>
                    <td title="valor1">
                        <input type="number"
                               data-id_prova="<?php echo $view3P->id_prova; ?>"
                               style="width: 50px;"
                               value="<?php if ($view3P->valor1 != ""): echo $view3P->valor1; else: echo "---"; endif; ?>"
                               data-coluna="1" class="prova"/>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

    </div>
</div>


<script>
    $(document).ready(function () {
        $('.avaliacao').on("keypress", function (e) {
            if (e.which == 13) {
                var valor = $(this).val();
                var id_avaliacao = $(this).data('id_avaliacao');
                var coluna = $(this).data('coluna');
                if (valor != "" && valor >= 0 && valor <= 20) {
                    var pagina = "LOAD_LANCAMENTO/CADERNETAS/Controller_Ava.php";
                    var campo = "valor" + coluna;
                    var retorno = update_nota(pagina, id_avaliacao, campo, valor);
                    if (retorno == true) {
                        $(this).css({'background': 'green', 'color': 'white', 'font-weight': 'bold'});
                    }
                } else {
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }

            }
        });

        $('.prova').on("keypress", function (e) {
            if (e.which == 13) {
                var valor = $(this).val();
                var id_prova = $(this).data('id_prova');
                var coluna = $(this).data('coluna');
                if (valor != "" && valor >= 0 && valor <= 20) {
                    var pagina = "LOAD_LANCAMENTO/CADERNETAS/Controller_Pro.php";
                    var campo = "valor" + coluna;
                    var retorno = update_nota(pagina, id_prova, campo, valor);
                    if (retorno == true) {
                        $(this).css({'background': 'green', 'color': 'white', 'font-weight': 'bold'});
                    }
                } else {
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }
            }
        });

        $('.cpe').on("keypress", function (e) {
            if (e.which == 13) {
                var valor = $(this).val();
                var id_cpe = $(this).data('id_cpe');
                var coluna = $(this).data('coluna');
                if (valor != "" && valor >= 0 && valor <= 20) {
                    var pagina = "LOAD_LANCAMENTO/CADERNETAS/Controller_finais.php";
                    var campo = "cpe";
                    var retorno = update_nota(pagina, id_cpe, campo, valor);
                    if (retorno == true) {
                        $(this).css({'background': 'green', 'color': 'white', 'font-weight': 'bold'});
                    }
                } else {
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }
            }
        });

        function update_nota(pagina, id, campo, valor) {
            $.ajax({
                type: "POST",
                url: pagina,
                data: {
                    id: id,
                    campo: campo,
                    valor: valor
                },
                beforeSend: function () {
                },
                success: function (result) {
                }

            });
            return true;
        }

    });
</script>


