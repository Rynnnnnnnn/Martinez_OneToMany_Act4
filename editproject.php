<?php 
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

// Check if 'project_id' and 'web_dev_id' are set and valid
if (!isset($_GET['project_id']) || !is_numeric($_GET['project_id']) || !isset($_GET['web_dev_id']) || !is_numeric($_GET['web_dev_id'])) {
    echo "Invalid project or developer ID.";
    exit;
}

$project_id = $_GET['project_id'];
$web_dev_id = $_GET['web_dev_id'];

// Fetch the project by ID
$getProjectByID = getProjectByID($pdo, $project_id);

// Check if the project exists
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
	<title>Edit Project</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="viewprojects.php?web_dev_id=<?php echo htmlspecialchars($web_dev_id, ENT_QUOTES, 'UTF-8'); ?>">View The Projects</a>
	<h1>Edit the project!</h1>

	<form action="core/handleForms.php?project_id=<?php echo htmlspecialchars($project_id, ENT_QUOTES, 'UTF-8'); ?>&web_dev_id=<?php echo htmlspecialchars($web_dev_id, ENT_QUOTES, 'UTF-8'); ?>" method="POST">
		<p>
			<label for="projectName">Project Name</label> 
			<input type="text" name="projectName" 
			value="<?php echo htmlspecialchars($getProjectByID['pc_name'], ENT_QUOTES, 'UTF-8'); ?>" required>
		</p>
		<p>
			<label for="technologiesUsed">Technologies Used</label> 
			<input type="text" name="technologiesUsed" 
			value="<?php echo htmlspecialchars($getProjectByID['purpose'], ENT_QUOTES, 'UTF-8'); ?>" required>
		</p>
		<p>
			<input type="submit" name="editProjectBtn" value="Update Project">
		</p>
	</form>
</body>
</html>
