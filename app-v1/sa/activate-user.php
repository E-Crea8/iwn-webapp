<?php
require('./../../session.php');
include_once("./../../inc/dbcon.php");

// Get User ID Session
$id_session = $_SESSION['user_id'];

// Get username of user for user history table
$getNameQuery = "SELECT * FROM users WHERE user_id='$id_session'";
$doGetNameQuery = mysqli_query($dbc, $getNameQuery);

$row = mysqli_fetch_array($doGetNameQuery);
$getUserID = $row['user_id'];
$getFirstName = $row['firstname'];
$getUserEmail = $row['email'];

// SELECT USERS DETAIL FROM USERS LOGIN TABLE FOR RECORD HISTORY
$getUserQuery = "SELECT * FROM users WHERE user_id='".$_REQUEST['userID']."'";
$doGetUserQuery = mysqli_query($dbc, $getUserQuery);
$rows = mysqli_fetch_array($doGetUserQuery);
$getUserFName = $rows['firstname'];
$getUserLName = $rows['lastname'];


// Insert into app history table
$insertUserActionHistory = "INSERT INTO app_history (email, action) VALUES ( '$getUserEmail', 'Activated User - $getUserFName $getUserLName')";
$doInsertUserHistory = mysqli_query($dbc, $insertUserActionHistory);

if($_REQUEST['userID']) {
$sql = "UPDATE users SET active_status = '1' WHERE user_id='".$_REQUEST['userID']."'";
$activateUser = mysqli_query($dbc, $sql) or die("database error:". mysqli_error($dbc));


if($activateUser) {
echo "User has been Activated Successfully!";
}
}
?>