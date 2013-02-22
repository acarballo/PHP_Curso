<?php
$dimension_max= 60;
if(!empty($_GET['dimension']))
	$dimension=$_GET['dimension'];
else 
	$dimension=10;

if($dimension>$dimension_max)
	$dimension=$dimension_max;

$campominas=array();
$minas=array();

echo('<head>');
echo('    <link href="assets/css/reset.css" rel="stylesheet" type="text/css">');
echo('    <link href="assets/css/main.css" rel="stylesheet" type="text/css">');
echo('</head>');
echo('<body>');
echo('<h1>Buscaminas</h1>');
echo('<p>Dimension: '.$dimension.'x'.$dimension.'</p>');

require_once('assets/funtions.php');
$campominas = init_minefield($campominas,$dimension);
$minas= init_mines($minas,$dimension,$minas);
$campominas = show_all_mines($campominas, $minas, $dimension);
echo('<p>N&uacutemero Minas: '.count($minas).'</p>');

echo('<div>');
show_minefield($campominas,$dimension);
echo('</div>');

echo('</body>');

//echo('<hr/>');
//echo "<pre>";
//print_r($campominas);
//print_r($minas);
//echo "</pre>";
