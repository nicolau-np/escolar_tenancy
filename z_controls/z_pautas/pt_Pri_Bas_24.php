    <hr/>
    <div class="row" style="font-family: arial; font-size: 14px;">
        <div class="col-md-2">
        <b><?php echo $view->nome; ?></b> 
        </div><b>::</b>
        <div class="col-md-4">
            <b><?php echo $view1->nome; ?></b>
        </div><b>::</b>
        <div class="col-md-2">
            <b><?php echo $view1->nome_curso; ?></b> 
        </div><b>::</b>
        <div class="col-md-1">
            <b><?php echo $view1->classe; ?> classe</b>
        </div><b>::</b>
        <div class="col-md-1">
            <b><?php echo $view1->turma; ?></b> 
        </div><b>::</b>
        <div class="col-md-1">
            <b><?php echo $view1->ano_lectivo; ?></b> 
        </div>
        
    </div>
    <br/>

    <table class="table table-striped table-bordered" style="font-family: arial; font-size: 12px;">
        <thead>
            <tr>
                <th rowspan="2">Disciplina</th> 
                <th colspan="3">1 Trimestre</th>
                <th colspan="3">2 Trimestre</th>
                <th colspan="3">3 Trimestre</th>
                <th colspan="3">Dados Finais</th>
            </tr>
            <tr>
                <th>MAC</th>
                <th>CPP</th>
                <th>CT</th>

                <th>MAC</th>
                <th>CPP</th>
                <th>CT</th>

                <th>MAC</th>
                <th>CPP</th>
                <th>CT</th>

                <th>CAP</th>
                <th>CPE</th>
                <th>CF</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $objTrimestrais->setAno_lectivoT($ano_lectivo);
            $objFinais->setAno_lectivoF($ano_lectivo);
            $res3 = $objDISCursoDAO->conta_disciplinas($view1->nome_curso, $view1->classe);
            while ($view3 = $res3->fetch(PDO::FETCH_OBJ)):

                $objTrimestrais->setEpoca(1);
                $objTrimestrais->setNome_disciplina($view3->nome_disciplina);

                $res4 = $objTrimestraisDAO->consultar_nota($objTrimestrais, $objEstudante);
                $view4 = $res4->fetch(PDO::FETCH_OBJ);

                $objTrimestrais->setEpoca(2);
                $res5 = $objTrimestraisDAO->consultar_nota($objTrimestrais, $objEstudante);
                $view5 = $res5->fetch(PDO::FETCH_OBJ);

                $objTrimestrais->setEpoca(3);
                $res6 = $objTrimestraisDAO->consultar_nota($objTrimestrais, $objEstudante);
                $view6 = $res6->fetch(PDO::FETCH_OBJ);

                $objFinais->setNome_disciplina($view3->nome_disciplina);
                $resFi = $objFinaisDAO->consultar_nota($objFinais, $objEstudante);
                $viewFi = $resFi->fetch(PDO::FETCH_OBJ);
                ?>
                <tr>
                    <td><?php echo $view3->nome_disciplina; ?></td> 

                    <!-- primeiro trimestre-->
                    <td class="<?php
                    if ($res4->rowCount() >= 1): echo $objEstilos->nota10($view4->mac);
                    endif;
                    ?>">
                            <?php
                            if ($res4->rowCount() >= 1): if ($view4->mac != ""):echo $view4->mac;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    
                     <td class="<?php
                    if ($res4->rowCount() >= 1): echo $objEstilos->nota10($view4->cpp);
                    endif;
                    ?>">
                            <?php
                            if ($res4->rowCount() >= 1): if ($view4->cpp != ""):echo $view4->cpp;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    
                     <td class="<?php
                    if ($res4->rowCount() >= 1): echo $objEstilos->nota10($view4->ct);
                    endif;
                    ?>">
                            <?php
                            if ($res4->rowCount() >= 1): if ($view4->ct != ""):echo $view4->ct;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    <!--fim-->

                   <!-- segundo trimestre-->
                    <td class="<?php
                    if ($res5->rowCount() >= 1): echo $objEstilos->nota10($view5->mac);
                    endif;
                    ?>">
                            <?php
                            if ($res5->rowCount() >= 1): if ($view5->mac != ""):echo $view5->mac;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    
                     <td class="<?php
                    if ($res5->rowCount() >= 1): echo $objEstilos->nota10($view5->cpp);
                    endif;
                    ?>">
                            <?php
                            if ($res5->rowCount() >= 1): if ($view5->cpp != ""):echo $view5->cpp;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    
                     <td class="<?php
                    if ($res5->rowCount() >= 1): echo $objEstilos->nota10($view5->ct);
                    endif;
                    ?>">
                            <?php
                            if ($res5->rowCount() >= 1): if ($view5->ct != ""):echo $view5->ct;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    <!--fim-->


                            <!-- terceiro trimestre-->
                    <td class="<?php
                    if ($res6->rowCount() >= 1): echo $objEstilos->nota10($view6->mac);
                    endif;
                    ?>">
                            <?php
                            if ($res6->rowCount() >= 1): if ($view6->mac != ""):echo $view6->mac;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    
                     <td class="<?php
                    if ($res6->rowCount() >= 1): echo $objEstilos->nota10($view6->cpp);
                    endif;
                    ?>">
                            <?php
                            if ($res6->rowCount() >= 1): if ($view6->cpp != ""):echo $view6->cpp;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    
                     <td class="<?php
                    if ($res6->rowCount() >= 1): echo $objEstilos->nota10($view6->ct);
                    endif;
                    ?>">
                            <?php
                            if ($res6->rowCount() >= 1): if ($view6->ct != ""):echo $view6->ct;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    <!--fim-->

                                  <!-- final-->
                    <td class="<?php
                    if ($resFi->rowCount() >= 1): echo $objEstilos->nota10($viewFi->cap);
                    endif;
                    ?>">
                            <?php
                            if ($resFi->rowCount() >= 1): if ($viewFi->cap != ""):echo $viewFi->cap;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    
                     <td class="<?php
                    if ($resFi->rowCount() >= 1): echo $objEstilos->nota10($viewFi->cpe);
                    endif;
                    ?>">
                            <?php
                            if ($resFi->rowCount() >= 1): if ($viewFi->cpe != ""):echo $viewFi->cpe;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    
                     <td class="<?php
                    if ($resFi->rowCount() >= 1): echo $objEstilos->nota10($viewFi->cf);
                    endif;
                    ?>">
                            <?php
                            if ($resFi->rowCount() >= 1): if ($viewFi->cf != ""):echo $viewFi->cf;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    <!--fim-->
                </tr>
    <?php endwhile; ?>

        </tbody>

    </table>
