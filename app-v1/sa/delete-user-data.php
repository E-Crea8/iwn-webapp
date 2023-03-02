<?php
header('Content-type: application/json; charset=UTF-8');


$response = array();
 
if ($_POST['delete']) {
 
    require_once './../../inc/dbcon.php';
    // $getUser = $_GET['user'];
    

 
    $cId = intval($_POST['delete']);
    $deleteQuery = "DELETE FROM users WHERE user_id=$cId";
    $doDeleteQuery = mysqli_query($dbc, $deleteQuery);

    
    if ($doDeleteQuery == 1) {
        // $insertUserHistory = "INSERT INTO app_history (user_id, action) VALUES ('$getUserID', 'deleted a customer change order form')";
        // $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);
        $response['status']  = 'success';
 $response['message'] = 'User Deleted Successfully.';
    } else {
        $response['status']  = 'error';
 $response['message'] = 'Unable to Delete User Record.';
    }
    echo json_encode($response);
}