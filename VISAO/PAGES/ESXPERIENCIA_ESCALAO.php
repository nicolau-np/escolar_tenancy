<?php
include_once '../../CONTROLO/Conexao.php';
include_once '../../MODELO/TIPSala.php';
include_once '../../MODELO/Escalao.php';
include_once '../../MODELO/Municipio.php';
include_once '../../MODELO/Componente.php';

include_once '../../DAO/EscalaoDAO.php';
include_once '../../DAO/TIPSalaDAO.php';
include_once '../../DAO/ProvinciaDAO.php';
include_once '../../DAO/MunicipioDAO.php';
include_once '../../DAO/ComponenteDAO.php';

$objEscalao = new Escalao();
$objTIPSala = new TIPSala();
$objMunicipio = new Municipio();
$objComponente = new Componente();

$objEscalaoDAO = new EscalaoDAO('00tenancyschool');
$objTIPSalaDAO = new TIPSalaDAO('00tenancyschool');
$objProvinciaDAO = new ProvinciaDAO('00tenancyschool');
$objMunicipioDAO = new MunicipioDAO('00tenancyschool');
$objComponenteDAO = new ComponenteDAO('00tenancyschool');

$res6 = $objProvinciaDAO->buscarProvincias();
?>

<html>
    <head><title>Cad escalao</title></head>
    <body>
        <?php 
        if(isset($_POST['bt_env'])):
            $nome_escalao = $_POST['nome_escalao'];
            $objEscalao->setNome_escalao($nome_escalao);
            
            $res1 = $objEscalaoDAO->verificar($objEscalao);
            if($res1->rowCount() <= 0):
            $res = $objEscalaoDAO->salvar($objEscalao);
            if($res == "yes"):
               echo 'feito com sucesso'; 
            endif;
            else:
                echo 'ja cadastrou';
            endif;
        endif;
        ?>
        <h1> Cadastro de Escalao </h1>
        <form method="POST" action="">
            <input type="text" name="nome_escalao" required="" placeholder="Escalao"/>
            <button type="submit" name="bt_env">Enviar</button>
        </form>  
        
        
        
        <?php
        if(isset($_POST['bt_envS'])):
            $tipo = $_POST['tipo'];
            $objTIPSala->setTipo($tipo);
            $res = $objTIPSalaDAO->verificar($objTIPSala);
            if($res->rowCount() >= 1):
                echo "ja cadastrou";
            else:
                $res1 = $objTIPSalaDAO->salvar($objTIPSala);
                if($res1 == "yes"):
                    echo 'cadastro feito com sucesso';
                endif;
            endif;
        endif;
        ?>
         <h1> Cadastro de Tipos de Sala </h1>
        <form method="POST" action="">
            <input type="text" name="tipo" required="" placeholder="Tipo da Sala"/>
            <button type="submit" name="bt_envS">Enviar</button>
        </form>  
         
         
         <?php 
         if(isset($_POST['bt_envmuni'])):
             $id_provincia = $_POST['id_provincia'];
             $municipio = $_POST['municipio'];
             
             $objMunicipio->setMunicipio($municipio);
             $objMunicipio->setId_provincia($id_provincia);
             
             $res = $objMunicipioDAO->verificar($objMunicipio);
             if($res->rowCount() >= 1):
                 echo 'ja cadastrou';
             elseif($res->rowCount() <= 0):
                 $res1 = $objMunicipioDAO->salvar($objMunicipio);
                 if($res1 == "yes"):
                     echo 'cadastro feito com sucesso';
                 endif;
             endif;
         endif;
         ?>
         
         <h1> Cadastro de Municipios </h1>
        <form method="POST" action="">
            <select name="id_provincia" required="">
                <option value="">Provincia</option>
                <?php 
                while ($ver = $res6->fetch(PDO::FETCH_OBJ)):
                ?>
                <option value="<?php echo $ver->id_provincia;?>"><?php echo $ver->provincia; ?></option>
                <?php
                endwhile;
                ?>
            </select>
            <input type="text" name="municipio" required="" placeholder="Nome municipio"/>
            <button type="submit" name="bt_envmuni">Enviar</button>
        </form> 

<?php
if(addslashes(htmlspecialchars(isset($_POST['bt_envcomp'])))):

$componente = addslashes(htmlspecialchars($_POST['componente']));

$objComponente->setComponente($componente);

$res0 = $objComponenteDAO->buscar_ID($objComponente);
    if($res0->rowCount() >= 1):
        echo "Ja cadastrou";
    elseif($res0->rowCount() <= 0):
        $res = $objComponenteDAO->salvar($objComponente);
        if($res == "yes"):
        echo "Feito com successo!";
        endif;
    endif;
endif;
?>

        <h1>Cadastro de Componente</h1>
        <form method="POST" action="">
            <input type="text" name="componente" placeholder="Nome da Componente" required="" />
            <button type="submit" name="bt_envcomp">Enviar</button>
        </form> 
    </body>
</html>
