<?php 

function insertCustomer($pdo, $first_name, $last_name,$email, $purpose) {

    $sql = "INSERT INTO customer_records (first_name, last_name, email, purpose) VALUES (?,?,?,?)";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute ([$first_name, $last_name, $email, $purpose]);

    if($executeQuery) {

    }
}

function getAllCustomer_records($pdo) {
    $sql ="SELECT * FROM customer";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_id]);

    if($executeQuery) {
    return true;

  }
 }
 function getAllCustomerByID($pdo, $cutomer_id) {
    $sql = "SELECT * FROM  customer WHERE customer_id =  ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$cutomer_id]);

    if($executeQuery) {
        return $stmt->fetch();
 }
}

?>