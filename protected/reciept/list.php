<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>
<?php 
	if(array_key_exists('d', $_GET) && !empty($_GET['d'])) {
		$query = "DELETE FROM sutemeny WHERE id = :id";
		$params = [':id' => $_GET['d']];
		require_once DATABASE_CONTROLLER;
		if(!executeDML($query, $params)) {
			echo "Hiba törlés közben!";
		}
	}
?>

<?php 
	$query = "SELECT id, sutinev, hozzavalok, elkeszitesi_ido, nehezseg, szerzo_id FROM sutemeny";
	require_once DATABASE_CONTROLLER;
	$sutemeny = getList($query);
?>
	<?php if(count($sutemeny) <= 0) : ?>
		<h1>Nem található recept az adatbázisban.</h1>
	<?php else : ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Sütemény neve</th>
					<th scope="col">Hozzávalók</th>
					<th scope="col">Elkészítési idő</th>
					<th scope="col">Nehézség</th>
					<th scope="col">Szerző</th>
					<th scope="col">Szerkesztés</th>
					<th scope="col">Törlés</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($sutemeny as $r) : ?>
					<?php $i++; ?>
					<tr>
						<th scope="row"><?=$i ?></th>
						<td><?=$r['sutinev'] ?></td>
						<td><?=$r['hozzavalok'] ?></td>
						<td><?=$r['elkeszitesi_ido'] ?></td>
						<td><?=$r['nehezseg'] == 0 ? 'Könnyű' : ($r['nehezseg'] == 1 ? 'Közepes' : 'Nehéz') ?></td>
						<td><?=$r['szerzo_id'] ?></td>
						<td><a href="?P=modify_reciept&r=<?=$r['id'] ?>">Edit</a></td>
						<td><a href="?P=list_reciept&d=<?=$r['id'] ?>">Delete</a></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	<?php endif; ?>
<?php endif; ?>