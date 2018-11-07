<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Administratoriaus funkcijos</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
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
		<h2>Darbas su užduotimis</h2>
	</div>
	
	<form method="post" action="create_task.php">	
		<div class="input-group">
			<input type="text" name="task">
			<input type="hidden" name="assigned_by" value="<?php echo $_SESSION['user_id']; ?>">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="add_task">Pridėti užduotį</button>
			<button type="submit" class="btn" name="assign">Priskirti užduotį</button>
		</div>		
	</form>
	
	
	<table>
		<thead>
			<tr>
				<th>Nr.</th>
				<th></th>
				<th>Vartotojo vardas</th>
				<th>Vartotojo el. paštas</th>				
			</tr>
		</thead>
		<tbody>
		<?php $i = 1; while ($row = mysqli_fetch_array($users)) { ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><input type="checkbox" name="emp[]" value="<?php echo $row['id'];?>"></td>
				<td class="user"><?php echo $row['username']; ?></td>
				<td class="user"><?php echo $row['email']; ?></td>								
			</tr>			
		<?php $i++;} ?>			
		</tbody>
	</table>
	
	
	
	<table>
		<thead>
			<tr>
				<th>Nr.</th>
				<th>Užduotis</th>
				<th>Redaguoti</th>
				<th>Trinti</th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td class="task"><?php echo $row['task']; ?></td>
				<td class="edit">
					<a href="edit_task.php?edit_task=<?php echo $row['id']; ?>">V</a>					
				</td>
				<td class="delete">
					<a href="create_task.php?del_task=<?php echo $row['id']; ?>">X</a>
				</td>				
			</tr>			
		<?php $i++;} ?>			
		</tbody>
	</table>	
</body>
</html>