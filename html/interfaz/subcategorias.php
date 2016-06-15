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
$info_id	=	$core->info_id;
$hijos		=	$core->info_id_hijos;
?>
<!--AlineaCuerpo-->
				<div class="alineaCuerpo">
                	<div id="centroCuerpo">
                		<div id="contMisiones">
                        	<div class="textoMisiones">
                        	<?=$info_id[0]['resumen'] ?>
                            </div>
                            <!--contenedor de la mision-->
                            <div class="contMision">
                            	<div class="contFotoMision"><div class="fotoMision"></div></div>
                                <div class="textoMision">
                                	<h3>Vichada</h3>
                                	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam feugiat, augue sed vulputate cursus, velit nulla convallis tortor, vel sollicitudin dui nisi sed ante. Fusce semper fringilla ipsum ac feugiat. Donec eget turpis tellus, et rutrum leo. Phasellus volutpat leo sed purus interdum eget rutrum ante vehicula. Donec in arcu vel nisi condimentum viverra. Nulla mi dolor, bibendum vel mollis ac, congue eget dui. Ut nisl quam, venenatis sodales sagittis dapibus, sagittis vitae urna. Praesent vehicula mi mauris.</p>
                                </div>
                                <div class="botonesMi">
                                	<div class="botonesRedesMi">
                                    	<div class="btnRed">
                                        	<iframe src="http://www.wannabe.com.co/boton/btn.php?url=http://www.mmmbritalia.com&count=1&tipo=1&amp;width=150"  scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:25px;" allowTransparency="true"></iframe>
                                        </div>
                                        <div class="btnRed">
                                        	<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.mmmbritalia.com">Tweet</a>
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
                                    <div class="botonesVerMasMi"><a href="submision.html">Ver Misiones</a></div>
                                </div>
                            </div>
                            <!--fin contenedor de la mision-->
                            
                            
                            <!--contenedor de la mision-->
                            <div class="contMision">
                            	<div class="contFotoMision"><div class="fotoMision"></div></div>
                                <div class="textoMision">
                                	<h3>Vichada</h3>
                                	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam feugiat, augue sed vulputate cursus, velit nulla convallis tortor, vel sollicitudin dui nisi sed ante. Fusce semper fringilla ipsum ac feugiat. Donec eget turpis tellus, et rutrum leo. Phasellus volutpat leo sed purus interdum eget rutrum ante vehicula. Donec in arcu vel nisi condimentum viverra. Nulla mi dolor, bibendum vel mollis ac, congue eget dui. Ut nisl quam, venenatis sodales sagittis dapibus, sagittis vitae urna. Praesent vehicula mi mauris.</p>
                                </div>
                                <div class="botonesMi">
                                	<div class="botonesRedesMi">
                                    	<div class="btnRed">
                                        	<iframe src="http://www.wannabe.com.co/boton/btn.php?url=http://www.mmmbritalia.com&count=1&tipo=1&amp;width=150"  scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:25px;" allowTransparency="true"></iframe>
                                        </div>
                                        <div class="btnRed">
                                        	<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.mmmbritalia.com">Tweet</a>
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
                                    <div class="botonesVerMasMi"><a href="submision.html">Ver Misiones</a></div>
                                </div>
                            </div>
                            <!--fin contenedor de la mision-->
                            
                            
                            <!--contenedor de la mision-->
                            <div class="contMision">
                            	<div class="contFotoMision"><div class="fotoMision"></div></div>
                                <div class="textoMision">
                                	<h3>Vichada</h3>
                                	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam feugiat, augue sed vulputate cursus, velit nulla convallis tortor, vel sollicitudin dui nisi sed ante. Fusce semper fringilla ipsum ac feugiat. Donec eget turpis tellus, et rutrum leo. Phasellus volutpat leo sed purus interdum eget rutrum ante vehicula. Donec in arcu vel nisi condimentum viverra. Nulla mi dolor, bibendum vel mollis ac, congue eget dui. Ut nisl quam, venenatis sodales sagittis dapibus, sagittis vitae urna. Praesent vehicula mi mauris.</p>
                                </div>
                                <div class="botonesMi">
                                	<div class="botonesRedesMi">
                                    	<div class="btnRed">
                                        	<iframe src="http://www.wannabe.com.co/boton/btn.php?url=http://www.mmmbritalia.com&count=1&tipo=1&amp;width=150"  scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:25px;" allowTransparency="true"></iframe>
                                        </div>
                                        <div class="btnRed">
                                        	<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.mmmbritalia.com">Tweet</a>
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
                                    <div class="botonesVerMasMi"><a href="submision.html">Ver Misiones</a></div>
                                </div>
                            </div>
                            <!--fin contenedor de la mision-->
                            
						</div>
					</div>
                </div>
                <div class="alineaCuerpo">
                	<div id="bannersInternos1"><img src="images/diseno/bannerDinacionInterno1.png" alt="Banner de donaci&oacute;n"/></div>
                </div>
                <!--alineaCuerpoPie-->
				<?include(_PLANTILLAS."interfaz/pie.php");?>
