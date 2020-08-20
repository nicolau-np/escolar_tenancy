<div class="row">

    <div class="col-lg-3 col-md-6" id="team">
        <div class="card">

            <!-- cards -->
            <div class="card-body">
                <img src="../../ACTIVOS/img/theme/mini.png" alt="" class="img-fluid rounded-circle w-50 mb-3">
                <h3>Boletins de Notas</h3>
                <div class="d-flex flex-row justify-content-center">
                    <div class="p-4">
                        <h3>::</h3>  
                    </div>

                    <div class="p-4">
                        <a href="#" id="boletim_nota">
                            <i class="fa fa-file-excel"></i>
                        </a>

                    </div>
                    <div class="p-4">
                        <h3>::</h3> 
                    </div>
                </div>

            </div>
            <!-- fim --> 

        </div>
        
        
    </div>
    
       <div class="col-lg-3 col-md-6" id="team">
        <div class="card">

            <!-- cards -->
            <div class="card-body">
                <img src="../../ACTIVOS/img/theme/mini.png" alt="" class="img-fluid rounded-circle w-50 mb-3">
                <h3>Termos</h3>
                <div class="d-flex flex-row justify-content-center">
                    <div class="p-4">
                        <h3>::</h3>  
                    </div>

                    <div class="p-4">
                        <a href="#" id="termo">
                            <i class="fa fa-file-excel"></i>
                        </a>

                    </div>
                    <div class="p-4">
                        <h3>::</h3> 
                    </div>
                </div>

            </div>
            <!-- fim --> 

        </div>
        
        
    </div>
    
           <div class="col-lg-3 col-md-6" id="team">
        <div class="card">

            <!-- cards -->
            <div class="card-body">
                <img src="../../ACTIVOS/img/theme/mini.png" alt="" class="img-fluid rounded-circle w-50 mb-3">
                <h3>Declaração</h3>
                <div class="d-flex flex-row justify-content-center">
                    <div class="p-4">
                        <h3>::</h3>  
                    </div>

                    <div class="p-4">
                        <a href="#" id="declaracao">
                            <i class="fa fa-file-excel"></i>
                        </a>

                    </div>
                    <div class="p-4">
                        <h3>::</h3> 
                    </div>
                </div>

            </div>
            <!-- fim --> 

        </div>
        
        
    </div>
    
 
    
             <div class="col-lg-3 col-md-6" id="team">
        <div class="card">

            <!-- cards -->
            <div class="card-body">
                <img src="../../ACTIVOS/img/theme/mini.png" alt="" class="img-fluid rounded-circle w-50 mb-3">
                <h3>Certificado</h3>
                <div class="d-flex flex-row justify-content-center">
                    <div class="p-4">
                        <h3>::</h3>  
                    </div>

                    <div class="p-4">
                        <a href="#" id="certificado">
                            <i class="fa fa-file-excel"></i>
                        </a>

                    </div>
                    <div class="p-4">
                        <h3>::</h3> 
                    </div>
                </div>

            </div>
            <!-- fim --> 

        </div>
        
        
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#boletim_nota").click(function () {
            $("#modal-carregamento").modal("show");
            $("#carregar_relatorio").load("LOAD_RELATORIOS/boletim_notas.php", function () {
                $("#modal-carregamento").modal("hide");
            });
        });
    });
</script>


