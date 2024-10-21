<?php  

function insertWebDev($pdo, $first_name, $last_name, $email, $purpose) {
    try {
        $sql = "INSERT INTO customer (first_name, last_name, email, purpose) VALUES(?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$first_name, $last_name, $email, $purpose]);

        if ($executeQuery) {
            return true;
        }
    } catch (PDOException $e) {
        echo "Error inserting web developer: " . $e->getMessage();
        return false;
    }
}

function updateWebDev($pdo, $first_name, $last_name, $email, $purpose, $customer_id) {
    try {
        $sql = "UPDATE customer
                    SET first_name = ?,
                        last_name = ?,
                        email = ?, 
                        purpose = ?
                    WHERE customer_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$first_name, $last_name, $email, $purpose, $customer_id]);

        if ($executeQuery) {
            return true;
        }
    } catch (PDOException $e) {
        echo "Error updating web developer: " . $e->getMessage();
        return false;
    }
}

function deleteWebDev($pdo, $customer_id) {
    try {
        // First, delete associated projects from virtual_pc table
        $deleteWebDevProj = "DELETE FROM virtual_pc WHERE customer_id = ?";
        $deleteStmt = $pdo->prepare($deleteWebDevProj);
        $executeDeleteQuery = $deleteStmt->execute([$customer_id]);

        if ($executeDeleteQuery) {
            // Then, delete from customer table
            $sql = "DELETE FROM customer WHERE customer_id = ?";
            $stmt = $pdo->prepare($sql);
            $executeQuery = $stmt->execute([$customer_id]);

            if ($executeQuery) {
                return true;
            }
        }
    } catch (PDOException $e) {
        echo "Error deleting web developer: " . $e->getMessage();
        return false;
    }
}

function getAllInfoByWebDevID($pdo, $customer_id) {
    try {
        $sql = "SELECT * FROM customer WHERE customer_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$customer_id]);
        return $stmt->fetch(); // Fetch a single record
    } catch (PDOException $e) {
        echo "Error fetching web developer info: " . $e->getMessage();
        return false;
    }
}

function getAllWebDevs($pdo) {
    try {
        $sql = "SELECT * FROM customer";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute();

        if ($executeQuery) {
            return $stmt->fetchAll();
        }
    } catch (PDOException $e) {
        echo "Error fetching web developers: " . $e->getMessage();
        return false;
    }
}

function getWebDevByID($pdo, $customer_id) {
    try {
        $sql = "SELECT * FROM customer WHERE customer_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$customer_id]);

        if ($executeQuery) {
            return $stmt->fetch();
        }
    } catch (PDOException $e) {
        echo "Error fetching web developer by ID: " . $e->getMessage();
        return false;
    }
}

function getProjectsByWebDev($pdo, $customer_id) {
    try {
        $sql = "SELECT 
                    virtual_pc.pc_id, 
                    virtual_pc.pc_name, 
                    virtual_pc.pc_specs, 
                    CONCAT(customer.first_name, ' ', customer.last_name) AS pc_rented, 
                    virtual_pc.date_added  -- Explicitly specify the table for date_added
                FROM virtual_pc 
                JOIN customer ON virtual_pc.customer_id = customer.customer_id 
                WHERE virtual_pc.customer_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$customer_id]);
        return $stmt->fetchAll(); // Fetch all related projects
    } catch (PDOException $e) {
        echo "Error fetching projects by web developer: " . $e->getMessage();
        return false;
    }
}

function insertProject($pdo, $pc_name, $customer_id) {
    try {
        $sql = "INSERT INTO virtual_pc (pc_name, customer_id) VALUES (?,?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$pc_name, $customer_id]);

        if ($executeQuery) {
            return true;
        }
    } catch (PDOException $e) {
        echo "Error inserting project: " . $e->getMessage();
        return false;
    }
}

function getProjectByID($pdo, $pc_id) {
    try {
        $sql = "SELECT 
                    virtual_pc.pc_id AS pc_id,
                    virtual_pc.pc_name AS pc_name,
                    virtual_pc.purpose AS purpose,
                    virtual_pc.date_added AS date_added,
                    CONCAT(customer.first_name,' ',customer.last_name) AS pc_rented
                FROM virtual_pc
                JOIN customer ON virtual_pc.customer_id = customer.customer_id
                WHERE virtual_pc.pc_id  = ? 
                GROUP BY virtual_pc.pc_name";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$pc_id]);

        if ($executeQuery) {
            return $stmt->fetch();
        }
    } catch (PDOException $e) {
        echo "Error fetching project by ID: " . $e->getMessage();
        return false;
    }
}

function updateProject($pdo, $pc_name, $purpose, $pc_id) {
    try {
        $sql = "UPDATE virtual_pc
                SET pc_name = ?,
                    purpose = ?
                WHERE pc_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$pc_name, $purpose, $pc_id]);

        if ($executeQuery) {
            return true;
        }
    } catch (PDOException $e) {
        echo "Error updating project: " . $e->getMessage();
        return false;
    }
}

function deleteProject($pdo, $pc_id) {
    try {
        $sql = "DELETE FROM virtual_pc WHERE pc_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$pc_id]);

        if ($executeQuery) {
            return true;
        }
    } catch (PDOException $e) {
        echo "Error deleting project: " . $e->getMessage();
        return false;
    }
}

?>
