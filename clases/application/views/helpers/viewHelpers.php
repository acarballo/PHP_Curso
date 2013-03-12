<?php

class views_helpers_viewHelpers{
	
	static function createSelectFromDb($table, $name,
			$valueColumn, $labelColumn, $data, $multiple=FALSE){
	
		$gateway=new models_dataGatewayMysql();
		$cnx = $gateway->connectDB();
		$query = "SELECT * FROM ".$table;
		$result=mysqli_query($cnx,$query);
	
		if($multiple===FALSE)
			$html="<select name=\"".$name."\">";
		else
			$html="<select multiple name=\"".$name."[]\">";
	
		while($row = mysqli_fetch_assoc($result)){
			//printDataPreformated($row);
			//die;
	
			$html.="<option value=\"".$row[$valueColumn]."\"";
			//if (isset($data[$name])&&$data[$name]==".$row[$valueColumn].")
			//debug('',$data);
			//debug('',$row[$valueColumn],TRUE);
			if (in_array($row[$valueColumn],$data))
				$html.=' selected';
			else
				$html.='';
			$html.=">".$row[$labelColumn]."</option>";
	
	
		}
		$html.="</select>";
	
		return $html;
	}
	
	
	static function createRadioCheckFromDb($config, $table, $name,
			$valueColumn, $labelColumn, $data, $checkbox=FALSE)
	{
		if($checkbox===TRUE)
		{
			$fieldType="checkbox";
			$name=$name."[]";
		}
		else
			$fieldType="radio";
	
		$html='';
		$gateway=new models_dataGatewayMysql();
		$cnx = $gateway->connectDB();
		$query = "SELECT * FROM ".$table;
		$result=mysqli_query($cnx,$query);
		while ($row = mysqli_fetch_assoc($result))
		{
			$html.=$row[$labelColumn] .": "."<input type=\"".$fieldType."\"
					name=\"".$name."\" value=\"".$row[$valueColumn]."\"";
			//if (isset($data[$name])&&$data[$name]=='".$row[$valueColumn]."')
			if (in_array($row[$valueColumn],$data))
				$html.=' checked';
			else
				$html.='';
			$html.="/>";
	
		}
	
		return $html;
	}
	
	
	static function createRadioCheckFromDbbaddd($config, $table, $name,
			$valueColumn, $labelColumn, $checkbox=FALSE){
	
		$gateway=new models_dataGatewayMysql();
		$cnx = $gateway->connectDB();
		$query = "SELECT * FROM ".$table;
		$result=mysqli_query($cnx,$query);
		$html="Mascotas: ";
		while($row = mysqli_fetch_assoc($result)){
			//printDataPreformated($row);
			//die;
			$html.=$row[$labelColumn]." <input type=\"checkbox\" name=\"pets[]\" value=\"$row[$valueColumn]\" (in_array('$row[$valueColumn]',\$pets))?'checked':'';/>";
		}
		return $html;
	}
	
}
