<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Welcome To Virtual PC Rental Management System. Add new Customers!</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="firstName" required>
		</p>
		<p>
			<label for="lastName">Last Name</label> 
			<input type="text" name="lastName" required>
		</p>
		<p>
			<label for="email">Email</label> 
			<input type="email" name="email" required>
		</p>
		<p>
			<label for="purpose">Purpose</label> 
			<input type="text" name="purpose" required>
			<input type="submit" name="insertCustomerBtn">
		</p>
	</form>
	<?php $getAllCustomers = getAllCustomers($pdo); ?>
	<?php foreach ($getAllCustomers as $row) { ?>
	<div class="container" style="border-style: solid; width: 50%; height: 300px; margin-top: 20px;">
		<h3>First Name: <?php echo $row['first_name']; ?></h3>
		<h3>Last Name: <?php echo $row['last_name']; ?></h3>
		<h3>Email: <?php echo $row['email']; ?></h3>
		<h3>Purpose: <?php echo $row['purpose']; ?></h3>
		<h3>Date Added: <?php echo $row['date_added']; ?></h3>

		<div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="viewpcs.php?customer_id=<?php echo $row['customer_id']; ?>">View PCs</a>
			<a href="editcustomer.php?customer_id=<?php echo $row['customer_id']; ?>">Edit</a>
			<a href="deletecustomer.php?customer_id=<?php echo $row['customer_id']; ?>">Delete</a>
		</div>
	</div> 
	<?php } ?>
</body>
</html>
