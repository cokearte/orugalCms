<?
global $id;
global $db;
global $funciones;
$hijos13		=	$funciones->obtenerListado(13);
$info_id		=	$core->info_id;
$hijos		    =	$core->info_id_hijos;
?>
<!--AlineaCuerpo-->
				<div class="alineaCuerpo">
                	<div id="centroCuerpo">
                    	<div id="lateralMensajes">
                        	<div class="panelInternoLat margin46">
                            	<div id="menuMensajes">
                                	<div id="centroMenuMensajes">
                                    	<div id="fotoMenuMensajes"></div>
                                        <div id="contItemsMenuMensajes">
										<?foreach($hijos13 as $menuLat){?>
                                        	<div class="itemsMenuMensajes"><a href="?id=<?=$menuLat['id']?>" title="<?=$menuLat['titulo']?>"><?=$menuLat['titulo']?></a></div>
                                        <?}?>    
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        	<div class="panelInternoLat margin46"><img src="images/diseno/bannerDonacionInternoP.png" alt="Banner Donaci&oacute;n"/></div>
                            <div class="panelInternoLat"><img src="images/diseno/logoSometimientoInternoP.png" alt="Banner Donaci&oacute;n"/></div>
                        </div>
                        <div id="centroMensajes">
                        <?foreach($hijos as $listaHijos){?>
                        	<div class="contMensajes">
                            	<h3><?=$listaHijos['titulo']?></h3>
                                <div class="textoMensaje">
									<?if($listaHijos['tipo_contenido'] != 12 AND $listaHijos['tipo_contenido']!=58){?>
										<?
											$codigo	=	$listaHijos['contenido'];
											echo "<img src='http://img.youtube.com/vi/".$codigo."/1.jpg' style='width:100px;float:left'/>";
										?>
									<?}?>									
                                    <?=utf8_decode($listaHijos['resumen'])?>
                                </div>
                                <div class="botonesMensaje">
                                	<div class="botonesRedesMensaje">
                                    	<div class='btnRed'>
											<iframe src="http://www.wannabe.com.co/boton/btn.php?url=http://www.mmmbritalia.com&count=1&tipo=1&amp;width=450"  scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:25px;" allowTransparency="true"></iframe>
                                        </div>
                                        <div class='btnRed'>
										<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.mmmbritalia.com">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
										</div>
                                        <div class='btnRed'>
                                        	<div id="fb-root"></div>
											<script>(function(d, s, id) {
                                              var js, fjs = d.getElementsByTagName(s)[0];
                                              if (d.getElementById(id)) return;
                                              js = d.createElement(s); js.id = id;
                                              js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
                                              fjs.parentNode.insertBefore(js, fjs);
                                            }(document, 'script', 'facebook-jssdk'));</script>
                                            <div class="fb-like" data-send="false" data-layout="standard" data-width="150" data-show-faces="false" data-action="like" data-colorscheme="light"></div>
                                        </div>
                                        
                                    </div>
                                    <div class="botonesUtilidadesMensaje">
										<?if($listaHijos['tipo_contenido'] == 12){?>
											<?if($listaHijos['adjunto'] != ''){?>
												<a href="<?=$listaHijos['adjunto']?>" title="Descargar" target="_blank">Descargar</a> 
											<?}?>
										<?}elseif($listaHijos['tipo_contenido'] == 58){?>
											<?if($listaHijos['adjunto'] != ''){?>
												<a href="archivos/<?=$listaHijos['adjunto']?>" title="Descargar" target="_blank">Descargar</a> 
												<a  title="Escuchar">
													<object width="25" height="20" data="swf/player.swf" type="application/x-shockwave-flash">
														<param value="swf/player.swf" name="movie">
														<param value="mp3=archivos/<?=$listaHijos['adjunto']?>&amp;showslider=0&amp;width=25&amp;autoplay=true" name="FlashVars">
													</object>
												</a> 
											<?}?>
										<?}else{?>
											<a href="externos/video.php?codigo=<?=$listaHijos['contenido']?>"  rel="shadowbox;width=560;height=315" title="">Ver Video</a> 
										<?}?>
										<!--<a href="#" title="Descargar">Ver M&aacute;s</a>-->
									</div>
                                </div>
                            </div>
                         <?}?>   
                            
                        </div>
					</div>
                </div>
                <!--fin alineaCuerpo-->
				<?include(_PLANTILLAS."interfaz/pie.php");?>