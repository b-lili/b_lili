<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>

<?php 
if(!array_key_exists('r', $_GET) || empty($_GET['r'])) : 
	header('Location: index.php');

else: 
		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifySutemeny'])) {
			$postData = [
				'sutinev' => $_POST['sutinev'],
				'hozzavalok' => $_POST['hozzavalok'],
				'elkeszitesi_ido' => $_POST['elkeszitesi_ido'],
				'nehezseg' => $_POST['nehezseg'],
				'szerzo_id' => $_SESSION['uid'] 
			];

			if(empty($postData['sutinev']) || empty($postData['hozzavalok']) || empty($postData['elkeszitesi_ido']) || empty($postData['szerzo_id']) || $postData['nehezseg'] < 0 || $postData['nehezseg'] > 2) {
				//$test = empty($postData['sutinev']);
				//var_dump($test);
				//var_dump($postData['sutinev']);
				//var_dump($postData);
				echo "Hiányzó adat(ok)!";
			}
			else {
				$query = "UPDATE sutemeny SET sutinev = :sutinev, hozzavalok = :hozzavalok, elkeszitesi_ido = :elkeszitesi_ido, nehezseg = :nehezseg, szerzo_id = :szerzo_id WHERE id = :id";
				$params = [
					':id' => $_GET['r'],
					':sutinev' => $postData['sutinev'],
					':hozzavalok' => $postData['hozzavalok'],
					':elkeszitesi_ido' => $postData['elkeszitesi_ido'],
					':nehezseg' => $postData['nehezseg'],
					':szerzo_id' => $_SESSION['uid'] 
				];
				require_once DATABASE_CONTROLLER;
				if(!executeDML($query, $params)) {
					echo "Hiba módosítás közben!";
				}
			}
		}
	
	$query = "SELECT id, sutinev, hozzavalok, elkeszitesi_ido, nehezseg FROM sutemeny WHERE id = :id"; 
	$params = [':id' => $_GET['r']]; 
	require_once DATABASE_CONTROLLER; 
	$sutemeny = getRecord($query, $params); 
	if(empty($sutemeny)) : 
		header('Location: index.php'); 
	else : ?>
		
		<form method="post">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="sutinev">Sütemény neve</label>
						<input type="text" class="form-control" id="sutinev" name="sutinev" value="<?=$sutemeny['sutinev'] ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="hozzavalok">Hozzávalók</label>
						<input type="text" class="form-control" id="hozzavalok" name="hozzavalok" value="<?=$sutemeny['hozzavalok'] ?>">
					</div>
				</div>
	
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="elkeszitesi_ido">Elkészítési idő</label>
						<input type="elkeszitesi_ido" class="form-control" id="elkeszitesi_ido" name="elkeszitesi_ido" value="<?=$sutemeny['elkeszitesi_ido'] ?>">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
				    	<label for="nehezseg">Nehézségi fok</label>
				    	<select class="form-control" id="nehezseg" name="nehezseg">
				    		<option value="<?$sutemeny['nehezseg']?>" selected="selected">
				    			<?php
				    				if($sutemeny['nehezseg'] == 0){
				    					echo "Könnyű";
				    				}
				    				elseif ($sutemeny['nehezseg'] == 1) {
				    					echo "Közepes";
				    				}
				    				else {
				    					echo "Nehéz";
				    				}
				    			?>
				    		</option>
				      		<option value="0">Könnyű</option>
				      		<option value="1">Közepes</option>
				      		<option value="2">Nehéz</option>
				    	</select>
				  	</div>
				</div>
			<button type="submit" class="btn btn-primary" name="modifySutemeny">Recept módosítása</button>
		</form>

	<?php endif; 
endif; 
?> 
<?php endif; ?>