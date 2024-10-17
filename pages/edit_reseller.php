<?php require_once 'main/handleForms.php'; ?>
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
	<?php $getToyResellersByID = getToyResellerByID($pdo, $_GET['toy_reseller_id']); ?>
	<h1>Edit the user!</h1>
	<form action="main/handleForms.php?toy_reseller_id=<?php echo $_GET['toy_reseller_id']; ?>" method="POST">
		<p>
			<label for="first_name">First Name</label> 
			<input type="text" name="first_name" value="<?php echo $getToyResellersByID['first_name']; ?>">
		</p>
		<p>
			<label for="last_name">Last Name</label> 
			<input type="text" name="lastName" value="<?php echo $getToyResellersByID['last_name']; ?>">
		</p>
        <p>
			<label for="gender">Gender</label> 
			<input type="text" name="gender" value="<?php echo $getToyResellersByID['gender']; ?>">
		</p>
        <p>
			<label for="age">Age</label> 
			<input type="text" name="age" value="<?php echo $getToyResellersByID['age']; ?>">
		</p>
		<p>
			<label for="date_of_birth">Date of Birth</label> 
			<input type="date" name="dateOfBirth" value="<?php echo $getToyResellersByID['date_of_birth']; ?>">
		</p>
		<p>
			<label for="location">Location</label> 
			<input type="text" name="location" value="<?php echo $getToyResellersByID['location']; ?>">
			<input type="submit" name="editToyResellerBtn">
		</p>
	</form>
</body>
</html>
