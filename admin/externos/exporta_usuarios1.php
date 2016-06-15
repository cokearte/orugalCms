<?
/*
 * generador del formato en excel para cargar productos
 * @author Farez Jair Prieto Castro
 * @date  23 de Marzo de 2010
 * @version 1.0
*/
/* Incluye los archivos requeridos para conectarse a la base de datos */
require_once('../../config/configuracion.php');
require_once('../../config/conexion_3.php');
require_once('../../core/funciones.class.php');
global $db;
extract($_GET);
$query_exportar	=	$db->GetAll(sprintf("SELECT * FROM usuarios WHERE  %s ORDER BY nombres ASC",base64_decode($filtro)));
		$funciones	=	new Funciones();
		$tabla = "<table border='1'>";
		$tabla .= "<tr>";
		$tabla .= "<td align='center'><b>Identificacion</b></td>";
		$tabla .= "<td><b>Nombres</b></td>";
		$tabla .= "<td><b>Apellidos</b></td>";
		$tabla .= "<td><b>Usuario</b></td>";
		$tabla .= "<td><b>Fecha de Nacimiento</b></td>";
		$tabla .= "<td align='center'><b>Email</b></td>";
		$tabla .= "<td align='center'><b>Email Alterno</b></td>";
		$tabla .= "<td align='center'><b>Telefono</b></td>";
		$tabla .= "<td align='center'><b>Celular</b></td>";
		$tabla .= "<td align='center'><b>Codigo Postal</b></td>";
		$tabla .= "<td align='center'><b>Genero</b></td>";
		$tabla .= "<td align='center'><b>Instrumentos que toca</b></td>";
		$tabla .= "<tr>";
		foreach($query_exportar as $datos)
		{
			if($datos['idusuario'] != 1)
			{
				$tabla .= "<tr>";
				$tabla .= "<td align='center'>".$datos['identificacion']."</td>";
				$tabla .= "<td>".$datos['nombres']."</td>";
				$tabla .= "<td>".$datos['apellidos']."</td>";
				$tabla .= "<td>".$datos['username']."</td>";
				$tabla .= "<td>".$datos['fechanacimiento']."</td>";
				$tabla .= "<td align='center'>".$datos['email']."</td>";
				$tabla .= "<td align='center'>".$datos['altemail']."</td>";
				$tabla .= "<td align='center'>".$datos['telefono']."</td>";
				$tabla .= "<td align='center'>".$datos['telefonomovil']."</td>";
				$tabla .= "<td align='center'>".$datos['codigopostal']."</td>";
				$tabla .= "<td align='center'>".$datos['genero']."</td>";
				$tabla .= "<td align='center'>".$datos['instrumentos']."</td>";
				$tabla .= "</tr>";
			}
		}
		$tabla .= "</table>";
		header('Content-type: application/vnd.ms-excel');
		header("Content-Disposition: attachment;filename=lista_productos.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
	    echo $tabla;
	    die();
?>