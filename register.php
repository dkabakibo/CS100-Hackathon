<html>
<head>
	<title>Mini Hackathon</title>
</head>
<body>
<h1>Text Message Spammer</h1>
<?php
require_once("db_const.php");
if (!isset($_POST['submit'])) {
?>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		Username: <input type="text" name="username" /><br />
		Password: <input type="password" name="password" /><br />
		First name: <input type="text" name="first_name" /><br />
		Last name: <input type="text" name="last_name" /><br />
		Email: <input type="type" name="email" /><br />

		<input type="submit" name="submit" value="Register" />
	</form>
<?php
} else {

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}

	$username	= $_POST['username'];
	$password	= $_POST['password'];
	$first_name	= $_POST['first_name'];
	$last_name	= $_POST['last_name'];
	$email		= $_POST['email'];


	$exists = 0;
	$result = $mysqli->query("SELECT username from users WHERE username = '{$username}' LIMIT 1");
	if ($result->num_rows == 1) {
		$exists = 1;
		$result = $mysqli->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");
		if ($result->num_rows == 1) $exists = 2;
	} else {
		$result = $mysqli->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");
		if ($result->num_rows == 1) $exists = 3;
	}

	if ($exists == 1) echo "<p>Username already exists!</p>";
	else if ($exists == 2) echo "<p>Username and Email already exists!</p>";
	else if ($exists == 3) echo "<p>Email already exists!</p>";
	else {

		$sql = "INSERT  INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`)
				VALUES (NULL, '{$username}', '{$password}', '{$first_name}', '{$last_name}', '{$email}')";

		if ($mysqli->query($sql)) {

			echo "<p>Registred successfully!</p>";
			echo "<a href='index.php'> Click here to log in. </a>";
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}
	}
}
?>
</body>
</html>
