<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertToyResellerBtn'])) {

	$query = insertToyReseller($pdo, $_POST['username'], $_POST['first_name'], 
			$_POST['last_name'], $_POST['gender'], $_POST['age'], $_POST['date_of_birth'], 
			$_POST['location']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Insertion failed";
	}

}

if (isset($_POST['editToyResellerBtn'])) {
	$query = updateToyReseller($pdo, $_POST['username'], $_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['age'], $_POST['date_of_birth'], $_POST['location'], $_GET['toy_reseller_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Edit failed";;
	}

}


if (isset($_POST['editToyBtn'])) {
	$query = updatetoy($pdo, $_POST['toy_name'], $_POST['toy_type'], 
		$_POST['toy_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Edit failed";;
	}

}




if (isset($_POST['deleteToyResellerBtn'])) {
	$query = deleteToyReseller($pdo, $_GET['toy_reseller_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}

if (isset($_POST['insertExistingToyBtn'])) {
    $existing_toy = $_POST['existing_toy'];
    $toy_reseller_id = filter_input(INPUT_GET, 'toy_reseller_id', FILTER_VALIDATE_INT);

    if (!empty($existing_toy)) {
        list($toy_name, $toy_type) = explode(' - ', $existing_toy);

        // Query to update the toy's reseller
        $query = $pdo->prepare("UPDATE toys SET toy_reseller_id = :toy_reseller_id WHERE toy_name = :toy_name AND toy_type = :toy_type");
        $query->bindParam(':toy_reseller_id', $toy_reseller_id);
        $query->bindParam(':toy_name', $toy_name);
        $query->bindParam(':toy_type', $toy_type);
        
        if ($query->execute()) {
            header("Location: ../view_toy.php?toy_reseller_id=" . $toy_reseller_id);
            exit; 
        } else {
            echo "Insertion failed";
        }
    } else {
        echo "No toy selected.";
    }
}


if (isset($_POST['insertNewToyBtn'])) {
    $toy_name = filter_input(INPUT_POST, 'toy_name', FILTER_SANITIZE_STRING);
    $toy_type = filter_input(INPUT_POST, 'toy_type', FILTER_SANITIZE_STRING);
    $toy_reseller_id = filter_input(INPUT_GET, 'toy_reseller_id', FILTER_VALIDATE_INT);

    // Insert new toy with valid toy_reseller_id
    if ($toy_reseller_id !== false && insertToys($pdo, $toy_name, $toy_type, $toy_reseller_id)) {
        header("Location: ../view_new_toy.php?toy_reseller_id=" . $toy_reseller_id);
        exit;
    } else {
        echo "Failed to add new toy. Please check the reseller ID and other inputs.";
    }
}






if (isset($_POST['editToyBtn'])) {
	$query = updateToy($pdo, $_POST['toy_name'], $_POST['toy_type'], $_GET['toy_id']);

	if ($query) {
		header("Location: ../view_toy.php?toy_reseller_id=" .$_GET['toy_reseller_id']);
	}
	else {
		echo "Update failed";
	}

}


if (isset($_POST['deleteToyBtn'])) {
	$query = deleteToy($pdo, $_GET['toy_id']);

	if ($query) {
		header("Location: ../view_toy.php?toy_reseller_id=" .$_GET['toy_reseller_id']);
	}
	else {
		echo "Deletion failed";
	}
}


