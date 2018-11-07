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
		<h2>Užduoties redagavimas</h2>
	</div>
	
	<form method="post" action="edit_task.php">	
		<div class="input-group">		
			<input class="task" type="text" name="newTask" value="<?php echo $row[1]; ?>" >
			<input class="task" type="hidden" name="id" value="<?php echo $row[0]; ?>" >
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="update">Redaguoti užduotį</button>
		</div>		
	</form>
	
</body>
</html>