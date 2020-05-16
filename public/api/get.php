<?php
include "../db.php";
$results = array();

$stmt = $db->prepare('
    SELECT * FROM parts');
$stmt->execute(array());

$row_count = $stmt->rowCount();
$results['count'] = $row_count;
$results['success'] = false;

if ($row_count > 0) {
    $results['success'] = true;
    $results['parts'] = array();
    while($book = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($results['parts'], $book);
    }
}

header('Content-Type: application/json');
echo json_encode( $results );
?>
