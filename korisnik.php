<?php
session_start();
date_default_timezone_set('Europe/Zagreb');
/**
 * Created by PhpStorm.
 * User: Hrvoje
 * Date: 4/6/2015
 * Time: 5:45 AM
 */


$mysqli = mysqli_connect('localhost', 'root', 'Hrvoje1996', 'mreza_company') or die("dead");
//$mysqli =mysqli_connect('localhost', '503339', 'soferplantak','503339');// komentirano samo za testiranje,maknuti komentar za live stranicu

$session_id = $_SESSION['id'];
$session_email = $_SESSION['email'];
$session_ime = $_SESSION['ime'];
$session_prezime = $_SESSION['prezime'];
$session_sex = $_SESSION['sex'];
$session_avatar = $_SESSION['avatar'];
$session_godina = $_SESSION['godina'];

$upit = mysqli_query($mysqli, "SELECT * FROM users WHERE id = $session_id");
$broj_redova = mysqli_num_rows($upit);
$red = mysqli_fetch_array($upit);
if ($broj_redova == 1) {
	$id = $red['id'];
	$username = $red['username'];
	$email = $red['email'];
	$ime = $red['ime'];
	$prezime = $red['prezime'];
	$sex = $red['sex'];
	$avatar = $red['avatar'];
};?>
<!--suppress QuirksModeInspectionTool -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<html>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">

		function promjena_maila() {
			var email = $('.email').val();

			$.ajax({
				type: "POST",
				url: "registration.php",
				data: {email},
				beforeSend: function () {
					$('.ajax_gif').css('display:inline');
				},
				success: function (response) {

					$('.response').html(response);


				}
			});

		}

		$(document).ready(function () {
			$(".general_info").click(function () {
				$(".general").show();
				$(".security").hide();
				$(".privacy").hide();
				$(".password_change").hide();
				$(".name_change").hide();
				$('.deactivator').attr('style','margin-top:440px;');
			});
		});


		$(document).ready(function () {
			$(".security_selector").click(function () {
				$(".security").show();
				$(".toolbar_general").hide();
				$(".privacy").hide();
				$(".name_change").hide();
				$(".email_change").hide();
				$(".password_change").hide();
				$(".toolbar_privacy").hide();
				$('.deactivator').attr('style','margin-top:440px;');
			});
		});

		$(document).ready(function () {
			$(".privacy_selector").click(function () {
				$(".privacy").show();
				$(".toolbar_general").hide();
				$(".security").hide();
				$(".name_change").hide();
				$(".email_change").hide();
				$(".password_change").hide();
				$('.deactivator').attr('style','margin-top:440px;');
			});
		});

		$(document).ready(function () {
			$(".name_handler").click(function () {
				$(".security").hide();
				$(".toolbar_general").show();
				$(".privacy").hide();
				$(".email_change").hide();
				$(".password_change").hide();
				$(".name_change").show();
				$('.deactivator').attr('style','margin-top:440px;');

			});
		});

		$(document).ready(function () {
			$(".toolbar_general_info").click(function () {
				$(".toolbar_general").show();
				$(".security").hide();
				$(".privacy").hide();
				$(".password_change").hide();
				$(".name_change").show();
				$(".toolbar_security").hide();
				$(".toolbar_privacy").hide();
				$('.deactivator').attr('style','margin-top:440px;');

			});
		});

		$(document).ready(function () {
			$(".email_handler").click(function () {
				$(".security").hide();
				$(".privacy").hide();
				$(".name_change").hide();
				$(".password_change").hide();
				$(".email_change").show();
				$('.deactivator').attr('style','margin-top:440px;');
			});
		});

		$(document).ready(function () {
			$(".password_handler").click(function () {
				$(".security").hide();
				$(".privacy").hide();
				$(".name_change").hide();
				$(".email_change").hide();
				$(".password_change").show();
				$('.deactivator').attr('style','margin-top:440px;');
			});
		});

		$(document).ready(function () {
			$(".security_selector").click(function () {
				$(".toolbar_toolbar_general").hide();
				$(".toolbar_security").show();
				$(".security").show();
				$(".active_sessions").show();
				$('.deactivator').attr('style','margin-top:440px;');


			});
		});

		$(document).ready(function () {
			$(".privacy_selector").click(function () {
				$(".toolbar_toolbar_general").hide();
				$(".toolbar_security").hide();
				$(".security").hide();
				$(".active_sessions").hide();
				$(".toolbar_privacy").show();
				$('.deactivator').attr('style','margin-top:477px;');

			});
		});


	</script>
	<style>
		a:link{ color: #428BCA; outline: none; }
		a:visited{ color: #428BCA; outline: none; }
		a:hover{ color: #428BCA; outline: none; }
		a:active{ color: #428BCA; outline: none; }
		a:link{ text-decoration: none; }
		a:visited{ text-decoration: none; }
		a:hover{ text-decoration: underline; }
		a:active{ text-decoration: underline; }
		body{ position: absolute; }
		.info_sidebar{ border: 1px solid #e9e9e9; width: 250px; height: 250px; }
		.frame{ height: 630px; width: 700px; border: 1px solid #e7e7e7; position: absolute; margin-left: 400px; margin-top: 5px; }
		.security{ margin-left: 25px; position: absolute; margin-top: -500px; }
		.privacy{ margin-left: 25px; position: absolute; margin-top: 50px; }
		.info_sidebar{ padding-left: 35px; height: 637px; width: 190px; }
		.toolbar_general_info{ padding-left: 35px; margin-top: 20px; margin-left: -35px; height: 26px; padding-top: 4px;  cursor: pointer;}
		.security_selector{ padding-left: 35px; margin-left: -35px; height: 26px; padding-top: 4px;  cursor: pointer;}
		.security_selector:hover{ background-color: #F6F7F8 }
		.privacy_selector{ padding-left: 35px; margin-left: -35px; height: 26px; padding-top: 4px; cursor: pointer;}
		.notifications_selector:hover{ background-color: #F6F7F8 }
		.notifications_selector{ padding-left: 35px; margin-left: -35px; height: 26px; padding-top: 4px; cursor: pointer;}
		.posts_selector:hover{ background-color: #F6F7F8 }
		.posts_selector{ padding-left: 35px; margin-left: -35px; height: 26px; padding-top: 4px; cursor: pointer;}
		.privacy_selector:hover{ background-color: #F6F7F8; }
		.name_change{ margin-left: 260px; margin-top: 65px; height: 100px; position: absolute; }
		.toolbar_general{ border: 1px solid transparent; border-bottom-color: #e7e7e7; height: 30px; padding-top: 5px; }
		.name_handler{ margin-left: 20px; width: 100%; height: 100%; }
		.email_handler{ margin-left: 20px; }
		.email_change{ display: none; margin-left: 0; margin-top: 0; position: absolute; width: 700px; height: 425px; }
		.password_change{ display: none; margin-left: 260px; margin-top: 65px; position: absolute; }
		.password_handler{ margin-left: 20px; }
		.password_current{ margin-top: 40px; margin-left: -30px; }
		.password_new{ margin-top: 40px; margin-left: -10px; }
		.password_new_retype{ margin-top: 40px; margin-left: -100px; }
		.submit_btn_password{ margin-top: 40px; margin-left: 100px; background: #425F9C; color: white; border: 0 solid transparent; height: 22px; width: 140px; }
		.deactivator{margin-top: 440px; position: absolute; width: 200px; margin-left: 25px; height: 26px; padding-top: 4px; padding-left: 10px; cursor: pointer;color:#428BCA;}
		.deactivator:hover{ background-color: #F6F7F8 }
		.divider{ height: 1px; position: absolute; margin-top: 420px; margin-right: 150px; width: 600px; border: 1px solid transparent; border-bottom-color: #e7e7e7; margin-left: 50px; }
		.form{ background-color: #F8F8F8; height: 422px; margin-bottom: 150px; }
		.submit_btn_name{ margin-top: 150px; margin-right: 200px; position: absolute; background: #425F9C; color: white; border: 0 solid transparent; height: 25px; width: 140px; }
		select{ padding: 3px; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset; -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset; box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset; background: #FFFFFF; color: #888; border: none; outline: none; display: inline-block; -webkit-appearance: none; -moz-appearance: none; appearance: none; cursor: pointer; position: absolute; margin: 0 0 0 350px; }
		/* Targetting Webkit browsers only. FF will show the dropdown arrow with so much padding. */
		hr{ background: none repeat scroll 0 0 #D9D9D9; border-width: 0; color: #D9D9D9; height: 1px; }
		::selection{ color: red; /* WebKit/Blink Browsers */ }
		::-moz-selection{ color: red; /* Gecko Browsers */ }
		.toolbar_general_info:hover{ background-color: #F6F7F8 }
		.submit_new_mail{ margin-left: 10px; background: #425F9C; color: white; border: 0 solid transparent; height: 22px; width: 140px; }
		.toolbar_security{height:30px;padding-top:5px; border: 1px solid transparent; border-bottom-color: #e7e7e7;}
		.security_sessions{margin-left:20px;}
		.posts_selector{}
		.ostalo{margin-left:20px;}
		.security{width:699px;height:420px;max-height: 423px;margin-top:-570px;margin-left:0;}
		.active_sessions{margin-top:20px;padding-left:18px;}
		.toolbar_privacy{height:30px;padding-top:5px; border: 1px solid transparent; border-bottom-color: #e7e7e7;}
		.privacy_handler{margin-left:20px;}
		.privacy{width: 700px; height: 423px;position:absolute;margin-top:-572px;border:1px solid red;margin-left:0;}

	</style>
	<head>
		<title>Settings</title>
	</head>
	<body>
		<div class="frame">
			<div class="toolbar_general">
				<a href="#name" class="name_handler">Ime</a>
				<a href="#email" class="email_handler">E-Po&scaron;ta</a>
				<a href="#password" class="password_handler">Lozinka</a>
				<a href="#login_history" class="security_sessions">Povijest Prijavljivanja</a>
			</div>
			<div class="toolbar_security" style="display:none">
				<a class="security_sessions" href="#sessions">Povijest prijavljivanja</a>
				<a class="ostalo" href="#ostalo">Ostalo</a>
			</div>
			<div class="deactivator">Izbri&scaron;ite ili deaktivirajte ra&#269;un
			</div>

			<div class="toolbar_privacy" style="display:none"><a class="privacy_handler" href="#privatnost">Osnovno</a></div>
			<div class="form">
				<div class="name_change" style="display:block"><!--update name section-->
					<input type="text" placeholder="Ime" style="position: absolute;">
					<input type="text" placeholder="Srednje Ime" style="position: absolute;margin-top:50px;">
					<input type="text" placeholder="Prezime" style="position: absolute;margin-top:100px;">
					<input type="submit" value="Promjeni ime" class="submit_btn_name">
					<img style="display:none;margin-top:157px;margin-left:155px;" src="loading_gif.gif">
				</div>
				<!-- update name section end/update mail section beginning -->
				<div class="email_change" style="display:none">
					<table style="margin-left:230px;margin-top:50px;">
						<tr>
							<td>
								<span>Novi E-Mail:</span>
								<input title="email" class="email" placeholder="E-Mail">
								<button class="submit_new_mail">Promjeni E-Mail</button>
								<img style="display:none;margin-left:10px;" src="loading_gif.gif">
							</td>
						</tr>
						<hr style="color:black;margin-top:130px;position:absolute;width:700px;">

						<tr style="margin-top:190px;position: absolute;margin-left:-25px;">
							<td>
								<span>Trenutni E-Mail:</span>
								<?php if (isset($session_email)) {
									echo $session_email;
								} ?>
							</td>
						</tr>

					</table>


				</div>

				<div class="password_change">
					<div class="password_current">Trenutna lozinka: &nbsp;<input title="Password" type="password" name="password"></div>

					<div class="password_new">Nova Lozinka: &nbsp;<input title="Password" type="password" name="new_password"></div>

					<div class="password_new_retype">Ponovno unesi novu lozinku: &nbsp;<input type="password" name="new_password_repeat" title="Repeat Password">
					</div>
					<input type="submit" Value="Promjeni Lozinku" class="submit_btn_password">
					<img style="display:none;margin-left:10px;" src="loading_gif.gif">
				</div>
			</div>


			<div class="security" style="display: none;overflow-y:scroll">
				<div class="active_sessions">
					<?php
					$query = mysqli_query($mysqli, "SELECT * FROM sesije WHERE user_id = $session_id");
					echo '<table>';
					while($red = mysqli_fetch_array($query)){
						$ip = $red['ip'];
						$datum = $red['datum'];
						$vrijeme = $red['vrijeme_prijave'];
						if($vrijeme == ''){$vrijeme = 'nepoznato';}
						echo '<tr>';
						echo '<td>';
						echo '<span>Dana </span>';
						echo $datum;
						echo '</td>';
						echo '<td>';
						echo '<span>prijavili ste se sa adrese </span>';
						echo '</td>';
						echo '<td style="position:absolute;">';
						echo $ip;
						echo '<span style="margin-left:5px;">u </span>';
						echo '<span style="margin-left:5px;position:absolute;;width:75px;">'.$vrijeme.'</span>';
						echo '</td>';

					}
					echo '</table>';



					?></div>
			</div>

        <div class="privacy" style="display:none"></div>
		</div>
		<div class="info_sidebar">
			<div class="toolbar_general_info" style="margin-top:15px;color:#428BCA;">Op&#263;enito</div>
			<br>

			<div class="security_selector" style="margin-top:0;color:#428BCA;">Podaci o Ra&#269;unu</div>
			<br>

			<div class="privacy_selector" style="margin-top:0;color:#428BCA;">Privatnost</div>
			<br>

			<div class="notifications_selector" style="margin-top:0;color:#428BCA;">Obavijesti</div>
			<br>

			<div class="posts_selector" style="margin-top:0;color:#428BCA;">Objave</div>
			<br>
		</div>
	</body>
</html>

