<?php
// Record is not deleting
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);
$student_id = $data['sid'];

include "connect.php";

$sql = "DELETE FROM student WHERE id={$student_id}";

if(mysqli_query($conn, $sql)) {
    echo json_encode(array('message' => 'Record deleted', 'status' => true));
} else {
    echo json_encode(array('message' => 'No record deleted', 'status' => false));
}

mysqli_close($conn);
?>
