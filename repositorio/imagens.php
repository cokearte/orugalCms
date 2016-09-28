<?php 
session_start();
require("../config/configuracion.php");
require("../config/conexion_2.php");
global $db;



ini_set("display_errors",0);
if(!isset($_SESSION['login']))
{
	include("rest.php");
}
else
{

if(isset($_GET['caja']))
{
	$_SESSION['caja'] =	$_GET['caja']; 
}	
if(isset($_GET['ml']))
{
	$_SESSION['multiple'] =	$_GET['ml']; 
}
?>

<style>
	a{
		text-decoration:none;
	}
	#imagenes{width:990px;height:350px;background:#fff;color:#000;overflow:auto}
	.tabla{background:#fff;width:100%}
	.tabla tr{border:1px solid red}.table > tbody > tr > td {
	     vertical-align: middle;
	}

	img{image-orientation: from-image;}
</style>
<script>
function poner(dato,caja)
{
	if(caja=='imagen')
	{
		window.opener.document.form.imagen.value=dato;	
	}
	else if(caja=='imagen2')
	{
		window.opener.document.form.imagen2.value=dato;	
	}
	else if(caja=='imagen3')
	{
		window.opener.document.form.imagen3.value=dato;	
	}
	else if(caja=='imagen4')
	{
		window.opener.document.form.imagen4.value=dato;	
	}
	else if(caja=='imagen5')
	{
		window.opener.document.form.imagen5.value=dato;	
	}
	window.opener.mostrar(dato,caja);
	window.close();
	
}
function quitarFoto(dato,file,e)
{
	$.ajax({
        url: "ajax.php",
        data: "accion=1&idFile="+file+"&dato="+dato+"&mov=0",
        type: "POST",
        dataType:'json',
        success:function(data)
        {
			$(e).remove();
			if(data.datos.length == 0)
			{
				location.reload();
				$("#tabOculta").addClass("hidden")
			}
        },
        error:function(e) 
        {
           
        }
    });
}
function selFoto(dato,file,e)
{
	if($(e).hasClass('btn-warning'))
	{
		$(e).removeClass('btn-warning');
		$(e).removeClass('glyphicon glyphicon-remove');
		$(e).addClass('glyphicon glyphicon-ok');

		$.ajax({
	        url: "ajax.php",
	        data: "accion=1&idFile="+file+"&dato="+dato+"&mov=0",
	        type: "POST",
        	dataType:'json',
	        success:function(data)
	        {
				if(data.datos.length == 0)
				{
					location.reload();
					$("#tabOculta").addClass("hidden")
				}
				else
				{
					$("#tabOculta").removeClass("hidden")
				}

				location.reload();
	        },
	        error:function(e) 
	        {
	           
	        }
	    });
	}
	else
	{
		$(e).addClass('btn-warning');
		$(e).addClass('glyphicon glyphicon-remove');

		$.ajax({
	        url: "ajax.php",
	        data: "accion=1&idFile="+file+"&dato="+dato+"&mov=1",
	        type: "POST",
       		dataType:'json',
	        success:function(data)
	        {
				if(data.datos.length == 0)
				{
					location.reload();
					$("#tabOculta").addClass("hidden")
				}
				else
				{
					$("#tabOculta").removeClass("hidden")
				}

				location.reload();
	        },
	        error:function(e) 
	        {

	        }
	    });
	}
}
</script>
<script>
	function borrar_archivo(archivo,dir,id,padre)
	{

		swal(
		{   
			title: "Eliminar archivo",   
			text: "¿Está seguro que desea borrar el archivo <strong>" + archivo+"</strong>?",   
			type: "info",   
			html:true,
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "Eliminar",   
			closeOnConfirm: false 
		},
			function(isConfirm)
			{   
				if (isConfirm) 
				{     
					swal({
						title:"Archivo eliminado!",
						text:"El archivo "+archivo+" ha sido eliminado con éxito",
						type:"success"
					},
					function(){
						window.location	="carga.php?archivo="+archivo+"&dire="+dir+"&idFile="+id+"&padre="+padre+"&dir="+padre;
					});   
				} 
			}

		);


		/*if(confirm("Esta seguro que desea borrar el archivo " + archivo) == true)
		{
			window.location	="carga.php?archivo="+archivo+"&dire="+dir+"&idFile="+id+"&padre="+padre+"&dir="+padre;
		}
		else
		{
			return true;
		}*/
	}
</script>
<?
session_start();
//capturo el directorio a examinar
$dir	=	(isset($_GET['dir']))?$_GET['dir']:'1';
//abro el directorio

//var_dump($_SESSION['galeria']);

//traigo las carpetas iniciales
$infoFolderActual	=	$db->GetAll(sprintf("SELECT * FROM repositorioimagenes WHERE idFile=%s AND eliminado=0",$dir));

$query 		 = sprintf("SELECT * FROM repositorioimagenes WHERE idpadre=%s AND eliminado=0 ORDER BY tipo ASC",$dir);
$directorios = $db->GetAll($query);


$contador=0;
$carpetas = array();
$archivos = array();
$carpetasRest = array("diseno",".");
$archivosRest = array("index.php");



$pintado    =  '<br><table class="table table-striped table-responsive">';

$pintado   .= '<thead>';
	$pintado   .= '<tr>';
		$pintado   .= '<th  class="text-center" colspan="3">Consultando los archivos de la carpeta '.$infoFolderActual[0]['nombre'].'</th>';
	$pintado   .= '</tr>';
	$pintado   .= '<tr>';
		$pintado   .= '<th  class="text-left" colspan="2">NOMBRE</th>';
		$pintado   .= '<th  class="text-center">TAMA&Ntilde;O</th>';
		$pintado   .= '<th  class="text-center">TIPO</th>';
		$pintado   .= '<th  class="text-center">ACCIONES</th>';
	$pintado   .= '</tr>';
$pintado   .= '</thead>';	
$pintado   .= '<tbody>';
if($dir != 1)
	{
		$icon = '<span class="glyphicon glyphicon-arrow-up" style="font-size:1.8em"></span>';
		$pintado   .= '<tr>';
			$pintado   .= '<td>';
				$pintado   .= "<a href='?dir=".$infoFolderActual[0]['idpadre']."'  class='pull-left'>";
					$pintado   .= $icon;
				$pintado   .= "</a>";
			$pintado   .= '</td>';
			$pintado   .= '<td>';
				$pintado   .= "<a href='?dir=".$infoFolderActual[0]['idpadre']."'  class='pull-left'>";
					$pintado   .= "Subir un nivel";
				$pintado   .= "</a>";
			$pintado   .= '</td>';
			$pintado   .= '<td class="text-center">';
					$pintado   .= '--';
			$pintado   .= '</td>';
			$pintado   .= '<td class="text-center">';
					$pintado   .= '';
			$pintado   .= '</td>';
			$pintado   .= '<td class="text-center">';
					$pintado   .= '';
			$pintado   .= '</td>';
		$pintado   .= '<tr>';
	}
//count($carpetas);echo "sdsasd";
foreach($directorios as $reco) 
{


	if($reco['tipo'] == 1)//carpetas
	{
		
			
		$icon = '<span class="glyphicon glyphicon-folder-close" style="font-size:1.8em"></span>';
		$pintado   .= '<tr>';
			$pintado   .= '<td>';
				$pintado   .= "<a href='?dir=".$reco['idFile']."'  class='pull-left'>";
					$pintado   .= $icon;
				$pintado   .= "</a>";
			$pintado   .= '</td>';
			$pintado   .= '<td>';
				$pintado   .= "<a href='?dir=".$reco['idFile']."'  class='pull-left'>";
					$pintado   .= $reco['nombre'];
				$pintado   .= "</a>";
			$pintado   .= '</td>';
			$pintado   .= '<td class="text-center">';
					$pintado   .= '--';
			$pintado   .= '</td>';
			$pintado   .= '<td class="text-center">';
					$pintado   .= mime_content_type('../'.$rutavisitada.$reco['nombre']);
			$pintado   .= '</td>';
			$pintado   .= '<td class="text-center">';
					$pintado   .= '';
			$pintado   .= '</td>';
		$pintado   .= '<tr>';
		
	}
	else//archivos
	{
		$ruta_final = str_replace('../images/','',$dir);
		$pintado   .= '<tr>';
			$pintado   .= '<td width="80px">';
				if($_SESSION['multiple'] == 0)
				{
					$pintado   .= "<a style='cursor:pointer' onclick='poner(\"../".$rutavisitada.$reco['nombre']."\",\"".$_SESSION['caja'] ."\")' class='pull-left'>";
				}
					
						$pintado   .= '<img width="50px" height="50px" class="thumbnail" style="float:left" src="../'.$rutavisitada.$reco['nombre'].'" >';
				if($_SESSION['multiple'] == 0)
				{		
					$pintado   .= "</a>";
				}
			$pintado   .= '</td>';
			$pintado   .= '<td  class="text-left" valign="center">';

				if($_SESSION['multiple'] == 0)
				{
					$pintado   .= "<a style='cursor:pointer' onclick='poner(\"../".$rutavisitada.$reco['nombre']."\",\"".$_SESSION['caja'] ."\")' class='pull-left'>";
				}	
						$pintado   .= $reco['nombre'];

				if($_SESSION['multiple'] == 0)
				{		
					$pintado   .= "</a>";
				}
			$pintado   .= '</td>';
			$pintado   .= '<td  class="text-center" valign="center">';
					$pintado   .= FileSizeConvert(filesize('../'.$rutavisitada.$reco['nombre']));
			$pintado   .= '</td>';
			$pintado   .= '<td  class="text-center" valign="center">';
					$pintado   .= mime_content_type('../'.$rutavisitada.$reco['nombre']);
			$pintado   .= '</td>';
			$pintado   .= '<td align="center">';
					$pintado   .= "<button title='Eliminar archivo' onClick='borrar_archivo(\"".$reco['nombre']."\",\"../".$rutavisitada."\",\"".$reco['idFile']."\",\"".$reco['idpadre']."\")' class='btn btn-danger btn-sm glyphicon glyphicon-trash'></button>";
					if($_SESSION['multiple'] == 0)
					{
				   		$pintado   .= "&nbsp;<button title='Usar el archivo' onclick='poner(\"../".$rutavisitada.$reco['nombre']."\",\"".$_SESSION['caja'] ."\")' class='btn btn-primary btn-sm glyphicon glyphicon-ok'></button>";
			   		}
			   		else
			   		{
			   			if(isset($_SESSION['galeria'][$reco['idFile']]))
			   			{
			   				$pintado   .= "&nbsp;<button title='Usar el archivo' onclick='selFoto(\"../".$rutavisitada.$reco['nombre']."\",\"".$reco['idFile']."\",this)' class='selArchivo btn btn-warning btn-sm glyphicon glyphicon-remove'></button>";	
			   			}
			   			else
			   			{
			   				$pintado   .= "&nbsp;<button title='Usar el archivo' onclick='selFoto(\"../".$rutavisitada.$reco['nombre']."\",\"".$reco['idFile']."\",this)' class='selArchivo btn btn-default btn-sm glyphicon glyphicon-ok'></button>";		
			   			}
			   			
			   		}

			$pintado   .= '</td>';
		$pintado   .= '<tr>';
	}
	


	

}
$pintado .= '</tbody></table>';



echo $pintado;



closedir($directorio);





}

function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}
?>
