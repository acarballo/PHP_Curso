<html>
<body>
<div id="wraper">
<form ACTION="procesar.php" METHOD="POST" 
 enctype="multipart/form-data">
<ul>
	<li>ID: <input type="hidden" name="id" value="1"></li>
	<li>nombre: <input type="text" name="nombre"></li>
	<li>email:  <input type="text" name="email"></li>
	<li>password: <input type="password" name="password"></li>
	<li>direccion: <input TYPE="text" name="direccion"/></li>
	<li>descripcion: <textarea  cols="10" rows="10" name="descripcion"></textarea></li>
	<li>sexo: <input TYPE="radio" name="sexo" value="M" checked/>
			  <input TYPE="radio" name="sexo" value="H"/></li>
	<li>ciudad: <select name="ciudad">
		<option value="Vigo" selected>vigo</option>
		<option value="Barcelona">barcelona</option>
		<option value="Bilbao">bilbao</option>
		</select></li>
	<li>foto: <input TYPE="file" name="foto"/></li>
	<li>mascotas: tigre <input TYPE="checkbox" name="pets[]" value="tiger"/>
	 tarantula <input TYPE="checkbox" name="pets[]" value="tarantula"/>
	  iguana <input TYPE="checkbox" name="pets[]" value="iguana"/>
	</li>
	<li>deportes: <select multiple name="deportes">
	<option value="futbol" >futbol</option>
	<option value="beisbol" >beisbol</option>
	<option value="natacion" >natacion</option>
	</select>
	</li>
	<li>submit: <input TYPE="submit" name="submit" value="enviar"/></li>
	<li>button: <input TYPE="submit" name="button" value="nada"/></li>
	<li>reset: <input TYPE="submit" name="reset" value="reset"/></li>
</ul>
</form>
</div>
</body>
</html>