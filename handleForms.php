<?php 
require_once 'dbConfig.php'; 
require_once 'models.php';

// Inserting a new web developer
if (isset($_POST['insertWebDevBtn'])) {
    $query = insertWebDev($pdo, $_POST['firstName'], 
        $_POST['lastName'], $_POST['email'], $_POST['purpose']);

    if ($query) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Insertion failed";
    }
}

// Editing an existing web developer
if (isset($_POST['editWebDevBtn'])) {
    $query = updateWebDev($pdo, $_POST['firstName'], $_POST['lastName'], 
        $_POST['email'], $_POST['purpose'], $_GET['customer_id']);

    if ($query) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Edit failed";
    }
}

// Deleting a web developer
if (isset($_POST['deleteWebDevBtn'])) {
    $query = deleteWebDev($pdo, $_GET['customer_id']);

    if ($query) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Deletion failed";
    }
}

if (isset($_POST['insertNewProjectBtn'])) {
    $customerId = $_GET['customer_id'];
    $projectName = $_POST['projectName'];
    $technologiesUsed = $_POST['technologiesUsed'];

    // Insert project
    $query = insertProject($pdo, $projectName, $technologiesUsed, $customerId);

    if ($query) {
        echo "Project inserted successfully!";
        header("Location: ../viewproject.php?customer_id=" . urlencode($customerId));
        exit;
    } else {
        echo "Project insertion failed!";
    }
}


// Editing an existing project
if (isset($_POST['editProjectBtn'])) {
    if (isset($_GET['project_id']) && isset($_GET['customer_id'])) { // Check if both IDs are set
        $query = updateProject($pdo, $_POST['projectName'], $_POST['technologiesUsed'], $_GET['project_id']);

        if ($query) {
            header("Location: ../viewproject.php?customer_id=" . urlencode($_GET['customer_id']));
            exit;
        } else {
            echo "Update failed";
        }
    } else {
        echo "Project ID or Customer ID is missing!";
    }
}

// Deleting a project
if (isset($_POST['deleteProjectBtn'])) {
    if (isset($_GET['project_id']) && isset($_GET['customer_id'])) { // Check if both IDs are set
        $query = deleteProject($pdo, $_GET['project_id']);

        if ($query) {
            header("Location: ../viewproject.php?customer_id=" . urlencode($_GET['customer_id']));
            exit;
        } else {
            echo "Deletion failed";
        }
    } else {
        echo "Project ID or Customer ID is missing!";
    }
}
?>
