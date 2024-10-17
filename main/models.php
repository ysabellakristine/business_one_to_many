<?php  

function insertToyReseller($pdo, $username, $first_name, $last_name, $gender, $age, $date_of_birth, $location) {

	$sql = "INSERT INTO toy_resellers (username, first_name, last_name, gender, age, date_of_birth, location) VALUES(?,?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username, $first_name, $last_name, $gender, $age, $date_of_birth, $location]);

	if ($executeQuery) {
		return true;
	}
}



function updateToyResller($pdo, $username, $first_name, $last_name, $gender, $age, $date_of_birth, $location, $toy_reseller_id) {

	$sql = "UPDATE toy_resellers
				SET first_name = ?,
					last_name = ?,
                    gender = ?,
                    age = ?,
					date_of_birth = ?, 
					location = ?
				WHERE toy_reseller_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username, $first_name, $last_name, $gender, $age, $date_of_birth, $location, $toy_reseller_id]);
	
	if ($executeQuery) {
		return true;
	}

}


function deleteToys($pdo, $toy_reseller_id) {
	$deleteToys = "DELETE FROM toys WHERE toy_reseller_id = ?";
	$deleteStmt = $pdo->prepare($deleteToys);
	$executeDeleteQuery = $deleteStmt->execute([$toy_reseller_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM toy_resellers WHERE toy_reseller_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$toy_reseller_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}




function getAllToyResellers($pdo) {
	$sql = "SELECT * FROM toy_resellers";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getToyResellerByID($pdo, $toy_reseller_id) {
	$sql = "SELECT * FROM toy_resellers WHERE toy_reseller_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$toy_reseller_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}





function getToysByToyReseller($pdo, $toy_reseller_id) {
	
	$sql = "SELECT 
				toys.toy_id AS toy_id,
				toys.toy_name AS toy_name,
				toys.toy_type AS toy_type,
				toys.date_added AS date_added,
				CONCAT(toy_resellers.first_name,' ',toy_resellers.last_name) AS toy_owner
			FROM toys
			JOIN toy_resellers ON toys.toy_reseller_id = toy_reseller.toy_reseller_id
			WHERE toys.toy_reseller_id = ? 
			GROUP BY toys.toy_name;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$toy_reseller_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function insertToys($pdo, $toy_name, $toy_type, $toy_reseller_id) {
	$sql = "INSERT INTO toys (toy_name, toy_type, toy_reseller_id) VALUES (?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$toy_name, $toy_type, $toy_reseller_id]);
	if ($executeQuery) {
		return true;
	}

}

function getToyByID($pdo, $toy_id) {
	$sql = "SELECT 
				toys.toy_id AS toy_id,
				toys.toy_name AS toy_name,
				toys.toy_type AS toy_type,
				toys.date_added AS date_added,
				CONCAT(toy_resellers.first_name,' ',toy_resellers.last_name) AS toy_owner
			FROM toys
			JOIN toy_resellers ON toys.toy_reseller_id = toy_resellers.toy_reseller_id
			WHERE toys.toy_id  = ? 
			GROUP BY toys.toy_name";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$toy_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updatetoy($pdo, $toy_name, $toy_type, $toy_id) {
	$sql = "UPDATE toys
			SET toy_name = ?,
				toy_type = ?
			WHERE toy_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$toy_name, $toy_type, $toy_id]);

	if ($executeQuery) {
		return true;
	}
}

function deletetoy($pdo, $toy_id) {
	$sql = "DELETE FROM toys WHERE toy_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$toy_id]);
	if ($executeQuery) {
		return true;
	}
}

?>
