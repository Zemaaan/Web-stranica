<html>
	<link rel="stylesheet" href="style.css">
	<style>
		body{
			outline: none;
			background-color:#ffffff;/**#222222**/
		}

		select{
			background-color: transparent;
			border: 0 solid transparent;
			width: 100px;
		}

		table.register_form{
			margin-left: 850px;
			border: 1px solid blue;
			border-radius: 5px;
			background:#EAEAEC;
			margin-top:20px;

		}
		input.username{width:372px;height:34px;}
		input.password{width:372px;height:34px;}
		input.passverif{width:372px;height:34px;}
		input.email{width:372px;height:34px;}
		input.ime{width:372px;height:34px;}
		input.prezime{width:372px;height:34px;}
		input.godina{width:372px;height:34px;}
		input.avatar_source{width:372px;height:34px;}
		input.sex{width:372px;height:34px;}
		.submit{background-color:white;border:0 transparent}
		.mjesec{position:absolute;margin-left:200px;}
		.dan{margin-left:40px;position:absolute;margin-top:-25px;}

		.arrow_box { position: absolute; background: #88b7d5; border: 1px solid #c2e1f5; margin-left:832px;margin-top:20px; }
		.arrow_box:after, .arrow_box:before { left: 100%; top: 50%; border: solid transparent; content: " "; height: 0; width: 0; position: absolute; pointer-events: none; }
		.arrow_box:after { border-color: rgba(136, 183, 213, 0); border-left-color: #88b7d5; border-width: 10px; margin-top: -10px; }
		.arrow_box:before { border-color: rgba(194, 225, 245, 0); border-left-color: #c2e1f5; border-width: 11px; margin-top: -11px; }
	</style>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>

		function Registracija_ajax() {
			var username = $('.username').val();
			var password = $('.password').val();
			var passverif = $('.passverif').val();
			var email = $('.email').val();
			var ime = $('.ime').val();
			var prezime = $('.prezime').val();
			var godina = $('.godina').val();
			var avatar_source = $('.avatar_source').val();
			var sex = $('.sex').val();
			$.ajax({
				type: "POST",
				url: "registration.php",
				data: {username,password,passverif,email,ime,prezime,godina,avatar_source,sex},
				beforeSend: function () {
					$('.loading_gif').css('display:inline');
				},
				success: function (response) {

					$('.response').html(response);



				}
			});

		}
		$(document).ajaxSend(function () {
			$('.ajax_gif').show();
		});

		$(document).ajaxComplete(function () {
			$('.ajax_gif').hide();
		});



	</script>

	<body>

			<table class="register_form" cellspacing="21">
					<tr>
						<td>
							<input name="username" required="ddd" placeholder="Koriničko Ime" class="username">
						</td>
					</tr>
					<tr>
						<td>
							<input name="password"
							       type="password" required placeholder="Lozinka" class="password"> <!--onpaste="alert('Lozinka mora biti ručno upisana');return false"-->
						</td>
					</tr>
					<tr>
						<td>
							<input name="passverif" type="password" required placeholder="Ponovi Lozinku" class="passverif"><!--onpaste="alert('Lozinka mora biti ručno upisana');return false"-->
						</td>
					</tr>
					<tr>
						<td>
							<input name="email" placeholder="E-mail" required class="email">
						</td>
					</tr>
					<tr>
						<td>
							<input name="ime" placeholder="Ime" required class="ime">
						</td>
					</tr>
					<tr>
						<td>
							<input name="prezime" placeholder="Prezime" required class="prezime">
						</td>
					</tr>

					<tr>
						<td>
							<select name="sex" class="sex" style="margin-left:40px;position:absolute;">
								<option value="male">Muško</option>
								<option value="female">Žensko</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<select name="godina" class="godina" style="margin-left:200px;position:absolute;margin-top:-23px;">
								<option value="0000">Godina</option>
								<?php
								$beggining_year = date('Y') - 13;
								$end_year = '1975';

								while ($end_year <= $beggining_year) {
									echo '<option value="' . $beggining_year . '">' . $beggining_year . '</option>';
									$beggining_year--;
								}
								?>

							</select>
						</td>
					</tr>
					<tr>
						<td>
							<input class="avatar_source" name="avatar_source" placeholder="Profile photo(link only)">
						</td>
					</tr>
					<tr>
						<td>
							<img class="loading_gif" src="loading_gif.gif" style="display:none;position:absolute;margin-left:110px;margin-top:4px;">
							<button class="submit" onclick="Registracija_ajax()"  name="submit">Registracija</button>
							<span style="position:absolute;margin-left:100px;color:red;">Samo Za Administratore</span>
						</td>
					</tr>
			</table>
		<div class="response"></div>
	</body>
</html>
