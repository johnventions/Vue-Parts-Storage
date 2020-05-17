<?php
session_start();
include "../db.php";
$results = array();
if ($_POST == null) {
    $_POST = json_decode(file_get_contents("php://input"),true);
}
if ($_SESSION["signin"] == true || 1) {
    if ( isset($_POST['_kp_part']) ) {
        $stmt = $db->prepare("
            DELETE FROM parts WHERE _kp_part = :id");
        $stmt->execute(array(
            "id"=>$_POST['_kp_part'],
        ));
        $results['success'] = true;
    } else {
        $results['success'] = false;
        $results['error'] = "Missing part id";
    }
}

header('Content-Type: application/json');
echo json_encode( $results );
?>
