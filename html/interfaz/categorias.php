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
if(isset($_GET['hijo']))
{
    $info_id	=	$funciones->infoId($_GET['hijo']);
    $hijosid	=	$funciones->obtenerListado($_GET['hijo']);
}
else
{
    $info_id   =   $funciones->infoId(1631);
    $hijosid    =   $funciones->obtenerListado(1631);
}
$hijos		=	$funciones->obtenerListado($id);
?>
<div id="eventos">
        
<div id="cont-eventos">
    <div id="titservicios">
        <h2><?php echo ucwords(strtolower(strip_tags($info_id[0]['titulo']))) ?></h2>
    </div>
<?php if(count($hijosid) > 0){ ?>
<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 960px;
        height: 456px; background: #ACDACB; overflow: hidden;">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 960px; height: 356px; overflow: hidden;">
            <?php foreach($hijosid  as $hijosFoto){ ?>
                <div>
                     <!--<a href="<?php echo _DOMINIO ?>images/<?php echo $hijosFoto['imagen'] ?>" style="border:none" rel="shadowbox[eventosInterna]" title="<?php echo utf8_encode($hijosFoto['titulo']) ?>">-->
                        <img u="image" src="<?php echo _DOMINIO ?>/images/<?php echo $hijosFoto['imagen'] ?>" />
                    <!--</a>-->
                    <!--<img u="thumb" src="img/alila/thumb-01.jpg" />-->
                </div>
            <?php } ?>
        </div>
        
        <!-- Arrow Navigator Skin Begin -->
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: 158px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: 158px; right: 8px;">
        </span>
        <!-- Arrow Navigator Skin End -->
        
        <!-- Thumbnail Navigator Skin Begin -->
        <div u="thumbnavigator" class="jssort01" style="position: absolute; width: 960px; height: 100px; left:0px; bottom: 0px;">
            <!-- Thumbnail Item Skin Begin -->
            <div u="slides" style="cursor: move;">
                <div u="prototype" class="p" style="position: absolute; width: 72px; height: 72px; top: 0; left: 0;">
                    <div class=w><thumbnailtemplate style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;"></thumbnailtemplate></div>
                    <div class=c>
                    </div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- Thumbnail Navigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">jQuery Carousel</a>
    </div>
<?php }else{ ?>
<div id="slider1_container" style="position: relative; top: 0px; left: 0px;padding:20px; width: 920px;background: #ACDACB; overflow: hidden;text-align:center;color:#6b4d46;font-weight:bold">        
    No hay galer&iacute;as creadas para este servicio.
</div>
<?php } ?>

<section class="ib-container" id="ib-container">
    <?php foreach($hijos as $listado){ 
           $titulo  =   str_replace('á','a',strtolower(strip_tags(utf8_decode($listado['titulo']))));
           $titulo  =   str_replace('é','e',$titulo);
           $titulo  =   str_replace('í','i',$titulo);
           $titulo  =   str_replace('ó','o',$titulo);
           $titulo  =   str_replace('ú','u',$titulo);
           $titulo  =   str_replace('ñ','n',$titulo);
           $titulo  =   str_replace('Á','A',$titulo);
           $titulo  =   str_replace('É','E',$titulo);
           $titulo  =   str_replace('Í','I',$titulo);
           $titulo  =   str_replace('Ó','O',$titulo);
           $titulo  =   str_replace('Ú','U',$titulo);
           $titulo  =   str_replace('Ñ','N',$titulo);
           $titulo  =   str_replace(' ','-',$titulo);
           $titulo  =   str_replace('.','',$titulo);
           $titulo  =   str_replace(',','',$titulo);
    ?>  

        <article>
            <header>
                <h3>
                    <a title="<?php echo strip_tags(utf8_decode($listado['titulo'])) ?>" href="<?php echo $titulo ?>-<?php echo $listado['id'] ?>">
                        <?php echo strip_tags($listado['titulo']) ?>
                    </a>
                </h3>
                <span></span>
            </header>
            <p>
                <a title="<?php echo strip_tags($listado['titulo']) ?>" href="<?php echo $titulo ?>-<?php echo $listado['id'] ?>" style="color:auto">
                    <?php echo strip_tags(utf8_decode($listado['resumen'])) ?>
                </a>
                </p>
        </article>
    <?php } ?>
</section>
</div>

