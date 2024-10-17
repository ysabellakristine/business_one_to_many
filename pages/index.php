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
	<h1>Welcome To Web Dev Projects Management System. Add new Web Devs!</h1>
	<form action="main/handleForms.php" method="POST">
		<p>
			<label for="firstName">Username</label> 
			<input type="text" name="username">
		</p>
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName">
		</p>
		<p>
			<label for="firstName">Last Name</label> 
			<input type="text" name="lastName">
		</p>
		<p>
			<label for="firstName">Date of Birth</label> 
			<input type="date" name="dateOfBirth">
		</p>
		<p>
			<label for="firstName">Specialization</label> 
			<input type="text" name="specialization">
			<input type="submit" name="insertWebDevBtn">
		</p>
	</form>
	<?php $getAllToyResellers = getAllToyResellers($pdo); ?>
	<?php foreach ($getAllToyResellers as $row) { ?>
	<div class="container" style="border-style: solid; width: 50%; height: 300px; margin-top: 20px;">
		<h3>Username: <?php echo $row['username']; ?></h3>
		<h3>FirstName: <?php echo $row['first_name']; ?></h3>
		<h3>LastName: <?php echo $row['last_name']; ?></h3>
        <h3>Gender: <?php echo $row['gender']; ?></h3>
        <h3>Age: <?php echo $row['age']; ?></h3>
		<h3>Date Of Birth: <?php echo $row['date_of_birth']; ?></h3>
		<h3>Specialization: <?php echo $row['location']; ?></h3>
		<h3>Date Added: <?php echo $row['date_added']; ?></h3>


		<div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="viewprojects.php?toy_reseller_id=<?php echo $row['toy_reseller_id']; ?>">View Projects</a>
			<a href="editwebdev.php?toy_reseller_id=<?php echo $row['toy_reseller_id']; ?>">Edit</a>
			<a href="deletewebdev.php?toy_reseller_id=<?php echo $row['toy_reseller_id']; ?>">Delete</a>
		</div>


	</div> 
	<?php } ?>
</body>
</html>
