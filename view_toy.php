<?php 
require_once 'main/models.php'; 
require_once 'main/dbConfig.php'; 

// Validate and sanitize toy_reseller_id
$toy_reseller_id = filter_input(INPUT_GET, 'toy_reseller_id', FILTER_VALIDATE_INT);
$getToyResellerByID = getToyResellerByID($pdo, $toy_reseller_id); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Existing Toy</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Username: <?php echo $getToyResellerByID['username']; ?></h1>
    <h1>Add Existing Toy</h1>
	<a href="view_new_toy.php?toy_reseller_id=<?php echo $toy_reseller_id; ?>">Add a new toy</a>
    <form action="main/handleForms.php?toy_reseller_id=<?php echo $toy_reseller_id; ?>" method="POST">
        <p>
            <label for="toy">Select Existing Toy</label>
            <select name="existing_toy" id="toy">
                <option value="">Select a toy</option>
                <?php 
                $toys = getAllToys($pdo); 
                foreach ($toys as $toy) { ?>
                    <option value="<?php echo $toy['name'] . ' - ' . $toy['type']; ?>">
                        <?php echo $toy['name'] . ' - ' . $toy['type']; ?>
                    </option>
                <?php } ?>
            </select>
        </p>
        
        <input type="submit" name="insertExistingToyBtn" value="Add Toy">
    </form>
</div>
<a href="index.php">Return to home</a>
<hr>
<div class="table_container">
    <table>
        <tr>
            <th>Toy ID</th>
            <th>Toy Name</th>
            <th>Toy Type</th>
            <th>Date Added</th>
            <th>Action</th>
        </tr>
        <?php 
        // Fetch toys for the reseller
        $getToysByToyReseller = getToysByToyReseller($pdo, $toy_reseller_id); 
        foreach ($getToysByToyReseller as $row) { 
        ?>
        <tr>
            <td><?php echo $row['toy_id']; ?></td>     
            <td><?php echo $row['toy_name']; ?></td>     
            <td><?php echo $row['toy_type']; ?></td>     
            <td><?php echo $row['date_added']; ?></td>
            <td>
                <a href="edit_toy.php?toy_id=<?php echo $row['toy_id']; ?>&toy_reseller_id=<?php echo $toy_reseller_id; ?>">Edit</a>
                <a href="deletetoy.php?toy_id=<?php echo $row['toy_id']; ?>&toy_reseller_id=<?php echo $toy_reseller_id; ?>">Delete</a>
            </td>     
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
