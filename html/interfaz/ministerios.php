<?
/*
 * Funcionamiento de las categorias de la página de Teen Latin Boys
 * @author Farez Prieto
 * @date 21 se septiembre de 2010
 */
require('core/PHPPaging.lib.php');
global $funciones;
global $core;
global $id;
$info_id	=	$funciones->infoId($_GET['hijo']);
$hijosid	=	$funciones->obtenerListado($_GET['hijo']);
$hijos		=	$funciones->obtenerListado($id);
?>

<div id="menuMinisterios">
                	<ul id="ulMinisterios">
						<?foreach($hijos as $listaMin){?>
							<?if($listaMin['id'] == $_GET['hijo']){?>
								<li class="liMs"><a href="index.php?id=<?=$listaMin['id_padre']?>&hijo=<?=$listaMin['id']?>" title="<?=$listaMin['titulo']?>"><?=$listaMin['titulo']?></a></li>
							<?}else{?>
								<li class="liM"><a href="index.php?id=<?=$listaMin['id_padre']?>&hijo=<?=$listaMin['id']?>" title="<?=$listaMin['titulo']?>"><?=$listaMin['titulo']?></a></li>
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
                                <div class="textoMensaje">
                                    <?=$info_id[0]['resumen']?>
                                </div>
                                 <?if($_GET['hijo'] != '1193'){?>
								<?
									if(count($hijosid) > 0){?>
	                               <!--div galeria de fotos-->
									<div id="galeriaFotos">
										<div class="panelGaleria">
											<div class="list_carousel">
												<ul id="foo2">
													<?foreach($hijosid as $fotos){?>
														<li class="fotosGaleria">
															<a href="images/<?=$fotos['imagen']?>" rel="shadowbox[galeria]" title="<?=$fotos['titulo']?>: <?=$fotos['pie_imagen']?>">
																<img src="images/<?=$fotos['imagen']?>" width="164px"/>
															</a>
														</li>
													<?}?>	
												</ul>
												<div class="clearfix"></div>
												<a id="flechaI" class="prev" href="#"></a>
												<a id="flechaD" class="next" href="#"></a>
												<div id="pager2" class="pager"></div>
											</div>
											
										</div>
									</div>	
									<!--Fin de la galeria de fotos-->
									<?}?>
								<?} ?>
                            </div>
                        </div>
                        
                        <div id="lateralMensajes">
	                        <?if($_GET['hijo'] == '1193'){?>
									<?
										if(count($hijosid) > 0){?>
		                               <!--div galeria de fotos-->
										<div id="galeriaFotos">
											<div class="panelGaleria">
												<div class="list_carousel">
													<ul id="foo2">
														<?foreach($hijosid as $fotos){?>
															<li class="fotosGaleria">
																<a href="images/<?=$fotos['imagen']?>" rel="shadowbox[galeria]" title="<?=$fotos['titulo']?>: <?=$fotos['pie_imagen']?>">
																	<img src="images/<?=$fotos['imagen']?>" width="164px"/>
																</a>
															</li>
														<?}?>	
													</ul>
													<div class="clearfix"></div>
													<a id="flechaI" class="prev" href="#"></a>
													<a id="flechaD" class="next" href="#"></a>
													<div id="pager2" class="pager"></div>
												</div>
												
											</div>
										</div>	
										<!--Fin de la galeria de fotos-->
										<?}?>
									<?} ?>
                        	<div class="panelInternoLat">
                            	<div id="fotoMinisterio">
                                	<img src="images/<?=$info_id[0]['imagen']?>" alt="Foto Ministerio <?=$info_id[0]['titulo']?>" width="275px"/>
                                </div>
                            </div>         
                            <div class="panelInternoLat contactoMin margin46">
                            	<h2>Contacto</h2>
                                <a href="mailto:<?=$info_id[0]['mail_autor']?>" title="Enviar mail a <?=$info_id[0]['mail_autor']?>"><?=$info_id[0]['mail_autor']?></a>
                            </div>   
                            <div class="contactoMin margin46">
                            	<h2>Contacto</h2>
                                <a href="mailto:<?=$info_id[0]['mail_autor']?>" title="Enviar mail a <?=$info_id[0]['mail_autor']?>"><?=$info_id[0]['mail_autor']?></a>
                            </div>              
                        	<div class="panelInternoLat"><img src="images/diseno/bannerDonacionInternoP.png" alt="Banner Donaci&oacute;n"/></div>
                            <div class="panelInternoLat"><img src="images/diseno/logoSometimientoInternoP.png" alt="Banner Donaci&oacute;n"/></div>
                        </div>
                        
                        
					</div>
                    <!-- fin centro cuerpo-->
                </div>
                <!--fin alineaCuerpo-->
                
				<?include(_PLANTILLAS."interfaz/pie.php");?>