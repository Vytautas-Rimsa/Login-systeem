<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Priskirtos užduotys</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
		.header {
			background: #003366;
		}
		button[name=register_btn] {
			background: #003366;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>Priskirtų užduočių sąrašas</h2>
	</div>
	<table>
		<thead>
			<tr>
				<th>Nr.</th>
				<th>Užduotis</th>
				<th>Data</th>
				<th>Būsena</th>				
			</tr>
		</thead>
		<tbody>
		<?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td class="task"><?php echo $row['task']; ?></td>
				<td class="task"><?php echo $row['created']; ?></td>
				<td class="delete"><a href="#" >Neatlikta</a></td>
			</tr>			
		<?php $i++;} ?>			
		</tbody>
	</table>
	
</body>
</html>