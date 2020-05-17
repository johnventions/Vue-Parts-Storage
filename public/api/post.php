<?php
session_start();
include "../db.php";
$results = array();
if ($_POST == null) {
    $_POST = json_decode(file_get_contents("php://input"),true);
}
if ($_SESSION["signin"] == true || 1) {
    if (isset($_POST['_kp_part'])) {
        $results['success'] = true;
        // update existing
        $stmt = $db->prepare("
            UPDATE parts SET name = :name, location = :location WHERE _kp_part = :id");
        $stmt->execute(array(
            "name"=>$_POST['name'],
            "location"=>$_POST['location'],
            "id"=>$_POST['_kp_part']
        ));
    } else {
        // create new
        $stmt = $db->prepare("
            INSERT INTO parts (name, location, sublocation) VALUES (:name, :location, :sublocation)");
        $stmt->execute(array(
            "name"=>$_POST['name'],
            "location"=>$_POST['location'],
            "sublocation"=>$_POST['sublocation']
        ));
        $partID = $db->lastInsertId();
        $results['success'] = true;
        $results['_kp_part'] = $partID;
    }
    
} 
header('Content-Type: application/json');
echo json_encode( $results );
?>
