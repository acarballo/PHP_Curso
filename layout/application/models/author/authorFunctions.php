<?php

/**
 * 
 * @param unknown $config
 * @param unknown $data
 * @return boolean
 */
function loginUser($config,$data){
	$cnx = connectDB($config);

	$query = "SELECT * FROM users WHERE
					email='".$data['email']."' AND
					password='".$data['password']."'";
	$result = mysqli_query($cnx,$query);


	$numRows = mysqli_num_rows($result);
	if($numRows===1)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			$_SESSION['iduser']=$row['iduser'];
			$_SESSION['idrole']=$row['idrole'];
		}
		return TRUE;
	}
	else
		return FALSE;
}