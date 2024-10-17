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
	<h1>Are you sure you want to delete this user?</h1>
	<?php $getToyResellersByID = getToyResellerByID($pdo, $_GET['toy_reseller_id']); ?>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Username: <?php echo $getToyResellersByID['username']; ?></h2>
		<h2>FirstName: <?php echo $getToyResellersByID['first_name']; ?></h2>
		<h2>LastName: <?php echo $getToyResellersByID['last_name']; ?></h2>
		<h2>Date Of Birth: <?php echo $getToyResellersByID['date_of_birth']; ?></h2>
		<h2>Specialization: <?php echo $getToyResellersByID['specialization']; ?></h2>
		<h2>Date Added: <?php echo $getToyResellersByID['date_added']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="main/handleForms.php?toy_reseller_id=<?php echo $_GET['toy_reseller_id']; ?>" method="POST">
				<input type="submit" name="deleteToyResellerBtn" value="Delete">
			</form>			
		</div>	

	</div>
</body>
</html>
