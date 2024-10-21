<?php 
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

// Check if 'web_dev_id' is set and valid
if (!isset($_GET['web_dev_id']) || !is_numeric($_GET['web_dev_id'])) {
    echo "Invalid user ID.";
    exit;
}

$web_dev_id = $_GET['web_dev_id'];

// Fetch the user by ID
$getWebDevByID = getWebDevByID($pdo, $web_dev_id);

// Check if the user exists
if (!$getWebDevByID) {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete User</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this user?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>First Name: <?php echo htmlspecialchars($getWebDevByID['first_name'], ENT_QUOTES, 'UTF-8'); ?></h2>
		<h2>Last Name: <?php echo htmlspecialchars($getWebDevByID['last_name'], ENT_QUOTES, 'UTF-8'); ?></h2>
		<h2>Email: <?php echo htmlspecialchars($getWebDevByID['email'], ENT_QUOTES, 'UTF-8'); ?></h2>
		<h2>Date of Birth: <?php echo htmlspecialchars($getWebDevByID['date_of_birth'], ENT_QUOTES, 'UTF-8'); ?></h2>
		<h2>Specialization: <?php echo htmlspecialchars($getWebDevByID['purpose'], ENT_QUOTES, 'UTF-8'); ?></h2>
		<h2>Date Added: <?php echo htmlspecialchars($getWebDevByID['date_added'], ENT_QUOTES, 'UTF-8'); ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?web_dev_id=<?php echo $web_dev_id; ?>" method="POST">
				<input type="submit" name="deleteWebDevBtn" value="Delete">
			</form>			
		</div>	

	</div>
</body>
</html>
