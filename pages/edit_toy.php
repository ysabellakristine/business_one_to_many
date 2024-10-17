<?php require_once 'main/models.php'; ?>
<?php require_once 'main/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="viewToys.php?toy_reseller_id=<?php echo $_GET['toy_reseller_id']; ?>">
	View The Toys</a>
	<h1>Edit the Toy!</h1>
	<?php $getToyByID = getToyByID($pdo, $_GET['Toy_id']); ?>
	<form action="main/handleForms.php?Toy_id=<?php echo $_GET['Toy_id']; ?>
	&toy_reseller_id=<?php echo $_GET['toy_reseller_id']; ?>" method="POST">
		<p>
			<label for="first_name">Toy Name</label> 
			<input type="text" name="Toy_name" 
			value="<?php echo $getToyByID['Toy_name']; ?>">
		</p>
		<p>
			<label for="toy_type">Toy Type</label> 
			<input type="text" name="toy_type" 
			value="<?php echo $getToyByID['toy_type']; ?>">
			<input type="submit" name="editToyBtn">
		</p>
	</form>
</body>
</html>
