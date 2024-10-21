<?php 
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Projects</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="index.php">Return to home</a>

    <!-- Fetch customer details -->
    <?php 
    if (isset($_GET['customer_id'])) {
        $customerId = $_GET['customer_id'];
        $getAllInfoByWebDevID = getAllInfoByWebDevID($pdo, $customerId);
    } else {
        echo "<p>Error: Customer ID is missing.</p>";
        exit;
    }
    ?>
    
    <h1>Name: <?php echo htmlspecialchars($getAllInfoByWebDevID['first_name'], ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($getAllInfoByWebDevID['last_name'], ENT_QUOTES, 'UTF-8'); ?></h1>

    <h1>Add New Project</h1>
    <form action="core/handleForms.php?customer_id=<?php echo htmlspecialchars($customerId, ENT_QUOTES, 'UTF-8'); ?>" method="POST">
        <p>
            <label for="projectName">PC Name</label> 
            <input type="text" name="projectName" id="projectName" required>
        </p>
        <p>
            <label for="technologiesUsed">PC Specs</label> 
            <input type="text" name="technologiesUsed" id="technologiesUsed" required>
            <input type="submit" name="insertNewProjectBtn" value="Add Project">
        </p>
    </form>

    <table style="width:100%; margin-top: 50px;">
        <tr>
            <th>PC ID</th>
            <th>PC Name</th>
            <th>PC Specs</th>
            <th>PC Rented</th>
            <th>Date Added</th>
            <th>Action</th>
        </tr>
        
        <!-- Fetch and display projects -->
        <?php 
        $getProjectsByWebDev = getProjectsByWebDev($pdo, $customerId);

        // Debug output to check if data is fetched
        echo "<pre>";
        print_r($getProjectsByWebDev);
        echo "</pre>";

        // Check if there is any project data before looping
        if (!empty($getProjectsByWebDev)) {
            foreach ($getProjectsByWebDev as $row) { 
        ?>
        <tr>
            <td><?php echo htmlspecialchars($row['pc_id'], ENT_QUOTES, 'UTF-8'); ?></td>      
            <td><?php echo htmlspecialchars($row['pc_name'], ENT_QUOTES, 'UTF-8'); ?></td>       
            <td><?php echo htmlspecialchars($row['pc_specs'], ENT_QUOTES, 'UTF-8'); ?></td>     
            <td><?php echo htmlspecialchars($row['pc_rented'], ENT_QUOTES, 'UTF-8'); ?></td>    
            <td><?php echo htmlspecialchars($row['date_added'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <a href="editproject.php?pc_id=<?php echo htmlspecialchars($row['pc_id'], ENT_QUOTES, 'UTF-8'); ?>&customer_id=<?php echo htmlspecialchars($customerId, ENT_QUOTES, 'UTF-8'); ?>">Edit</a>
                <a href="deleteproject.php?pc_id=<?php echo htmlspecialchars($row['pc_id'], ENT_QUOTES, 'UTF-8'); ?>&customer_id=<?php echo htmlspecialchars($customerId, ENT_QUOTES, 'UTF-8'); ?>">Delete</a>
            </td>       
        </tr>
        <?php 
            } // End foreach loop
        } else {
            echo "<tr><td colspan='6'>No projects found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
