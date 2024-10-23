<?php  

function insertToyReseller($pdo, $username, $first_name, $last_name, $gender, $age, $date_of_birth, $location) {

	$sql = "INSERT INTO toy_resellers (username, first_name, last_name, gender, age, date_of_birth, location) VALUES(?,?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username, $first_name, $last_name, $gender, $age, $date_of_birth, $location]);

	if ($executeQuery) {
		return true;
	}
}

function updateToyReseller($pdo, $username, $first_name, $last_name, $gender, $age, $date_of_birth, $location, $toy_reseller_id) {

	$sql = "UPDATE toy_resellers
				SET username = ?,
					first_name = ?,
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

function deleteToyReseller($pdo, $toy_reseller_id) {
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
        // Fetch the result
        $result = $stmt->fetch();
        
        // Return the result if found, otherwise return null
        return $result !== false ? $result : null; // Explicitly return null if no record is found
    }

    return null; // Return null if the query fails
}

function getToysByToyReseller($pdo, $toy_reseller_id) {
    $sql = "SELECT 
                toys.toy_id AS toy_id,
                toys.toy_name AS toy_name,
                toys.toy_type AS toy_type,
                toys.date_added AS date_added,
                CONCAT(toy_resellers.first_name, ' ', toy_resellers.last_name) AS toy_owner
            FROM toys
            JOIN toy_resellers ON toys.toy_reseller_id = toy_resellers.toy_reseller_id
            WHERE toys.toy_reseller_id = ?
            ORDER BY toys.toy_id ASC";  // Changed GROUP BY to ORDER BY

    $stmt = $pdo->prepare($sql);
    
    try {
        $executeQuery = $stmt->execute([$toy_reseller_id]);
        if ($executeQuery) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array
        }
    } catch (PDOException $e) {
        // Handle error (you can log it or display a user-friendly message)
        error_log($e->getMessage());
        return []; // Return an empty array on error
    }

    return []; // Return an empty array if nothing is fetched
}


function insertToys($pdo, $toy_name, $toy_type, $toy_reseller_id) {
    try {
        // Check if toy_reseller_id exists first
        $checkSql = "SELECT COUNT(*) FROM toy_resellers WHERE toy_reseller_id = ?";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$toy_reseller_id]);

        if ($checkStmt->fetchColumn() == 0) {
            // Toy reseller does not exist
            error_log("Toy reseller ID $toy_reseller_id does not exist.");
            return false;
        }

        // Proceed with toy insertion
        $sql = "INSERT INTO toys (toy_name, toy_type, toy_reseller_id) VALUES (?,?,?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$toy_name, $toy_type, $toy_reseller_id]);

        if ($executeQuery) {
            return true;
        }

    } catch (PDOException $e) {
        // Log any PDO exceptions
        error_log("Error inserting toy: " . $e->getMessage());
        return false;
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

function getAllToysWithOwner($pdo) {
    $sql = "SELECT 
                toys.toy_id AS toy_id,
                toys.toy_name AS toy_name,
                toys.toy_type AS toy_type,
                toys.date_added AS date_added,
                CONCAT(toy_resellers.first_name, ' ', toy_resellers.last_name) AS toy_owner
            FROM toys
            LEFT JOIN toy_resellers ON toys.toy_reseller_id = toy_resellers.toy_reseller_id
            ORDER BY toys.toy_id ASC";

    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch associative array for better readability
    } catch (PDOException $e) {
        // Log the error message or handle it as needed
        error_log($e->getMessage());
        return []; // Return an empty array on error
    }
}



function getAllToys($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT toy_id, toy_name AS name, toy_type AS type FROM toys");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching toys: " . $e->getMessage();
        return [];
    }
}

