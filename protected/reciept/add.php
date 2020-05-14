<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>

	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addSutemeny'])) {
		$postData = [ 
			'sutiNev' => $_POST['sutiNev'],
			'hozzavalok' => $_POST['hozzavalok'],
			'elkeszitesi_ido' => $_POST['elkeszitesi_ido'],
			'nehezseg' => $_POST['nehezseg'],
			'szerzo_id' => $_SESSION['uid'] 
		];

		if(empty($postData['sutiNev']) || empty($postData['hozzavalok']) || empty($postData['elkeszitesi_ido']) || $postData['nehezseg'] < 0 && $postData['nehezseg'] > 2) {
			echo "Hiányzó adat(ok)!";
		}
		else {
			$query = "INSERT INTO sutemeny (sutiNev, hozzavalok, elkeszitesi_ido, nehezseg, szerzo_id) VALUES (:sutiNev, :hozzavalok, :elkeszitesi_ido, :nehezseg, :szerzo_id)";
			
			$params = [
				':sutiNev' => $postData['sutiNev'],
				':hozzavalok' => $postData['hozzavalok'],
				':elkeszitesi_ido' => $postData['elkeszitesi_ido'],
				':nehezseg' => $postData['nehezseg'],
				':szerzo_id' => $_SESSION['uid']  
			];
			
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query, $params)) {
				echo "Hiba az adatbevitel során!";
			}
			header('Location: index.php');
		}
	}
	?>

	<form method="post">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="sutiNev">Sütemény neve</label>
				<input type="text" class="form-control" id="sutiNev" name="sutiNev">
			</div>
			<div class="form-group col-md-6">
				<label for="hozzavalok">Hozzávalók</label>
				<input type="text" class="form-control" id="hozzavalok" name="hozzavalok">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="elkeszitesi_ido">Elkészítési idő</label>
				<input type="elkeszitesi_ido" class="form-control" id="elkeszitesi_ido" name="elkeszitesi_ido">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
		    	<label for="nehezseg">Nehézségi fok</label>
		    	<select class="form-control" id="nehezseg" name="nehezseg">
		      		<option value="0">Könnyű</option>
		      		<option value="1">Közepes</option>
		      		<option value="2">Nehéz</option>
		    	</select>
		  	</div>
		</div>
	<!-- 
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="szerzo_id">Szerző</label>
				<input type="text" class="form-control" id="szerzo_id" name="szerzo_id">
			</div>
		</div>
	-->
		<button type="submit" class="btn btn-primary" name="addSutemeny">Recept hozzáadása</button>
	</form>
<?php endif; ?>