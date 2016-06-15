<?
class Funciones
{
/*
	 * Funcion que permite realizar una busqueda a cualquier tabla.
	 * @param string $tabla el cual es la tabla a la cual consultare.
	 * @param string $condicion sera el condicional de la consulta
	 * @param string $campos campos que queremos traer con la consulta
	 * @return array $resultado
	 */
    function consultaUniversal($tabla,$condicion,$campos='*')
    {
    	//variable base de datos @see config/conexion.php
    	global $db;
    	//realizo el query
    	$query	=	sprintf("SELECT %s FROM %s WHERE %s ",$campos,$tabla,$condicion);
    	//echo $query."<br>"; 
    	//ejecuto la consulta
    	$result	=	$db->Execute($query);
    	//declaro el arreglo para la info
    	$resultado	=	array();
    	if($result->NumRows() != 0)
    	{
	    	//recorro el resultado
	    	while(!$result->EOF)
	    	{
	    		//pongo la info en el arreglo
	    		array_push($resultado,$result->fields);
	    		//paso a la siguiente linea
	    		$result->MoveNext();
	    	}
    	}
    	//retorno el arreglo
    	return $resultado;
    }
}
?>