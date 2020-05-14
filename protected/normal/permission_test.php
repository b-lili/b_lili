<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Alapszintű felhasználó vagy, olvashatsz recepteket az adatbázisból!</h1>
	Permission check: <?=isset($_SESSION['permission']) ? $_SESSION['permission'] : "You don't have a permission level." ?>
<?php else : ?>
	<h1>Adminisztrátori jogod van, módosíthatod az adatbázis rekordjait, és láthatod a felhasználók adatait.</h1>
	<p>Your permission level is <?=$_SESSION['permission'] ?></p>
<?php endif; ?>