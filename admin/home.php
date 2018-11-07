<?php 
	include('../functions.php');

	if (!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../login.php');
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pagrindinis puslapis</title>
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
		<h2>Administratorius - Pagrindinis puslapis</h2>
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
			<img src="../images/admin_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="home.php?logout='1'" style="color: red;">Atsijungti</a><br><br>
						<h3>Administratoriaus funkcijos</h3>
						<a href="create_user.php"> <br>+ Pridėti naują vartotoją</a>
						<a href="create_task.php"> <br>+ Darbas su užduotimis</a>
					</small>

				<?php endif ?>
			</div>
		</div>



	</div>
		
</body>
</html>