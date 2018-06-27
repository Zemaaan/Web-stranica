<?php
/**
 * Created by PhpStorm.
 * User: Hrvoje
 * Date: 23.2.2015.
 * Time: 5:20
 * Version 2.0
 */
//$mysqli= mysqli_connect('localhost', '503339', 'soferplantak','503339'); //uncomment when uploaded to server
$nacin_rada = 'echo';//promjenjivo u session
$mysqli = mysqli_connect('localhost', 'root', 'Hrvoje1996', '503340');
$year = date("Y");
if (isset($_POST['username'])) {   //get_magic_quotes_gpc removed in php 5.4.0
	$username = stripslashes($_POST['username']);
	$password = stripslashes(md5($_POST['password']));
	$passverif = stripslashes(md5($_POST['passverif']));
	$email = stripslashes($_POST['email']);
	$ime = stripslashes($_POST['ime']);
	$prezime = stripslashes($_POST['prezime']);
	$godina = stripslashes(intval($_POST['godina']));
	$avatar_source = stripslashes($_POST['avatar_source']);
	$sex = stripslashes($_POST['sex']);


	if ($sex == 'female' and $avatar_source == '') {

		$avatar_source = 'default_profile_female.jpeg'; //potrebno dodati podršku za default sliku

	} elseif ($sex == 'male' and $avatar_source == '') {

		$avatar_source = 'default_profile_male.jpeg'; //potrebno dodati podršku za default sliku
	}


	if ($username == '' or $password == '' or $passverif == '' or $email == '' or $ime == '' or $prezime == '' or $dan == '' or $mjesec == '' or $godina == '' or $sex == '') {
		echo '<div class="arrow_box">';
		echo '</div>';
		echo '<div style="margin-top:-495px;margin-left:600px;border:2px solid #c2e1f5;width:190px;height:30px;padding-top:7px;padding-left:40px;">';//10
		echo ' Niste ispunili sva polja !';
		echo '</div>';
		exit;
	}

	if (strlen($password <= 2)) {
		echo 'Password too short';
		exit;
	}


	if (strlen($passverif <= 2)) {
		echo 'Password verification too short';
		exit;
	}

	if ($password != $passverif) {
		echo 'Va&#353;e lozinke se ne podudaraju';
		exit;
	}

	if ($mjesec > '12' or $mjesec < '1') {
		echo $mjesec . 'nije valjani izbor';
		exit;

	}

	if ($godina > $year) {  //year defined at line 12
		echo 'Vi ste iz budu&#269;nosti?';
		exit;
	}

	if ($godina == '0000') {
		echo '0000 nije valjani izbor';
		exit;
	}


	$result = mysqli_query($mysqli, "SELECT * FROM users WHERE email='$email'") or die("Query Failed");// redefining sql query for user data selection
	$num_row = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);
	if ($num_row >= 1) {
		echo '<span style="color:white;">U bazi podataka ve&#269; postoji ra&#269;un s tim Emailom</span>';

	} elseif ($num_row == 0) {

		$insert_users = mysqli_query($mysqli, "INSERT INTO users(username, password, email, ime, prezime,sex, avatar, dan, mjesec, godina) VALUES ('$username','$password','$email','$ime','$prezime','$sex','$avatar_source','$dan','$mjesec','$godina')");
		$insert_user_data = mysqli_query($mysqli, "INSERT INTO user_data(hometown, love_status, about,sex) VALUES ('NULL','NULL','NULL','$sex')");
		echo 'Registracija uspje&scaron;na,mo&#382;ete se <a href="login.php">prijaviti</a>';
	} else echo 'Registracija neuspjela';


} ?>

