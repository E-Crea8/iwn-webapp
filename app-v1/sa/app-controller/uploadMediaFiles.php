<?php

//Database Connection
include ('./../../../inc/dbcon.php');

                if(isset($_POST['upload'])){
                    global $dbc;

                    $client_name = $_POST['client_name'];
                    $category = $_POST['category'];
                    // $file_name = $_POST['file_name'];
                    $id_session = $_POST['id_session'];
            
                    // Create Random Unique Id
                    $randomUID = md5(microtime(true).mt_Rand());
            
                    // Get username for user for the history table
                    $getNameQuery = "SELECT * FROM users WHERE user_id='$id_session'";
                    $doGetNameQuery = mysqli_query($dbc, $getNameQuery);
                
                    $row=mysqli_fetch_array($doGetNameQuery);
                    $getEmail = $row['email'];
            
                    // Get form id from site survey customer details table
                    $getFormIdQuery = "SELECT * FROM site_survey_customer_details WHERE client_name='$client_name'";
                    $doGetFormIdQuery = mysqli_query($dbc, $getFormIdQuery);
                
                    $row=mysqli_fetch_array($doGetFormIdQuery);
                    $getFormID = $row['form_id'];
            
                    // Generate date - Lagos time format
                    date_default_timezone_set("Africa/Lagos");
            
                    $date = date('M d, Y');
                    // $date = date('M d, Y', time());
            
            
                    // File upload configuration 
                    $targetDir = "../siteSurveyUploads/"; 
                    $allowTypes = array('jpg','png','jpeg','mp4');
            
                    $fileCount = count($_FILES['file']['name']);
                    for($i=0; $i<$fileCount; $i++){
                        $fileName = $_FILES['file']['name'][$i];
                        $InsertMediaUpload = "INSERT INTO site_survey_media_upload (client_name, category, file_name, form_id, date_submitted) 
                        VALUES ('$client_name', '$category', '$fileName', '$getFormID', '$date')";

                         // Insert into app history table
                        $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', 'Created a new equipment lease form form for $client_name')";

            
                    if ($doInsertMediaUpload = mysqli_query($dbc, $InsertMediaUpload) === TRUE){
                        echo '<script type="text/javascript">';
                        echo 'setTimeout(function () { swal.fire("Success!","'.$category.' Picture Uploaded Successfully. Click OK to Continue Form","success").then( () => {
                location.href = "site-survey-media-upload"});';
                        echo '}, 1000);
                        </script>';        
                    }else{
                        echo '<script type="text/javascript">';
                        echo 'setTimeout(function () { swal.fire("Error!","Media Upload Error","error").then( () => {
                location.href = "site-survey-media-upload"});';
                        echo '}, 1000);
                        </script>';        
                    }
                    $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $targetDir.$fileName);
            
                }
                           }
               ?>
