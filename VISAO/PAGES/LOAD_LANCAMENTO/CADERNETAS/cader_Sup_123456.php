<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../../CONTROLO/Conexao.php';
?>
<script>
    $(document).ready(function () {
        $("#voltar").click(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            jQuery.ajax({
                type: "POST",
                url: "LOAD_LANCAMENTO/notas.php",
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    $("#carrega_lancamento").text('')
                            .append(data);
                }
            });
            return false;

        });
    });
</script>

<div class="pagina">
    <div class="row"> 
        <div class="col-md-12">
            <div class="text-left">
                <a href="#" id="voltar"><i class="fa fa-angle-double-left"></i></a>
            </div>

        </div>
    </div>
    
        <div class="row"> 
        <div class="col-md-12">
            Ensino:<?php echo $_SESSION['ensinoS'];?><br/>
            Curso: <?php echo $_SESSION['cursoS'];?><br/>
            Classe: <?php echo $_SESSION['classeS'];?><br/>
            Turma: <?php echo $_SESSION['turmaS'];?><br/>
            Disciplina: <?php echo $_SESSION['nome_disciplinaS'];?><br/>
            Sigla: <?php echo $_SESSION['siglaS'];?><br/>
            Epoca Disciplina: <?php echo $_SESSION['epocaDisS'];?><br/>
            
            
            Superior =>1 ano, 2 ano, 3 ano, 4 ano, 5 ano, 6 ano
        </div>
    </div>




</div>












