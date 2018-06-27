<?php
/**
 * Created by PhpStorm.
 * Date: 24.2.2015.
 * Time: 13:20
 * Version 1.0
 */
session_start();
$mysqli = mysqli_connect('localhost', 'root', 'Hrvoje1996', '503340');
//$mysqli =mysqli_connect('localhost', '503339', 'soferplantak','503339');// komentirano samo za testiranje,maknuti komentar za live stranicu
if (isset($_POST['submit'])) {
	$email = stripslashes($_POST['email']);
	$password = stripslashes($_POST['password']);

	$result = mysqli_query($mysqli, "SELECT * FROM users WHERE email='$email' AND password = '$password'") or die("Query Failed");// redefining sql query for user data selection
	$num_row = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);

	if ($num_row == 1) {
		$id = $row['id'];
		$_SESSION['id'] = $row['id'];
		$username = $row['username'];
		$password = $row['password'];
		$email = $row['email'];
		$ime = $row['ime'];
		$prezime = $row['prezime'];
		$avatar = $row['avatar'];
		$dan = $row['dan'];
		$mjesec = $row['mjesec'];
		$godina = $row['godina'];
		$onesposobljen = $row['onesposobljen'];
		if ($onesposobljen == 'true') {
			echo 'Va&scaron; je ra&#269;un onesposobljen';
			exit;
		}
		if ($username != NULL) {
			header("Location:/$username");
			exit;
		} // podrska za korisnicko ime
		$_SESSION['username'] = $username;
		header("korisnik.php?id='$id'");


	}
	if ($num_row == 0) {
		echo '<span style="position:absolute;">record not found</span>';
	}
}
?>