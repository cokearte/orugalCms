<?
ini_set('display_errors',0);
require('core/PHPPaging.lib.php');
global $funciones;
global $core;
global $id;
global $migas;
$datos_contenido	=	$core->info_id;
//hijos de la categoria noticias para hacer un regreso
$hijos_cat_noticias	=	$funciones->obtenerListado(15);
//consulto la noticias con el orden mas alto
$query_destacada	=	$db->Execute(sprintf("SELECT * FROM principal WHERE id_padre=%s AND destacado=1 AND eliminado=0 AND visible=1 ORDER BY fecha DESC",$id));
//echo sprintf("SELECT * FROM principal WHERE id_padre=%s AND destacado=1 AND eliminado=0 AND activo=1 ORDER BY fecha DESC",$id);
//si ese query me trae algo quiere decir que hay una noticia destacada
if($query_destacada->NumRows() > 0)
{
	$primera	=	$query_destacada->fields['id'];
}
else
{
	//sino trae nada quiere decir que no hay noticia destacada, asi que debo hacer un query que me traiga la de la fecha de creacion mas reciente
	$query_destacada_x_fecha	=	$db->Execute(sprintf("SELECT * FROM principal WHERE id_padre=%s AND eliminado=0 AND visible=1 ORDER BY fecha DESC",$id));
	$primera	=	$query_destacada_x_fecha->fields['id'];
}
//esta variable me dice que noticia se debe mostrar como la primera en el modulo
$visitada	=	(isset($_GET['visitada']))?$_GET['visitada']:$primera;
if(empty($visitada))
{
	echo "<script>alert('No hay noticias asignadas en esta categoria');document.location='index.php?id=13'</script>";
}
$info_id	=	$funciones->infoId($visitada);

$ssql	=	sprintf("SELECT * FROM principal WHERE id_padre=%s AND eliminado=0 AND id !=%s AND visible=1 ORDER BY fecha DESC",$id,$visitada);
$paging=new PHPPaging;
$paging->paginasAntes(6);
$paging->paginasDespues(6);
if($_GET['ver'])
{
	$e_ssql=mysql_query($ssql);
	$numver=mysql_num_rows($e_ssql);
}
else
{
	$numver=3;
}
$paging->porPagina($numver);
$paging->agregarConsulta($ssql);
$paging->ejecutar();
if(!$paging->numTotalRegistros())
 {
	$no_encon="No hay regitros con este criterio de b&uacute;squeda!!!";
}

$links = $paging->fetchNavegacion();

$fechaEx1	=	explode(" ",$info_id[0]['fecha']);
$fechaEx2	=	explode("-",$fechaEx1[0]);
?>
<div id="menuMinisterios">
                	<ul id="ulMinisterios">
						<?foreach($hijos_cat_noticias as $hijosNot){?>
							<?if($hijosNot['id'] == $id){?>
								<li class="liMs"><a href="index.php?id=<?=$hijosNot['id']?>" title=""><?=$hijosNot['titulo']?></a></li>
							<?}else{?>
								<li class="liM"><a href="index.php?id=<?=$hijosNot['id']?>" title=""><?=$hijosNot['titulo']?></a></li>
							<?}?>
						<?}?>
                    </ul>
                </div>
	            <!--AlineaCuerpo-->
				<div class="alineaCuerpo">
                <!--centro cuerpo-->
                	<div id="centroCuerpo">
                        <div id="centroMensajes">
                            <div class="contMensajes">
                            	<h3><?=$info_id[0]['titulo']?></h3>
                                <h4><?=$fechaEx2[2]?> de <?=$funciones->TraducirMes($fechaEx2[1])?> de <?=$fechaEx2[0]?></h4>
                                <div class="textoMensaje">
                                	<img src="images/<?=$info_id[0]['imagen']?>" width="288px"/>
                                    <?=$info_id[0]['resumen']?>
                                </div>
                            </div>
                            <div class="contFotos">
                        	<div class="btnRed">
	                            <iframe src="http://www.wannabe.com.co/boton/btn.php?url=http://www.mmmbritalia.com/index.php?id=<?=$id?>&visitada=<?=$info_id[0]['id']?>&count=1&tipo=1&amp;width=150"  scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:25px;" allowTransparency="true"></iframe>
	                        </div>
                        
                        <div class="btnRed">
                            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.mmmbritalia.com/index.php?id=<?=$id?>&visitada=<?=$info_id[0]['id']?>">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                        </div>
                        
                        <div class="btnRed">
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-like" data-send="false" data-layout="standard" data-width="450" data-show-faces="false" data-action="like" data-colorscheme="light"></div>
                        </div>
                        </div>
                            
                        </div>
                        
                        <div id="lateralMensajes">      
                        	<div class="panelInternoLat margin44"><h3>M&aacute;s eventos</h3></div>
                            <div class="panelInternoLat">
                            <?
							while($rew = $paging->fetchResultado())
							{
							$fechaSa1	=	explode(" ",$rew['fecha']);
							$fechaSa2	=	explode("-",$fechaSa1[0]);
							?>
                            	<div class="miniNoticia">
                                	<h3><?=$rew['titulo']?></h3>
                                    <h4><?=$fechaSa2[2]?> de <?=$funciones->TraducirMes($fechaSa2[1])?> de <?=$fechaSa2[0]?></h4>
                                    <div class="contMiniNoticia">
                                    	<div class="fotoMiniNoticia" style="background:url(externos/Thumb.php?img=../images/<?=$rew['imagen']?>&tamano=100) no-repeat 50% 50%;"></div>
										<div class="textoMiniNoticia"><?=substr($rew['resumen'],0,150)?>...</div>
                                    </div>
                                    <div class="contMiniNoticia">
                                    	<a href="index.php?id=<?=$id?>&visitada=<?=$rew['id']?>">Ver Evento</a>
                                    </div>
                                </div>
								<?}?>
								<div class="paginador">
                                <?
									$links	 = $paging->fetchNavegacion();
									echo $links;
								?>
								</div>
                            </div>
                        </div>
                        
                        
					</div>
                    <!-- fin centro cuerpo-->
                </div>
                <!--fin alineaCuerpo-->
                
                
                <div class="alineaCuerpo">
                	<div id="bannersInternos1"><img src="images/diseno/bannerDinacionInterno1.png" alt="Banner de donaci&oacute;n"/></div>
                </div>
                
                <!--alineaCuerpoPie-->
				<?include(_PLANTILLAS."interfaz/pie.php");?>