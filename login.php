<?php

	include('config.php');
	include('functions.php');

	$failed = 0;

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = file_get_contents('sql/attemptLogin.sql');

		$params = array(
			'username' => $username,
			'password' => $password
		);

		$statement = $database->prepare($sql);
		$statement->execute($params);
		$users = $statement->fetchAll(PDO::FETCH_ASSOC);

		$failed = 1;

		if(!empty($users)) {
			$user = $users[0];

			$_SESSION['userid'] = $user['user_id'];

			// Redirect to the actual website
			header('location: index.php?search=&from=0');
		}
	}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">

  	<title>Super Secret</title>

  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  	<script src="https://use.fontawesome.com/72e7f63cce.js"></script>
  	<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="jumbotron">
	<div class="container">
		<h1>Login</h1>
	</div>
</div>

<div class="container">
	<div class="well">
		<div class="row">
			<div class="col-sm-3">
				<form method="POST">
					<input type="text" class="form-control" name="username" placeholder="username">
					<br>
					<input type="password" class="form-control" name="password" placeholder="password">
					<br>
					<input type="submit" value="Log In" class="btn btn-default dropdown-toggle" />
				</form>
				<br>
				<div class="row">
					<div class="col-md-6">
						<a href="forgot.php">Forgot password</a>
					</div>
					<div class="col-md-6">
						<a href="register.php">Register</a>
					</div>
				</div>
			</div>
			<div class="col-sm-9">
				<p>
					This is a personal project created by <strong>Andrea Halenkamp</strong> using
					the <a href="https://github.com/veekun/pokedex">Veekun database</a>.
					All of the following has been written in php utilizing classes and a ton of sql queries.
				</p>
				<p>
					Feel free to contact me at <a href="mailto:halenkampa1@nku.edu">halenkampa1@nku.edu</a> if you have any questions.
				</p>
				<?php if ($failed == 1) { echo "<div class='alert alert-danger' role='alert'>Oh snap! You suck. You might want to figure out your username and/or password in the future.</div>";}?>
			</div>
	</div>
</div>

<?php include('footer.php'); ?>
