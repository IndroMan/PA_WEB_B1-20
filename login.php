<?php require_once 'app/load.php';
if (isset($_SESSION['login'])) {
	header('location: utama.php');
} 
if (isset($_POST['login'])) {
	$user = trim($_POST['petugas']);
	$pass = trim($_POST['pass']);
	if (login($user,$pass)) {
		$_SESSION['login'] = 'on';
		header('location: utama.php');
	}else{
		$_SESSION['alert'] = "<script>mscAlert('Login GAGAL!!');</script>";
		header('location: login.php');
		die();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="res/logo.png">
	<title>Login Petugas</title>
	<link rel="stylesheet" type="text/css" href="des/petugas.css">
	<link rel="stylesheet" type="text/css" href="des/msc-style.css">
</head>
<body>
	<div id="login" align="center">
		<form action="login.php" method="post">
			<table align="center">
				<tr>
					<td colspan="2" align="center"><p class="text1">Login Petugas</p></td>
				</tr>
				<tr>
					<td>Username</td>
					<td>:<input type="text" name="petugas" class="inputext" placeholder="Masukkan Nama Petugas" required></td>
				</tr>
				<tr>
					<td>Password</td>
					<td>:<input type="password" name="pass" class="inputext" placeholder="Password petugas" required></td>
				</tr>
				<tr>
					<td></td>
					<td><a href="home.php" class="button">Kembali</a>
						<input type="submit" name="login" value="Login" class="inp button">
					</td>
				</tr>
			</table>
		</form>
	</div>
	<script src="des/msc-script.js"></script>
	<script src="des/home.js"></script>
	<?php if (isset($_SESSION['alert'])) {
		echo $_SESSION['alert'];
		unset($_SESSION['alert']);
	} ?>
</body>
</html>