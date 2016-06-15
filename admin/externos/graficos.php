<?php
	include("jpgraph/src/jpgraph.php");
	include("jpgraph/src/jpgraph_bar.php");
	$datos1 = array(9, 5, 12, 11);
	$grafico = new Graph(400, 300, "auto");
	$grafico->SetScale("textlin");
	$grafico->title->Set("Pregunta tal");
	$grafico->xaxis->title->Set("Opciones");
	$grafico->yaxis->title->Set("Votos");
	$barplot1 = new BarPlot($datos1);
	$barplot1->SetColor("red");
	// Un gradiente Horizontal de rojo a azul
	$barplot1->SetFillGradient("red", "blue", GRAD_HOR);
	// 25 pixeles de ancho para cada barra
	$barplot1->SetWidth(25);
	$grafico->Add($barplot1);
	$grafico->Stroke();
?>