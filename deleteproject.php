<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

// Check if 'project_id' is set and is valid
if (!isset($_GET['project_id']) || !is_numeric($_GET['project_id'])) {
    echo "Invalid project ID.";
    exit;
}

$project_id = $_GET['project_id'];
$getProjectByID = getProjectByID($pdo, $project_id);

// Check if project exists
if (!$getProjectByID) {
    echo "Project not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Project</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this project?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>PC Name: <?php echo htmlspecialchars($getProjectByID['pc_name'], ENT_QUOTES, 'UTF-8'); ?></h2>
		<h2>PC Specs: <?php echo htmlspecialchars($getProjectByID['pc_specs'], ENT_QUOTES, 'UTF-8'); ?></h2>
		<h2>Pc Rented: <?php echo htmlspecialchars($getProjectByID['pc_rented'], ENT_QUOTES, 'UTF-8'); ?></h2>
		<h2>Date Added: <?php echo htmlspecialchars($getProjectByID['date_added'], ENT_QUOTES, 'UTF-8'); ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?project_id=<?php echo $project_id; ?>&web_dev_id=<?php echo htmlspecialchars($_GET['web_dev_id'], ENT_QUOTES, 'UTF-8'); ?>" method="POST">
				<input type="submit" name="deleteProjectBtn" value="Delete">
			</form>			
		</div>	
	</div>
</body>
</html>
