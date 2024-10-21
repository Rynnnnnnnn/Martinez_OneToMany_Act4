<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertCustomerBtn'])) {
	if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['purpose'])) {
		$query = insertCustomer($pdo, $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['purpose']);

		if ($query) {
			header("Location: ../index.php");
		} else {
			echo "Insertion failed";
		}
	} else {
		echo "All fields are required.";
	}
}

if (isset($_POST['editCustomerBtn'])) {
	if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['purpose'])) {
		$query = updateCustomer($pdo, $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['purpose'], $_GET['customer_id']);

		if ($query) {
			header("Location: ../index.php");
		} else {
			echo "Edit failed";
		}
	} else {
		echo "All fields are required.";
	}
}

if (isset($_POST['deleteCustomerBtn'])) {
	$query = deleteCustomer($pdo, $_GET['customer_id']);

	if ($query) {
		header("Location: ../index.php");
	} else {
		echo "Deletion failed";
	}
}

if (isset($_POST['insertNewPCBtn'])) {
	if (!empty($_POST['pcName']) && !empty($_POST['pcSpecs'])) {
		$query = insertPC($pdo, $_POST['pcName'], $_POST['pcSpecs'], $_GET['customer_id']);

		if ($query) {
			header("Location: ../viewpcs.php?customer_id=" . $_GET['customer_id']);
		} else {
			echo "Insertion failed";
		}
	} else {
		echo "All fields are required.";
	}
}

if (isset($_POST['editPCBtn'])) {
	if (!empty($_POST['pcName']) && !empty($_POST['pcSpecs'])) {
		$query = updatePC($pdo, $_POST['pcName'], $_POST['pcSpecs'], $_GET['pc_id']);

		if ($query) {
			header("Location: ../viewpcs.php?customer_id=" . $_GET['customer_id']);
		} else {
			echo "Update failed";
		}
	} else {
		echo "All fields are required.";
	}
}

if (isset($_POST['deletePCBtn'])) {
	$query = deletePC($pdo, $_GET['pc_id']);

	if ($query) {
		header("Location: ../viewpcs.php?customer_id=" . $_GET['customer_id']);
	} else {
		echo "Deletion failed";
	}
}

?>
