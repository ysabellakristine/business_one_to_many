<?php require_once 'main/dbConfig.php'; ?>
<?php require_once 'main/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getToyByID = getToyByID($pdo, $_GET['toy_id']); ?>
	<h1>Are you sure you want to delete this toy?</h1>
	<div class="container">
		<h2>Toy Name: <?php echo $getToyByID['toy_name'] ?></h2>
		<h2>Toy Type: <?php echo $getToyByID['toy_type'] ?></h2>
		<h2>Toy Owners: <?php echo $getToyByID['toy_owner'] ?></h2>
		<h2>Date Added: <?php echo $getToyByID['date_added'] ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">

			<form action="main/handleForms.php?toy_id=<?php echo $_GET['toy_id']; ?>&toy_reseller_id=<?php echo $_GET['toy_reseller_id']; ?>" method="POST">
				<input type="submit" name="deleteToyBtn" value="Delete">
			</form>			
			
		</div>	

	</div>
</body>
</html>
