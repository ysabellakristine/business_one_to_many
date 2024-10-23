<?php require_once 'main/models.php'; ?>
<?php require_once 'main/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Welcome To the Toy Resellers System. <br> Insert a Toy Reseller below!</h1>
    <form action="main/handleForms.php" method="POST">
        <p>
            <label for="username">Username</label> 
            <input type="text" name="username" required>
        </p>
        <p>
            <label for="first_name">First Name</label> 
            <input type="text" name="first_name" required>
        </p>
        <p>
            <label for="last_name">Last Name</label> 
            <input type="text" name="last_name" required>
        </p>
        <p>
            <label for="gender">Gender</label>
            <select name="gender" required>
                <option value="">--Select Gender--</option>
                <?php
                $genders = ["Male", "Female", "Nonbinary", "Secret", "Helicopter"];
                foreach ($genders as $gender) {
                    echo "<option value='$gender'>$gender</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <label for="age">Age</label> 
            <input type="number" name="age" min="0" required>
        </p>
        <p>
            <label for="date_of_birth">Date of Birth</label> 
            <input type="date" name="date_of_birth" required>
        </p>
        <p>
            <label for="location">Location</label> 
            <input type="text" name="location" required>
        </p>
        <p>
            <input type="submit" name="insertToyResellerBtn" value="Insert Toy Reseller">
        </p>
    </form>
</div>
<hr>
<div class="table_container">
	<h2> Toy Resellers</h2>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Location</th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $getAllToyResellers = getAllToyResellers($pdo); ?>
            <?php foreach ($getAllToyResellers as $row) { ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['date_of_birth']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['date_added']; ?></td>
                    <td>
                        <div class="editAndDelete">
                            <a href="view_toy.php?toy_reseller_id=<?php echo $row['toy_reseller_id']; ?>">View Toys</a>
                            <a href="edit_reseller.php?toy_reseller_id=<?php echo $row['toy_reseller_id']; ?>">Edit</a>
                            <a href="deletereseller.php?toy_reseller_id=<?php echo $row['toy_reseller_id']; ?>">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<hr>
<div class="table_container">
    <h2>List of Toys and Their Owners</h2>
    <table>
        <thead>
            <tr>
                <th>Toy ID</th>
                <th>Toy Name</th>
                <th>Toy Type</th>
                <th>Date Added</th>
                <th>Toy Owner</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $toysWithOwners = getAllToysWithOwner($pdo); // Ensure this function is defined in models.php
            if (empty($toysWithOwners)) {
                echo "<tr><td colspan='5'>No toys found.</td></tr>";
            } else {
                foreach ($toysWithOwners as $toy) { ?>
                    <tr>
                        <td><?php echo $toy['toy_id']; ?></td>
                        <td><?php echo $toy['toy_name']; ?></td>
                        <td><?php echo $toy['toy_type']; ?></td>
                        <td><?php echo $toy['date_added']; ?></td>
                        <td><?php echo $toy['toy_owner']; ?></td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</div> 
</body>
</html>
