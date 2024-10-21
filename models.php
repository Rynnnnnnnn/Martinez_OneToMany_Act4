<?php  

function insertCustomer($pdo, $first_name, $last_name, $email, $purpose) {

	$sql = "INSERT INTO customer (first_name, last_name, email, purpose) VALUES(?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $email, $purpose]);

	if ($executeQuery) {
		return true;
	}
}

function updateCustomer($pdo, $first_name, $last_name, $email, $purpose, $customer_id) {

	$sql = "UPDATE customer
				SET first_name = ?,
					last_name = ?,
					email = ?, 
					purpose = ?
				WHERE customer_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $email, $purpose, $customer_id]);
	
	if ($executeQuery) {
		return true;
	}

}

function deleteCustomer($pdo, $customer_id) {
	$deleteCustomerPC = "DELETE FROM virtual_pc WHERE customer_id = ?";
	$deleteStmt = $pdo->prepare($deleteCustomerPC);
	$executeDeleteQuery = $deleteStmt->execute([$customer_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM customer WHERE customer_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$customer_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}

function getAllCustomers($pdo) {
	$sql = "SELECT * FROM customer";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getCustomerByID($pdo, $customer_id) {
	$sql = "SELECT * FROM customer WHERE customer_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function getPCsByCustomer($pdo, $customer_id) {
	
	$sql = "SELECT 
				virtual_pc.pc_id AS pc_id,
				virtual_pc.pc_name AS pc_name,
				virtual_pc.pc_specs AS pc_specs,
				virtual_pc.date_added AS date_added,
				CONCAT(customer.first_name,' ',customer.last_name) AS pc_owner
			FROM virtual_pc
			JOIN customer ON virtual_pc.customer_id = customer.customer_id
			WHERE virtual_pc.customer_id = ? 
			GROUP BY virtual_pc.pc_name;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function insertPC($pdo, $pc_name, $pc_specs, $customer_id) {
	$sql = "INSERT INTO virtual_pc (pc_name, pc_specs, customer_id) VALUES (?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$pc_name, $pc_specs, $customer_id]);
	if ($executeQuery) {
		return true;
	}

}

function getPCByID($pdo, $pc_id) {
	$sql = "SELECT 
				virtual_pc.pc_id AS pc_id,
				virtual_pc.pc_name AS pc_name,
				virtual_pc.pc_specs AS pc_specs,
				virtual_pc.date_added AS date_added,
				CONCAT(customer.first_name,' ',customer.last_name) AS pc_owner
			FROM virtual_pc
			JOIN customer ON virtual_pc.customer_id = customer.customer_id
			WHERE virtual_pc.pc_id  = ? 
			GROUP BY virtual_pc.pc_name";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$pc_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updatePC($pdo, $pc_name, $pc_specs, $pc_id) {
	$sql = "UPDATE virtual_pc
			SET pc_name = ?,
				pc_specs = ?
			WHERE pc_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$pc_name, $pc_specs, $pc_id]);

	if ($executeQuery) {
		return true;
	}
}

function deletePC($pdo, $pc_id) {
	$sql = "DELETE FROM virtual_pc WHERE pc_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$pc_id]);
	if ($executeQuery) {
		return true;
	}
}

?>
