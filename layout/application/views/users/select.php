<?php 
$users=$viewVars['users'];
$title=$viewVars['title'];
?>

<a href="/author/logout">home</a>
<h1><?=$title ?></h1>
<a href="/users/insert">Add</a>
<table border=1>
	<tr>
		<th>id</th>
		<th>name</th>
		<th>email</th>
		<th>password</th>
		<th>address</th>
		<th>description</th>
		<th>sex</th>
		<th>city</th>
		<th>pets</th>
		<th>sports</th>
		<th>photo</th>
		<th>options</th>
	</tr>
<?php 
//Show user table
//veremos como pasar bien el array a la vista (ahora funciona por que lo incluse users.php)
foreach($users as $key => $line):?>
	<tr>
	<?php
		// for each user line	
		foreach($line as $key1 =>$value):?>
			<td><?=(is_array($value))?implode(',',$value):$value;?></td>
		<?php endforeach;?>
		<td>
			<a href="/users/update/id/<?=$line['iduser'];?>">update</a>
				&nbsp;
			<a href="/users/delete/id/<?=$line['iduser'];?>">delete</a>
		</td>		
	</tr>
<?php endforeach;?>
</table>