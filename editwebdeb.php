<?php 
require_once 'core/handleForms.php'; 
require_once 'core/models.php'; 

// Check if 'customer_id' is set and valid
if (!isset($_GET['customer_id']) || !is_numeric($_GET['customer_id'])) {
    echo "Invalid customer ID.";
    exit;
}

$customer_id = $_GET['customer_id'];

// Fetch the web developer data by ID
$getWebDevByID = getWebDevByID($pdo, $customer_id);

// Check if the customer exists
if (!$getWebDevByID) {
    echo "Customer not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Web Developer</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Edit the user!</h1>

	<form action="core/handleForms.php?customer_id=<?php echo htmlspecialchars($customer_id, ENT_QUOTES, 'UTF-8'); ?>" method="POST">
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName" value="<?php echo htmlspecialchars($getWebDevByID['first_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
		</p>
		<p>
			<label for="lastName">Last Name</label> 
			<input type="text" name="lastName" value="<?php echo htmlspecialchars($getWebDevByID['last_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
		</p>
		<p>
			<label for="email">Email</label> 
			<input type="email" name="email" value="<?php echo htmlspecialchars($getWebDevByID['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
		</p>
		<p>
			<label for="purpose">Purpose</label> 
			<input type="text" name="purpose" value="<?php echo htmlspecialchars($getWebDevByID['purpose'], ENT_QUOTES, 'UTF-8'); ?>" required>
		</p>
		<p>
			<input type="submit" name="editWebDevBtn" value="Update User">
		</p>
	</form>
</body>
</html>
