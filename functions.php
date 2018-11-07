<?php 
	session_start();

	// prisijungimas prie duomenu bazes
	$db = mysqli_connect('localhost', 'root', '', 'multi_login');

	// kintamieji
	$username = "";
	$email    = "";
	$errors   = array();
	
	//if(!isset($_SESSION['auth'])){
		//header('location: login.php');
	//}

	// jei paspaustas register_btn mygtukas iskvieciama register() funkcija
	if (isset($_POST['register_btn'])) {
		register();
	}

	// jei paspaustas login_btn mygtukas iskvieciama login() funkcija
	if (isset($_POST['login_btn'])) {
		login();
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ../login.php");
	}
	//-----//	
	if (isset($_POST['add_task'])){
		$task = $_POST['task'];		
		if (empty($task)) { 
			array_push($errors, "Būtina įvesti užduotį"); 
		} else {				
			mysqli_query($db, "INSERT INTO tasks (task, done, created) VALUES ('$task', 0, NOW())");
			header('location: create_task.php');			
		}
	}
	
	if (isset($_POST['assign'])){
		$task = $_POST['task'];
		$assigned_by=$_POST['assigned_by'];
		$emplist=$_POST['emp'];		
		if (empty($task)) { 
			array_push($errors, "Būtina įvesti užduotį"); 
		} else {	
			foreach($emplist as $emp){		
				mysqli_query($db, "INSERT INTO tasks (id, task, user_id, assigned_by, done, created) VALUES ('', '$task', '$emplist', '$assigned_by', 0, NOW())");			
				header('location: create_task.php');
			}
		}
	}
	
	// istriname uzduoti //
	if (isset($_GET['del_task'])){
		$id = $_GET['del_task'];
		mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
		header('location: create_task.php');
	}
	
	$tasks = mysqli_query($db, "SELECT * FROM tasks");
	$users = mysqli_query($db, "SELECT * FROM users WHERE user_type='user'");
	
	//atvaizduojame pasirinkta uzduoti//
	if (isset($_GET['edit_task'])){
		$id=$_GET['edit_task'];
		$res=mysqli_query($db, "SELECT * FROM tasks WHERE id=$id");
		$row=mysqli_fetch_row($res);
	}
	//redaguojame pasirinkta uzduoti//
	if (isset($_POST['update'])){
		$id=$_POST['id'];
		$newTask=$_POST['newTask'];
		
		mysqli_query($db, "UPDATE tasks SET task='$newTask' WHERE id=$id");
		header('location: create_task.php');		
	}	
	
	// vatotojo registracija
	function register(){
		global $db, $errors;

		// gaunam uzpildytos formos duomenis
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// patikrinam ar forma teisingai uzpildyta
		if (empty($username)) { 
			array_push($errors, "Reikalingas vartotojo vardas"); 
		}
		if (empty($email)) { 
			array_push($errors, "Reikalingas el. paštas"); 
		}
		if (empty($password_1)) { 
			array_push($errors, "Reikalingas slaptažodis"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "Slaptažodžiai neatitinka");
		}

		// jei pildant forma nebuvo klaidu, registruojamas vartotojas
		if (count($errors) == 0) {
			$password = md5($password_1);//koduojamas slaptazodis duomenu bazeje

			if (isset($_POST['user_type'])) {
				$user_type = e($_POST['user_type']);
				$query = "INSERT INTO users (username, email, user_type, password) 
						  VALUES('$username', '$email', '$user_type', '$password')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "Naujas vartotojas buvo sėkmingai sukurtas!!";
				header('location: home.php');
			}else{
				$query = "INSERT INTO users (username, email, user_type, password) 
						  VALUES('$username', '$email', 'user', '$password')";
				mysqli_query($db, $query);

				// gaunamas sukurto vartotojo id
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); // prisijunges vartotojas iterpiamas i sesija
				$_SESSION['success']  = "Jūs sėkmingai prisijungėte";
				header('location: index.php');				
			}
		}
	}

	// grazinamas vartotoju masyvas pagal id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM users WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	// vartotojo prisijungimas
	function login(){
		global $db, $username, $errors;

		// tikrinam formos prisijungimo duomenis
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// patikrinam ar forma teisingai uzpildyta
		if (empty($username)) {
			array_push($errors, "Reikalingas vartotojo vardas");
		}
		if (empty($password)) {
			array_push($errors, "Reikalingas slaptažodis");
		}

		// jei pildant forma nebuvo klaidu, prijungiamas vartotojas
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // vartotojas ivestas duomenu bazeje
				// tikrinam ar bandantis prisijungti yra administratorius ar paprastas vartotojas
				
				//$session_id = session__id();
				//$_SESSION['auth']=$session__id;
				//$role=$row['role'];
			//if($role=='admin')}
			
			$_SESSION['user_id']=$row['user_id'];
				
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "Jūs sėkmingai prisijungėte";
					header('location: admin/home.php');		  
				}else{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "Jūs sėkmingai prisijungėte";

					header('location: index.php');
				}
			}else {
				array_push($errors, "Neteisingas vartotojo vardas arba slaptažodis");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}
	
	//if(isset($_REQUEST['task'])){
		//$task=$_POST['task'];
		//$assign_by=$_POST['assign_by'];
		//$emplist=$_POST['emp'];
	//}

?>