<?php
session_start();
unset($_SESSION['username']);
if(!isset($_SESSION['username'])){include('login.php');exit;}
$mysqli = mysqli_connect('localhost', 'root', 'Hrvoje1996', '503340');
error_reporting(0);

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

//$check_db = mysqli_query($mysqli,"CREATE TABLE IF NOT EXISTS users(post_id,)");


$txtSmileys = array('&lt;3', ' :P', ' :O', ' :D', ' :(', ' :/', " :'(", ' O:)', ' :X');   // one smylie code for each image
$imgSmileys = array('<img src="srce.jpg"/>', '<img src="p.jpg"/>', '<img src="O.jpg" />', '<img src="D.jpg"/>', '<img src="sad.jpg" />', '<img src="neutral.jpg" />', '<img src="crying.jpg" />', '<img src="anđel.jpg" />', '<img src="x.jpg" />');




$id = intval($_GET['id']);


$result = mysqli_query($mysqli, "SELECT * FROM posts, users WHERE  posts.poster_id = users.id AND posts.privatnost = 'Javno' ORDER BY post_id DESC LIMIT 15;") or die("Database Error");

// run the query. Will return a resource or false

if(mysqli_num_rows($result) == 0){echo 'no posts found';}
else{

// if it ran OK
	$pattern = "/(http|www|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

	$_SESSION['id'] = '23368';//need to be amended to receive session value from login.php
	if ($result) {
		echo '<img class="ajax_gif" src="loading_gif.gif" style="margin-top:185px;margin-left:950px;position:absolute;display:none;">';
		echo '<table cellspacing="10" >';// used to display posts in order,continued after while command
		while ($user = mysqli_fetch_array($result)) {

			$user['post'] = str_replace($txtSmileys, $imgSmileys, $user['post']);// adding smiley
			$user['post'] = wordwrap($user['post'], 60, "\n", TRUE);//spliting string into multiple rows,every 60 characters
			$user['post'] = preg_replace("/@+([a-zA-ZA-z]+)/", "<a href=\"$1\">$1</a>", $user['post']);//tagging system,no notification for tagged user
			$user['post'] = preg_replace($pattern, "<a href=\"\\0\" rel=\"nofollow\">\\0</a>", $user['post']);//converting links
			$avatar = $user['avatar'];
			$objavljivač = $user['ime'];
			$username = $user['username'];
			$session_poster_id = intval($user['poster_id']);
			$post_id = intval($user['post_id']);

			echo '<tr>';
			echo '<td>';
			echo '<a href="korisnik.php?id=' . $session_poster_id . '" style="width:40px;height:40px;">';
			echo '<div class="profile_pic_div" style="margin-left:5px;margin-top:5px;width:40px;height:40px;position:absolute;">';
			echo "<img src='$avatar' style='width:40px;height:40px;'>";
			echo '</div>';
			echo '</a>';
			echo '<div class="timestamp" style="margin-left:50px;margin-top;font-size:15px;">';
			echo $user['vrijeme'];
			echo '</div>';
			if ($_SESSION['id'] == $session_poster_id) {
				echo '<a href="#delete" onclick="delete_post(' . $post_id . ')">';
				echo '<div class="icon-x" style="margin-left:550px;margin-top:-10px;position:absolute;">';
				echo '</div>';
				echo '</a>';
			}
			echo '<div class="post_div" style="margin-top:30px;">';
			if (strlen($user['post']) > 500) {
				$user['post'] = substr($user['post'], 0, 500);
				$user['post'] = substr($user['post'], 0, strrpos($user['post'], ' ')) . '... <a href="story.php?post_id=' . $post_id . '">Read More</a>';
			}
			echo $user['post'];
			echo '</div>';
			echo '<br>';
			echo '<a href="story.php?id=' . $post_id . '">Komentiraj</a>';
			echo '</td>';
			echo '</tr>';


		}
	}}

echo '</table>'; ?>



