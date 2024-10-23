<?php require_once 'main/handleForms.php'; ?>
<?php require_once 'main/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Toy Reseller</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <?php $getToyResellersByID = getToyResellerByID($pdo, $_GET['toy_reseller_id']); ?>
    
    <h1>Edit the Toy Reseller!</h1>

    <!-- Display error message if exists -->
    <?php if (isset($error_message)): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form action="main/handleForms.php?toy_reseller_id=<?php echo $_GET['toy_reseller_id']; ?>" method="POST">
		<p>
    	<label for="username">Username</label> 
    	<input type="text" name="username" value="<?php echo $getToyResellersByID['username']; ?>" required>
		</p>

        <p>
            <label for="first_name">First Name</label> 
            <input type="text" name="first_name" value="<?php echo $getToyResellersByID['first_name']; ?>" required>
        </p>
        <p>
            <label for="last_name">Last Name</label> 
            <input type="text" name="last_name" value="<?php echo $getToyResellersByID['last_name']; ?>" required>
        </p>
        <p>
            <label for="gender">Gender</label>
            <select name="gender" required>
                <option value="">--Select Gender--</option>
                <?php
                $genders = ["Male", "Female", "Nonbinary", "Secret", "Helicopter"];
                foreach ($genders as $gender) {
                    $selected = ($gender === $getToyResellersByID['gender']) ? "selected" : "";
                    echo "<option value='$gender' $selected>$gender</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <label for="age">Age</label> 
            <input type="number" name="age" value="<?php echo $getToyResellersByID['age']; ?>" required>
        </p>
        <p>
            <label for="date_of_birth">Date of Birth</label> 
            <input type="date" name="date_of_birth" value="<?php echo $getToyResellersByID['date_of_birth']; ?>" required>
        </p>
        <p>
            <label for="location">Location</label> 
            <input type="text" name="location" value="<?php echo $getToyResellersByID['location']; ?>" required>
        </p>
        <p>
            <input type="submit" name="editToyResellerBtn" value="Edit">
        </p>
    </form>
</div>
</body>
</html>
