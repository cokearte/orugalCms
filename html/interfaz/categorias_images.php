<?
/*
 * Funcionamiento de las categorias en imagen de teen latin
 * @author Farez Prieto
 * @date 20 se Octubre de 2010
 */
require('core/PHPPaging.lib.php');
global $funciones;
global $core;
global $id;
$info_id	=	$core->info_id;
$hijos		=	$core->info_id_hijos;
?>
 <!--AlineaCuerpo-->
				<div class="alineaCuerpo">
                	<div id="centroCuerpo">
	                    <div class="contFotos">	
                        	<?=$info_id[0]['resumen']?>
                        </div>
						
                    	<div class="contFotos">
							<?
								$contador	=	0;
								foreach($hijos as $gal){
								$contador++;
							?>
								<a href="images/<?=$gal['imagen']?>" rel="shadowbox[galeria]" >
								<div class="fotoGaleriaInt" style="background:url(externos/Thumb.php?img=../images/<?=$gal['imagen']?>&tamano=300) no-repeat 50% 50%;">
									<!-- <div class="fotoDescInt">
											<?=$gal['titulo']?>
									</div>-->
								</div>
								</a>	
							<?
								if($contador == 4)
								{
									?>
										</div>
										<div class="contFotos">
									<?
									$contador	=	0;
								}
							}
							?>	
                        </div>
						
						
                        <div class="contFotos">
                        	<div class="btnRed">
	                            <iframe src="http://www.wannabe.com.co/boton/btn.php?url=http://www.mmmbritalia.com/mmmbritalia/index.php?id=1190&count=1&tipo=1&amp;width=150"  scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:25px;" allowTransparency="true"></iframe>
	                        </div>
                        
                        <div class="btnRed">
                            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.mmmbritalia.com/mmmbritalia/index.php?id=1190">Tweet</a>
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
                </div>
                <!--fin alineaCuerpo-->

                <div class="alineaCuerpo">
                	<div id="bannersInternos1"><img src="images/diseno/bannerDinacionInterno1.png" alt="Banner de donaci&oacute;n"/></div>
                </div>
				
				<?include(_PLANTILLAS."interfaz/pie.php");?>