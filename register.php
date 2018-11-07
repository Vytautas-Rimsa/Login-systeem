<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registracija</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Register</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Vartotojo vardas</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>El. paštas</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Slaptažodis</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Patvirtinti slaptažodį</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="register_btn">Registruoti</button>
		</div>
		<p>
			Nori prisijungti prie sistemos? <a href="login.php">Užsiregistruoti</a>
		</p>
	</form>
</body>
</html>