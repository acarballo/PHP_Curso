<?php

/**
 * Fuction name: init_minefield
 * Description:	Initialice the status of the minefield.	
 * @param  array $minefield
 * @param  integer $dimension
 * @return Array 
 */
function init_minefield($minefield, $dimension){
	$minefield = array();
	for($col=1;$col<=$dimension;$col++){
		for($fil=1;$fil<=$dimension;$fil++){
			$minefield[$fil.','.$col]=FALSE;
		}
	}
	return $minefield;
}

/**
 * Fuction name: init_mines
 * Description:	Add randon mines. min 1 max 1/3 number of positions	
 * @param array $mines
 * @param integer $dimension
 * @return array
 */
function init_mines($mines, $dimension){
	$mines = array();
	$max_mines=floor($dimension*$dimension/3);
	$num_mines=rand(1,$max_mines); 
	
	while(count($mines,COUNT_NORMAL)<$num_mines){
		$mina=rand(1,$dimension).','.rand(1,$dimension);
		if (!in_array($mina, $mines))
			array_push($mines, $mina);
	}
	return $mines;
}

/**
 * Fuction name: show_minefield
 * Description:	create the html table asociated with the minefield array.	
 * @param  array $minefield
 * @param  integer $dimension
 * @return true
 */
function show_minefield($minefield, $dimension){
	echo('<table>');
	for($fil=1;$fil<=$dimension;$fil++){
		echo('<tr>');
		for($col=1;$col<=$dimension;$col++){
			//echo('<td onClick="index.php?accion=dig_cell()">'.$minefield[$fil.','.$col].'-----</td>');
			echo('<td>'.$minefield[$fil.','.$col].'</td>');		
		}
		echo('</tr>');
	}
	echo('</table>');
	return TRUE;
}

/**
 * Fuction name: check_mine
 * Description:	check an position, returning '*' in case that there are a mine 
 * in that position, or the number of mines arround in other cases. 
 * @param string $cell
 * @param array $mines
 * @param array $dimension
 * @return string|number
 */
function check_mine($cell, $mines, $dimension){
	if (in_array($cell, $mines)){
		return '*';
	}
	$posicion = explode(',',$cell);
	$fil= $posicion[0];
	$col= $posicion[1];
	$numMinas=0;
	
	$fil_min=$fil-1;
	if($fil_min<1) $fil_min = 1; 
	$col_min=$col-1;
	if($col_min<1) $col_min = 1;
	$fil_max=$fil+1;
	if($fil_max>$dimension) $fil_max = $dimension;
	$col_max=$col+1;
	if($col_max>$dimension) $col_max = $dimension;
	
	for($f=$fil_min;$f<=$fil_max;$f++)
		for($c=$col_min;$c<=$col_max;$c++){
			if(in_array($f.','.$c,$mines)){
				$numMinas+=1;
			}
		}
	return $numMinas;
}

/**
 * Fuction name: show_all_mines
 * Description:	Calculate the values of the all pending cells of the minefield.
 * (Actually, before this function there are any cells with value) (future use)  
 * @param array $minefield
 * @param array $mines
 * @param integer $dimension
 * @return array
 */
function show_all_mines($minefield, $mines, $dimension){
	foreach($minefield as $key=>$value){
		if(!$value){
			$minefield[$key]= check_mine($key, $mines, $dimension);
		}
	}
	return $minefield;
}

/**
 * Fuction name: dig_cell
 * Description:	function for future use.
 * @return boolean
 */
function dig_cell(){
	return true;
}
