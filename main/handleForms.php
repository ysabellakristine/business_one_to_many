<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertToyResellerBtn'])) {

	$query = insertToyReseller($pdo, $_POST['username'], $_POST['first_name'], 
			$_POST['last_name'], $_POST['date_of_birth'], $_POST['gender'], $_POST['location']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Insertion failed";
	}

}


if (isset($_POST['editToyResellerBtn'])) {
	$query = updateToyReseller($pdo, $_POST['username'], $_POST['first_name'], 
		$_POST['last_name'], $_POST['date_of_birth'], $_POST['gender'], $_POST['location'], $_GET['toy_reseller_id']);

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




if (isset($_POST['insertNewToyBtn'])) {
	$query = insertToys($pdo, $_POST['toy_name'], $_POST['toy_type'], $_GET['toy_reseller_id']);

	if ($query) {
		header("Location: ../viewprojects.php?toy_reseller_id=" .$_GET['toy_reseller_id']);
	}
	else {
		echo "Insertion failed";
	}
}




if (isset($_POST['editToyBtn'])) {
	$query = updateToys($pdo, $_POST['toy_name'], $_POST['toy_type'], $_GET['toy_id']);

	if ($query) {
		header("Location: ../viewprojects.php?toy_reseller_id=" .$_GET['toy_reseller_id']);
	}
	else {
		echo "Update failed";
	}

}




if (isset($_POST['deleteToyBtn'])) {
	$query = deleteToys($pdo, $_GET['toy_id']);

	if ($query) {
		header("Location: ../viewprojects.php?toy_reseller_id=" .$_GET['toy_reseller_id']);
	}
	else {
		echo "Deletion failed";
	}
}




?>



