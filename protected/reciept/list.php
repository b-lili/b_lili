<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>
<?php 
	$query = "SELECT sutinev, hozzavalok, elkeszitesi_ido, nehezseg, szerzo FROM sutemeny";
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
					<th scope="col">Hozzávalók</th>
					<th scope="col">Törlés</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($felhasznalo as $w) : ?>
					<?php $i++; ?>
					<tr>
						<th scope="row"><?=$i ?></th>
						<td><?=$w['sutinev'] ?></td>
						<td><?=$w['hozzavalok'] ?></td>
						<td><?=$w['elkeszitesi_ido'] ?></td>
						<td><?=$w['nehezseg'] == 0 ? 'Könnyű' : ($w['nehezseg'] == 1 ? 'Közepes' : 'Nehéz') ?></td>
						<td><?=$w['szerzo'] ?></td>
						<td><a href="#">Edit</a></td>
						<td><a href="#">Delete</a></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	<?php endif; ?>
<?php endif; ?>