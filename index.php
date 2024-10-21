<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Virtual PC Renting</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Welcome to Virtual PC Renting. Add new Users!</h1>

	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="firstName">First Name</label>
			<input type="text" name="firstName" id="firstName" required>
		</p>
		<p>
			<label for="lastName">Last Name</label>
			<input type="text" name="lastName" id="lastName" required>
		</p>
        <p>
			<label for="email">Email</label>
			<input type="email" name="email" id="email" required>
		</p>
		<p>
			<label for="purpose">Purpose</label>
			<input type="text" name="purpose" id="purpose" required>
		</p>
		<p>
			<input type="submit" name="insertWebDevBtn" value="Add User">
		</p>
	</form>

	<?php 
		$getAllWebDevs = getAllWebDevs($pdo); 
		if (!empty($getAllWebDevs)) {
	?>
		<h2>Existing Users</h2>
		<?php foreach ($getAllWebDevs as $row) { ?>
			<div class="container" style="border: 1px solid; width: 50%; height: auto; margin-top: 20px; padding: 10px;">
				<h3>First Name: <?php echo htmlspecialchars($row['first_name'], ENT_QUOTES, 'UTF-8'); ?></h3>
				<h3>Last Name: <?php echo htmlspecialchars($row['last_name'], ENT_QUOTES, 'UTF-8'); ?></h3>
				<h3>Email: <?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?></h3>
				<h3>Purpose: <?php echo htmlspecialchars($row['purpose'], ENT_QUOTES, 'UTF-8'); ?></h3>
				<h3>Date Added: <?php echo htmlspecialchars($row['date_added'], ENT_QUOTES, 'UTF-8'); ?></h3>

				<div class="editAndDelete" style="float: right; margin-right: 20px;">
					<a href="viewproject.php?customer_id=<?php echo htmlspecialchars($row['customer_id'], ENT_QUOTES, 'UTF-8'); ?>">View PC</a>
					<a href="editwebdeb.php?customer_id=<?php echo htmlspecialchars($row['customer_id'], ENT_QUOTES, 'UTF-8'); ?>">Edit</a>
					<a href="deletewebdev.php?customer_id=<?php echo htmlspecialchars($row['customer_id'], ENT_QUOTES, 'UTF-8'); ?>">Delete</a>
				</div>
			</div>
		<?php } ?>
	<?php } else { ?>
		<p>No users available. Add a new user above.</p>
	<?php } ?>
</body>
</html>
