<?php
header('Content-type: application/json; charset=UTF-8');


$response = array();
 
if ($_POST['delete']) {
 
    require_once './../../inc/dbcon.php';
    // $getUser = $_GET['user'];
    

 
    $cId = intval($_POST['delete']);
    $deleteQuery = "DELETE FROM equipment_change_order_form WHERE id=$cId";
    $doDeleteQuery = mysqli_query($dbc, $deleteQuery);
    // $stmt->execute(array(':pid'=>$pid));

    // Get user performing action
    // $getUSer = "SELECT * FROM users WHERE user_id = $getUser";
    // $doGetUser = mysqli_query($dbc, $getUSer);
    // $row = mysqli_fetch_array($doGetUser);
    // $getUserID = $row['user_id'];


    
    if ($doDeleteQuery == 1) {
        // $insertUserHistory = "INSERT INTO app_history (user_id, action) VALUES ('$getUserID', 'deleted a customer change order form')";
        // $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);
        $response['status']  = 'success';
 $response['message'] = 'Equipment Change Order Form Deleted Successfully.';
    } else {
        $response['status']  = 'error';
 $response['message'] = 'Unable to Delete Equipment Change Order Form.';
    }
    echo json_encode($response);
}