<html>
	<head>
	</head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>


		function news_feed() {
			$(".no_posts").fadeOut(1000);
			$('table').fadeOut(1000, function () {


				var id = $("#id").val();
				var dataString = "id=" + id;
				$.ajax({
					type: "POST",
					url: "feed.php",
					data: dataString,
					beforeSend: function () {
						$('.loading_gif').css('display:inline');
					},
					success: function (response) {

						$('table').html(response);
						$('table').fadeOut(1000);//sakrivanje tablice kod ajax zahtjeva
						$('table').fadeIn(1000);//prikazivanje tablice kod ajax zahtjeva


					}
				});
			})
		}


		//		(function () {
		//			setInterval(news_feed, 60000);
		//		})();
		//
		//
		//		$(document).ajaxSend(function () {
		//			$('.ajax_gif').show();
		//		});
		//
		//		$(document).ajaxComplete(function () {
		//			$('.ajax_gif').hide();
		//		});
		//
		//
		//
		//		$(document).ready(function () {
		//			news_feed(); // prikazivanje tablice kod učitavanja cijelog dokumenta
		//
		//		});
		//


	</script>
	<link rel="stylesheet" href="style.css">
	<style>
		a:link{
			color: #0aa9ff;
			text-decoration: none;}

		a:hover{
			text-decoration: underline;
			color: #0aa9ff;}

		/* visited link */
		a:visited{
			color: #0aa9ff;  }

		a{
			outline: none;}

		/* mouse over link */

		/* selected link */
		a:active{
			color: #0aa9ff;  }

		body{
			background-color: #E9EAED;}

		td{
			border: 1px solid blue;
			height: 75px;
			background-color: #FFFFFF;
			width: 200px;}

		table{
			margin-left: 400px;
			width: 600px;
			height: 50px;
			margin-top: 200px;
			position: absolute;
			display: none;  }

		.status_post{
			margin-left: 12px;;
			height: 90px;
			position: absolute;
			width: 565px;
			margin-top: 50px;
			border: 0 solid transparent;  }

		.status_outer{
			width: 580px;
			position: absolute;
			background-color: White;
			height: 147px;
			margin-left: 410px;
			margin-top: -400px;  }

		.privacy{
			border: 0 solid transparent;
			margin-top: 145px;
			height: 25px;
			background-color: #F6F7F8;
			position: absolute;  }

		.privacy_select{
			margin-left: 350px;
			margin-top: 5px;
			width: 85px;  }

		option{
			background-color: #F6F7F8;
			border: 0 solid transparent;  }

		select{
			background-color: #F8F8F9;
			border: 0 solid transparent;  }

		.submit_post{
			margin-left: 220px;
			margin-top: -21px;
			position: absolute;
			height: 25px;  }

		.update_section{
			margin-top: 400px;
			position: absolute;  }

		.no_posts{
			width: 380px;
			margin-left: 0;
			background-color: #F6F7F8;
			position: absolute;
			height: 100px;
			margin-top: 0;
			padding-left: 200px;
			color: #a7a7a7;
			font-size: 28px;
			padding-top: 150px;  }

		.file_browse{
			margin-top: -28px;
			height: 23px;
			margin-left: 50px;
			width: 190px;  }

		.bottom_form{
			border: 1px solid white;
			width: 700px;
			margin-top: 115px;
			height: 50px;
			position: absolute;
			margin-left: 350px;
			display: none;
			background-color: red;  }

		.icon-plus{
			position: absolute;
			margin-left: 550px;  }

	</style>
	<script>

	</script>
	<title>Mreža</title>

	<body>
		<div class="update_section">
			<div class="status_outer">
				<div style="background-color: #E9EAED;">
					<div style="margin-left:10px;margin-top:5px;position: absolute;">
						Napišite Objavu...
					</div>
					<hr style="position:absolute;margin-top:30px;width:550px;color:#E5E5E5;margin-left:10px;">
				</div>

				<form action="write.php?action=post" method="POST">
					<?php /**ako se dodaju akcije,dopuniti datoteku write.php na liniji 15 **/ ?>
					<textarea name="post" class="status_post" placeholder="Napisite novost"></textarea>

					<div class="privacy">
						<select name="privacy" class="privacy_select">
							<option value="Privatno">Samo ja</option>
							<option value="Javno" selected>Svi</option>
						</select>
						<input type="file" name="file" class="file_browse">
						<button value="Objavi" class="submit_post" name="submit" onclick="post_status()">Objavi</button>

					</div>
				</form>

			</div>

		</div>

	</body>

</html>


