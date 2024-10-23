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
<div class="container">
	<a href="view_toy.php?toy_reseller_id=<?php echo $_GET['toy_reseller_id']; ?>">
	View The Toys</a>
	<h1>Edit the Toy!</h1>
	<?php $getToyByID = getToyByID($pdo, $_GET['toy_id']); ?>
	<form action="main/handleForms.php?toy_id=<?php echo $_GET['toy_id']; ?>
	&toy_reseller_id=<?php echo $_GET['toy_reseller_id']; ?>" method="POST">
		<p>
			<label for="first_name">Toy Name</label> 
			<input type="text" name="toy_name" 
			value="<?php echo $getToyByID['toy_name']; ?>">
		</p>
		<p>
			<label for="toy_type">Toy Type</label> 
			<input type="text" name="toy_type" 
			value="<?php echo $getToyByID['toy_type']; ?>">
			<input type="submit" name="editToyBtn">
		</p>
	</form>
	</div>
</body>
</html>
