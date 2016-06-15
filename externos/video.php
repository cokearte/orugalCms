<?
extract($_GET);
?>

<object width="560" height="315">
	<param name="movie" value="http://www.youtube.com/v/<?=$codigo ?>?version=3&amp;hl=es_ES&amp;rel=0&amp;autoplay=1"></param>
	<param name="allowFullScreen" value="true"></param>
	<param name="allowscriptaccess" value="always"></param>
	<embed src="http://www.youtube.com/v/<?=$codigo ?>?version=3&amp;hl=es_ES&amp;rel=0&amp;autoplay=1" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed></object>
