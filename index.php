<?php 
	include('functions.php');

	if (!isLoggedIn()) {
		$_SESSION['msg'] = "Privalai pirmiausia prisijungti";
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Pagrindinis puslapis</h2>
	</div>
	<div class="content">
		<!-- ispejamieji pranesimai -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- prisijungusio vartotojo informacija -->
		<div class="profile_info">
			<img src="images/user_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="index.php?logout='1'" style="color: red;">Atsijungti</a>
						<a href="do_task.php"> <br>+ Peržiūrėti priskirtas užduotis</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>