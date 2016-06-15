<?
ini_set('display_errors',0);
require('core/PHPPaging.lib.php');
global $funciones;
global $core;
global $id;
global $migas;
//$info_id	=	$core->info_id;
$hijos		=	$core->info_id_hijos;
//hijos areas comunes
$listado	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE id_padre='%s' AND id not in(%s)",16,$id));
?>
<div id="infoint">
    	<div id="titint">
        	<div class="vineta"><img src="images/diseno/archivo.png" width="21" height="21" /></div>
            <div class="texttit2">
          <h1>centro de negocios</h1></div>
        </div>
        <div id="titinternas"><?=$info_id[0]['titulo'] ?></div>
        <div id="internas">
        	<div id="continternas">
            	<div id="fotointernas"><img src="images/<?=$info_id[0]['imagen']?>" width="209" height="117" /></div>
                <div id="texinterna"><?=$info_id[0]['resumen']?></div>
                <div id="texinterna">
                	<a href="Bulevar.ppsx" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('rol','','images/diseno/razon2.png',1)">
                		<img src="images/diseno/razon1.png" name="Image12"  border="0" id="rol" />
                	</a>
                </div>
                
            </div>
          <div id="guia">
        		<?
        			$contador	=	0;
        			foreach($hijos as $datos){ 
        				if(($contador%2)==0)
        				{
        					$clase	=	"guiaint";
        				}
        				else
        				{
        					$clase	=	"guiaint2";
        				}
        		?>
		             <div class="<?=$clase?>">
		           	  	<div id="titg"><?=$datos['titulo']?></div>
		                <div id="vertienda"><a href="index.php?id=<?=$datos['id'] ?>">ver mas...</a></div>
		            </div>
	            <?
					$contador++;}
				 ?>
             </div>
        </div>
      <div id="meninternas">
        	<div id="contac">
            	<div class="vineta"><img src="images/diseno/contactenos.png" width="26" height="24" /></div>
            	<div class="texttit2">
            		<h1><a href="index.php?id=337" style="color:#fff;text-decoration:none">contactenos</a></h1>
            	</div>
            </div>
            <div id="menareas">
            	<ul id="menupro"> 
            		<?foreach($listado as $lateral){ ?>
         	 			<li><a href="index.php?id=<?=$lateral['id'] ?>"><?=$lateral['titulo']?></a></li>
         	 		<?} ?>	
          		</ul>
        </div>
            <div id="empleo"><a href="index.php?id=502" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image12','','images/diseno/empleo2.png',1)"><img src="images/diseno/empleo1.png" name="Image12" border="0" id="Image12" /></a></div> 
       	  <div id="eventolateral"></div>
      </div>
    </div>