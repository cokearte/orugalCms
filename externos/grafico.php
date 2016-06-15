<?php
ini_set("display_errors",0);
require("../../config/configuracion.php");
require("../../config/conexion_2.php");
/*include("jpgraph/src/jpgraph.php");
include("jpgraph/src/jpgraph_bar.php");*/
include "charts.php";
global $db;
extract($_GET);
$info_pregunta	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE id=%s AND visible=1 AND eliminado=0",$pregunta));
//consulto los hijos de la pregunta que se esta validando
$query_respuestas	=	$db->GetAll(sprintf("SELECT * FROM principal WHERE id_padre=%s AND visible=1 AND eliminado=0",$pregunta));
//$arreglo	=	array();
$datos_puntaje	=	'';
$titulos		=	'';
foreach($query_respuestas as $resultados)
{
	$datos_puntaje	.=	$resultados['puntaje'].",";
	$titulos		.=	$resultados['titulo'].",";
}
$datos_puntaje = substr($datos_puntaje,0,strlen($datos_puntaje)-1);
$titulos = substr($titulos,0,strlen($titulos)-1);
$arreglo		=  explode(",",$datos_puntaje);
$titulo_final	=	explode(",",$titulos);

$chart [ 'chart_data' ] = array (array ( "",'Juega\r y\r gana',    'Centro\r de\r Negocios',    'Novedades',     'Pesima'),
                                 array ( "Como le Parece la web",   100,     80,     60,     40  ));
$chart [ 'chart_type' ] = "3d column";
/*$chart [ 'chart_border' ] = array ( 'top_thickness'=>0,
 								    'bottom_thickness'=>4,
									'left_thickness'=>4, 
									'right_thickness'=>4);*/
$chart [ 'canvas_bg' ] =	"000000";


$chart [ 'axis_category' ] = array ('size'          =>  10,
									'orientation'   =>  'horizontal',
									'font'          =>  'Arial', 
                                    'bold'          =>  'true', 
                                    'size'          =>  14, 
                                    'color'         =>  'ffffff',);//textos inferiores

$chart [ 'axis_value' ]= array ('size'          =>  10,
								'font'          =>  'Arial', 	
                                'bold'          =>  'true', 
                                'size'          =>  14, 
                                'color'         =>  'ffffff',
								'orientation'   =>  'horizontal' );//textos laterales



$chart [ 'chart_grid_h' ] = array (   'thickness'  =>  '2',
                                      'color'      =>  '000000',
                                      'alpha'      =>  20,
                                      'type'       =>  'solid');

$chart [ 'chart_grid_v' ]= array (   'thickness'  =>  '2',
                                      'color'      =>  '000000',
                                      'alpha'      =>  20,
                                      'type'       =>  'solid');

$chart [ 'chart_pref' ] = array (                                 
                                    //3d charts preferences
                                    'rotation_x'      =>  0,  
                                    'rotation_y'      =>  20 
                                ); 
$chart [ 'series_color' ] = array ('E5990C'); 
                                
                                
                                   
$chart [ 'legend_label' ] = array (   'bullet'  =>  'square', 
                                      'bold'    =>  true, 
                                      'size'    =>  14, 
                                      'color'   =>  'ffffff', 
                                      'alpha'   =>  100
                                  ); 
                                   




//send the new data to charts.swf
SendChartData ( $chart );
	
	/*
	$datax 	=	$titulo_final;
	//var_dump($arreglo);
	//die("Que paso?");
	$datos1 = $arreglo;
	$grafico = new Graph(600, 500, "auto");
	$grafico->SetScale("textlin");
	$grafico->title->Set($info_pregunta[0]['titulo']);
	$grafico->xaxis->title->Set("Opciones");
	$grafico->yaxis->title->Set("Votos");
	$grafico->xaxis->SetTickLabels($datax);
	//$grafico->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
	$grafico->xaxis->SetLabelAngle(45);
	
	
	$barplot1 = new BarPlot($datos1);
	$barplot1->SetColor("red");
	// Un gradiente Horizontal de rojo a azul
	$barplot1->SetFillGradient("#D00000", "#560000", GRAD_HOR);
	//$barplot1->SetFillGradient("#994747", "#7F0000", GRAD_VER);
	// 25 pixeles de ancho para cada barra
	$barplot1->SetWidth(25);
	$grafico->Add($barplot1);
	$grafico->Stroke();*/

?>