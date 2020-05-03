<hr>

<a href="index.php">Főoldal</a>
<?php if(!IsUserLoggedIn()) : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=login">Belépés</a>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=register">Regisztráció</a>
<?php else : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=test">Permission test</a>

	<?php if(isset($_SESSION['permission']) && $_SESSION['permission'] >= 1) : ?>
		<span> &nbsp; || &nbsp; </span>
		<a href="index.php?P=users">Felhasználók</a>
		<span> &nbsp; | &nbsp; </span>
		<a href="index.php?P=list_reciept">Receptek</a>
		<span> &nbsp; | &nbsp; </span>
		<a href="index.php?P=add_reciept">Recept hozzáadása</a>
		<span> &nbsp; || &nbsp; </span>
	<?php else : ?>
		<span> &nbsp; | &nbsp; </span>
	<?php endif; ?>

	<a href="index.php?P=logout">Kijelentkezés</a>
<?php endif; ?>

<hr>