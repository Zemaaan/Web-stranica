<!--suppress JSJQueryEfficiency -->
<script>
	function feed() {
			var id = $("#id").val();
			var dataString = "id=" + id;
			$.ajax({
				type: "POST",
				url: "naslovnica_feed.php",
				data: dataString,
				beforeSend: function () {
					$('.loading_gif').css('display:inline');
				},
				success: function (response) {

					$('table.objave').html(response);


				}
			});
		)
	}


	(function () {
		setInterval(news_feed, 60000);
	})();


	$(document).ajaxSend(function () {
		$('.ajax_gif').show();
	});

	$(document).ajaxComplete(function () {
		$('.ajax_gif').hide();
	});

	$(document).ready(function () {
		feed(); // prikazivanje tablice kod učitavanja cijelog dokumenta

	});

</script>
<style>
	.login_bar{
		background-color: #3A5795;
		height: 86px;
		min-width: 1359px;
	    margin-left:-7px;
	margin-top:-10px;}
	.login_form{margin-top:30px;position: absolute;margin-left:50px;}
	.password_login{margin-left:10px;position: absolute;}
	.submit_login{position:absolute;margin-left:310px;margin-top:-21px;color:white;background-color:#5B74A8;border:0 solid transparent;}

</style>

<div class="login_bar">
	<img src="mreža_slika.png" style="margin-left:1000px;position:absolute;margin-top:15px;">
	<form class="login_form" action="login_write.php" method="post">
		<input class="email_login" name="email"/>
		<input class="password_login" name="password" type="password"/>
		<input type="submit" class="submit_login" value="Log In" name="submit"/>
	</form>
</div>
<div class="objave" style="resize:horizontal;height:510px; width:700px;margin-top:20px;margin-left:75px;border-radius:5px;overflow:auto;position:absolute;border:1px solid black;">
	<table>
		<?php

		$podaci_za_povezivanje = mysqli_connect('localhost', 'root', '3TBZE3u8lS', 'Mreza_company');//potrebno promjeniti bazu podataka i podatke za povezivanja za mreža company

		$provjera = mysqli_query($podaci_za_povezivanje,"CREATE TABLE IF NOT EXISTS naslovnica(poster_id INT,postID INT AUTO_INCREMENT,vrijeme VARCHAR(30),vaznost VARCHAR(30) )");

		$upit = mysqli_query($podaci_za_povezivanje, "SELECT * FROM naslovnica WHERE vaznost = 'vazno'");
		$broj_redova = mysqli_num_rows($upit);
		while($user = mysqli_fetch_array($upit))
		?>
	</table>
</div>
<?php include('registration_form.php'); ?>


