<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registracija</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Prisijungimas prie sistemos</h2>
	</div>
	
	<form method="post" action="login.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Vartotojo vardas</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Slaptažodis</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">Prisijungti</button>
		</div>
		<p>
			Nori prisijungti prie sistemos? <a href="register.php">Užsiregistruoti</a>
		</p>
	</form>


</body>
</html>