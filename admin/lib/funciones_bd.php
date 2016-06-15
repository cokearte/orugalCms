<?
//conexion BD
/*
define("_DBUSER","cangurus");
    define("_DBHOST","209.126.254.70");
    define("_DBNAME","cangurus");
    define("_DBPASSWORD","cangurus2006");
    */
    define("_DBUSER","root");
    define("_DBHOST","localhost");
    define("_DBNAME","diezx");
    define("_DBPASSWORD",'");


    $db_handle = mysql_connect(_DBHOST, _DBUSER, _DBPASSWORD);
    mysql_select_db(_DBNAME, $db_handle);
    $db = array(
           "handle"       => $db_handle,
           "ejecutar"     => "mysql_query",
           "fetch_object" => "mysql_fetch_object",
           "free_result"  => "mysql_free_result",
           "num_rows"     => "mysql_num_rows",
           "data_seek"    => "mysql_data_seek",
           "fetch_array"  => "mysql_fetch_array",
           "result"       => "mysql_result",
           "ultimoid"     => "mysql_insert_id"
     );
     /*
function getIP()
{
	if (isset($_SERVER))
	{
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			return $_SERVER['REMOTE_ADDR'];
		}
	}
	else
	{
		if (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDER_FOR']))
		{
			return $GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDED_FOR'];
		} 
		else
		{
			return $GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'];
		}
	}
}*/
?>