</div>

 <div id="sloganhome">
  <div id="contfored" style=" position:relative; width:100%;">
        <div id="topDiv" style="height: 150px; background:url(img/fotocolor.JPG)">
    
    <div style="position: absolute; width: 35%; margin-left: 30%; top: 30%; text-align: center; padding: 1em 0; color:#FFFFFF;">
    
    <h1 style="font-family: sans-serif; border-bottom:#FFF solid 1px; border-top:#FFF solid 1px; padding:8px 0;">TRABAJAMOS PENSANDO EN TI</h1>
    <p style=" margin:10px 0 0 0; font-size:16px;">EXCLUSIVIDAD - CALIDAD - CUMPLIMIENTO</p>
    
    </div>
    
    </div>
</div>
</div>




  <script type="text/javascript" src="js/jssor.core.js"></script>
    <script type="text/javascript" src="js/jssor.utils.js"></script>
    <script type="text/javascript" src="js/jssor.slider.js"></script>
  
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(function() {
                
                var $container  = $('#ib-container'),
                    $articles   = $container.children('article'),
                    timeout;
                
                $articles.on( 'mouseenter', function( event ) {
                        
                    var $article    = $(this);
                    clearTimeout( timeout );
                    timeout = setTimeout( function() {
                        
                        if( $article.hasClass('active') ) return false;
                        
                        $articles.not( $article.removeClass('blur').addClass('active') )
                                 .removeClass('active')
                                 .addClass('blur');
                        
                    }, 65 );
                    
                });
                
                $container.on( 'mouseleave', function( event ) {
                    
                    clearTimeout( timeout );
                    $articles.removeClass('active blur');
                    
                });
            
            });
        </script>
  
  <script>
        var contfored = document.getElementById("contfored");
        var speed = 1.5;
        
        window.onscroll = function()
        {
        var yOffset = window.pageYOffset;
        topDiv.style.backgroundPosition = "0px "+ (yOffset / speed) + "px";
        }
</script>
<script>

        jQuery(document).ready(function ($) {

            var _SlideshowTransitions = [
            //Fade in L
                {$Duration: 1200, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
            //Fade out R
                , { $Duration: 1200, $SlideOut: true, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
            //Fade in R
                , { $Duration: 1200, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 2, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
            //Fade out L
                , { $Duration: 1200, $SlideOut: true, $FlyDirection: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }

            //Fade in T
                , { $Duration: 1200, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade out B
                , { $Duration: 1200, $SlideOut: true, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade in B
                , { $Duration: 1200, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 8, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade out T
                , { $Duration: 1200, $SlideOut: true, $FlyDirection: 4, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }

            //Fade in LR
                , { $Duration: 1200, $Cols: 2, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
            //Fade out LR
                , { $Duration: 1200, $Cols: 2, $SlideOut: true, $FlyDirection: 1, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
            //Fade in TB
                , { $Duration: 1200, $Rows: 2, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade out TB
                , { $Duration: 1200, $Rows: 2, $SlideOut: true, $FlyDirection: 4, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }

            //Fade in LR Chess
                , { $Duration: 1200, $Cols: 2, $During: { $Top: [0.3, 0.7] }, $FlyDirection: 4, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade out LR Chess
                , { $Duration: 1200, $Cols: 2, $SlideOut: true, $FlyDirection: 8, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade in TB Chess
                , { $Duration: 1200, $Rows: 2, $During: { $Left: [0.3, 0.7] }, $FlyDirection: 1, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }
            //Fade out TB Chess
                , { $Duration: 1200, $Rows: 2, $SlideOut: true, $FlyDirection: 2, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $Opacity: 2 }

            //Fade in Corners
                , { $Duration: 1200, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $FlyDirection: 5, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2 }
            //Fade out Corners
                , { $Duration: 1200, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $FlyDirection: 5, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $ScaleHorizontal: 0.3, $ScaleVertical: 0.3, $Opacity: 2 }

            //Fade Clip in H
                , { $Duration: 1200, $Delay: 20, $Clip: 3, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade Clip out H
                , { $Duration: 1200, $Delay: 20, $Clip: 3, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade Clip in V
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            //Fade Clip out V
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                ];

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 3,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 3

                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $ArrowKeyNavigation: true,                          //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 800,                                //Specifies default duration (swipe) for slide in milliseconds

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                },

                $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $SpacingX: 8,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 10,                             //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 360                          //[Optional] The offset position to park thumbnail
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$SetScaleWidth(Math.max(Math.min(parentWidth, 960), 300));
                else
                    window.setTimeout(ScaleSlider, 30);
            }

            ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }
            //responsive code end
        });
    </script>
    <script type="text/javascript">
Shadowbox.init();
</script>