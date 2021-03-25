<?php
//Start Session Here
require('./../../session.php');
confirm_logged_in();

$id_session = $_SESSION['user_id'];

//Database Connection
include ('./../../inc/dbcon.php');

//Create function to fetch username
function getUserName($id_session){
    global $dbc;
    
    $getNameQuery = "SELECT * FROM users WHERE user_id='$id_session'";
    $doGetNameQuery = mysqli_query($dbc, $getNameQuery);

    $row=mysqli_fetch_array($doGetNameQuery);
    $getFirstName = $row['firstname'];

    echo $getFirstName;

}

//Create function to fetch user position
function getUserPosition($id_session){
    global $dbc;
    
    $getPositionQuery = "SELECT * FROM users WHERE user_id='$id_session'";
    $doGetPositionQuery = mysqli_query($dbc, $getPositionQuery);

    $row=mysqli_fetch_array($doGetPositionQuery);
    $getPosition = $row['position'];

    echo $getPosition;

}


//Create Function to Generate User Email
function getUserEmail($id_session){
    global $dbc;
    $getEmailQuery = "SELECT * FROM users WHERE user_id='$id_session'";
    $doGetEmailQuery = mysqli_query($dbc, $getEmailQuery);

    $row = mysqli_fetch_array($doGetEmailQuery);
    $getEmail = $row['email'];

    echo $getEmail;
}

//create function to count number of users in the users table
function noOfUsers(){
    global $dbc;
    $getNoOfUsers = "SELECT COUNT(*) FROM users";
    $doGetNoOfUsers = mysqli_query($dbc, $getNoOfUsers);

    $row = mysqli_fetch_array($doGetNoOfUsers);

    echo "$row[0]";

}

//create function to count number of internet service order form 
function noOfInternetServiceOrderForm(){
    global $dbc;
    $getNoOfInternetServiceOrderForm = "SELECT COUNT(*) FROM internet_service_order_form";
    $doGetNoOfInternetServiceOrderForm = mysqli_query($dbc, $getNoOfInternetServiceOrderForm);

    $row = mysqli_fetch_array($doGetNoOfInternetServiceOrderForm);

    echo "$row[0]";

}


//create function to count number of site survey form 
function noOfSiteSurveyForm(){
    global $dbc;
    $getNoOfSiteSurveyForm = "SELECT COUNT(*) FROM site_survey_customer_details";
    $doGetNoOfSiteSurveyForm = mysqli_query($dbc, $getNoOfSiteSurveyForm);

    $row = mysqli_fetch_array($doGetNoOfSiteSurveyForm);

    echo "$row[0]";

}


//create function to count number of internet service change order form
function noOfChangeOrderForm(){
    global $dbc;
    $getNoOfChangeOrderForm = "SELECT COUNT(*) FROM change_internet_service_order_form";
    $doGetNoOfChangeOrderForm = mysqli_query($dbc, $getNoOfChangeOrderForm);

    $row = mysqli_fetch_array($doGetNoOfChangeOrderForm);

    echo "$row[0]";

}



//create function to count number of lease form
function noOfLeaseForm(){
    global $dbc;
    $getNoOfSignedUpClients = "SELECT COUNT(*) FROM internet_service_order_form";
    $doGetNoOfSignedUpClients = mysqli_query($dbc, $getNoOfSignedUpClients);

    $row = mysqli_fetch_array($doGetNoOfSignedUpClients);

    echo "$row[0]";

}


////////////// SITE SURVEY FORMS FUNCTIONS HERE//////////////////////////////////////////////////////////////////////////////////////////
// Function to create site survey customer details
function createSiteSurveyCustomerDetails(){
    global $dbc;

    $client_name = $_POST['client_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $coordinate = $_POST['coordinate'];
    $cable_length = $_POST['cable_length'];
    $other_info = $_POST['other_info'];
    $earth_test_info = $_POST['earth_test_info'];
    $conducted_by = $_POST['conducted_by'];
    $id_session = $_POST['id_session'];

        // Create Random Unique Id
        $randomUID = md5(microtime(true).mt_Rand());

        // Get username for user for the history table
        $getNameQuery = "SELECT * FROM users WHERE user_id='$id_session'";
        $doGetNameQuery = mysqli_query($dbc, $getNameQuery);
    
        $row=mysqli_fetch_array($doGetNameQuery);
        $getEmail = $row['email'];

        // Generate date - Lagos time format
        date_default_timezone_set("Africa/Lagos");

        $date = date('M d, Y');
        // $date = date('M d, Y', time());
        
        //Create customer upload folder here
        $dir = "./../siteSurveyUploads/$client_name";
        
        //Remove space from folder name and replace with an underscore
        $renameFolder =  str_replace(" ","_",$dir);

        

            // Insert into app history table
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', 'Created a new site survey form for $client_name')";

            $insertSiteSurveyCustomerDetails = "INSERT INTO site_survey_customer_details (client_name, address, phone, coordinate, cable_length, other_info, earth_test_info, conducted_by, form_id, date_submitted) 
            VALUES ('$client_name', '$address', '$phone', '$coordinate', '$cable_length', '$other_info', '$earth_test_info', '$conducted_by', '$randomUID', '$date')";
            $doSiteSurveyCustomerDetails = mysqli_query($dbc, $insertSiteSurveyCustomerDetails);
            $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);
            
            // create directory if not exists in upload/ directory
             if(!is_dir($renameFolder)){
               mkdir($renameFolder, 0755);
             }


            // echo '<script type="text/javascript">';
            // echo 'setTimeout(function () { swal.fire("Success!"," Site Survey Form Created Successfully For '.$client_name.'.","success");';
            // echo '}, 1000);</script>';

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!"," Site Survey Form Created Successfully For '.$client_name.'. Click OK to upload survey pictures","success").then( () => {
    location.href = "site-survey-media-upload"});';
            echo '}, 1000);
            </script>';

            // echo json_encode($doInsertCategoryName);


        }


// Function to create site survey customer details
function createSiteSurveyMediaUpload(){
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
    
    //select customer name here
    $dirName = "$client_name";
    
    //Remove space from client name and replace with an underscore
    $renameDirName =  str_replace(" ","_",$dirName);


    // File upload configuration 
    $targetDir = "./../siteSurveyUploads/$renameDirName/"; 
    $allowTypes = array('jpg','png','jpeg','mp4');

    $fileCount = count($_FILES['file']['name']);
    for($i=0; $i<$fileCount; $i++){
        $fileName = $_FILES['file']['name'][$i];
        $insertMediaUpload = "INSERT INTO site_survey_media_upload (client_name, category, file_name, form_id, date_submitted) 
        VALUES ('$client_name', '$category', '$fileName', '$getFormID', '$date')";

         // Insert into app history table
        $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', 'Created a new site survey form for $client_name')";


    if ($doInsertMediaUpload = mysqli_query($dbc, $insertMediaUpload) === TRUE){
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal.fire("Success!","'.$category.' uploaded successfully for '.$client_name.'. Click OK to continue upload","success").then( () => {
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


// Function to manage site survey record
function manageSiteSurveyForm(){
    global $dbc;
    $selectSiteSurveyData = "SELECT * FROM site_survey_customer_details ORDER BY id DESC";
    $doSelectSiteSurveyData = mysqli_query($dbc, $selectSiteSurveyData);
    $checkIfNotEmpty = mysqli_num_rows($doSelectSiteSurveyData);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
        <table id="siteSurveyFormData" class="table table-striped">
        <thead style="font-size:12px;">
            <tr>
                <th>SN</th>
                <th>Client Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Report Link</th>
                <th>Date Created</th>
                <th style="width: 20%;">Action</th>
            </tr>
        </thead>
        <tfoot style="font-size:12px;">
            <tr>
            <th>SN</th>
            <th>Client Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Report Link</th>
            <th>Date Created</th>
            <th style="width: 20%;">Action</th>
</tr>
        </tfoot>
        ';
        while($row = mysqli_fetch_array($doSelectSiteSurveyData))
        
        {
            $sn++;
            $sLId = $row["id"];
            $clientName = $row["client_name"];
            $formRef = $row["form_id"];

            // Create Random Unique Id
            $randomUID = md5(microtime(true).mt_Rand());

            echo '
            <tr style="font-size:12px;">
            <td> '.$sn.' </td>
            <td> '.$row["client_name"].' </td>
            <td> '.$row["address"].' </td>
            <td> '.$row["phone"].' </td>
            <td> https://app.iwn.ng/view-site-survey-details?form_id='.$row["id"].'&form_ref='.$row["form_id"].' </td>
            <td> '.$row["date_submitted"].' </td>
            <td> 
            <a href="view-site-survey-details?form_id='.$row["id"].'&form_ref='.$row["form_id"].'" target=_blank class="btn btn-sm btn-primary" ><i class="ion-ios-eye"></i></a>
            <a href="edit-site-survey-form?id='.$row["id"].'" class="btn btn-sm btn-info" ><i class="ion-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="delete-site-survey-form" data-id="'.$sLId.'"><i class="ion-trash-a"></i></a>
            </td>
            </tr>
            
            
            ';
            

        }
        

    
        echo '</table>';
        

    }else{
        echo '
        <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>&times;</span>
          </button>
        No Record Data to show!
        </div>
        </div>
        ';

    }


}


// Function to display uploaded site survey media
function siteSurveyForm($form_ref){
    global $dbc;

    // Select customer details first
    $selectSiteSurveyCustomerRecord = "SELECT * FROM site_survey_customer_details WHERE form_id = '$form_ref'";
    $doSelectSiteSurveyCustomerRecord = mysqli_query($dbc, $selectSiteSurveyCustomerRecord);
    $checkIfNotEmpty1 = mysqli_num_rows($doSelectSiteSurveyCustomerRecord);

    // Select media uploads
    $selectSiteSurveyMediaUploadRecord = "SELECT * FROM site_survey_media_upload WHERE form_id = '$form_ref'";
    $doSelectSiteSurveyMediaUploadRecord = mysqli_query($dbc, $selectSiteSurveyMediaUploadRecord);
    $checkIfNotEmpty2 = mysqli_num_rows($doSelectSiteSurveyMediaUploadRecord);

    // Select pictures of Highest Height
    $selectPicturesOfHighestHeight ="SELECT file_name FROM site_survey_media_upload WHERE category = 'Pictures of highest height' AND form_id = '$form_ref'";
    $doSelectPicturesOfHighestHeight = mysqli_query($dbc, $selectPicturesOfHighestHeight);


    // Select pictures showing cable route
    $selectPicturesShowingCablingRoute ="SELECT file_name FROM site_survey_media_upload WHERE category = 'Pictures showing cabling route' AND form_id = '$form_ref'";
    $doSelectPicturesShowingCablingRoute = mysqli_query($dbc, $selectPicturesShowingCablingRoute);
    $checkIfNotEmpty4 = mysqli_num_rows($doSelectPicturesShowingCablingRoute);


    // Select pictures showing link termination point
    $selectPicturesOfLinkTerminationPoint ="SELECT file_name FROM site_survey_media_upload WHERE category = 'Pictures of the link termination point' AND form_id = '$form_ref'";
    $doSelectPicturesOfLinkTerminationPoint = mysqli_query($dbc, $selectPicturesOfLinkTerminationPoint);
    $checkIfNotEmpty5 = mysqli_num_rows($doSelectPicturesOfLinkTerminationPoint);

    
    // Select pictures showing line of sight
    $selectPicturesOfLOS ="SELECT file_name FROM site_survey_media_upload WHERE category = 'Pictures of the LOS (line of sight) while standing on the highest point' AND form_id = '$form_ref'";
    $doSelectPicturesOfLOS = mysqli_query($dbc, $selectPicturesOfLOS);
    $checkIfNotEmpty6 = mysqli_num_rows($doSelectPicturesOfLOS);

    
    // Select pictures or video of the entire building from a distance
    $selectPicturesOfEntireBuilding ="SELECT file_name FROM site_survey_media_upload WHERE category = 'Pictures or video of the entire building from a distance' AND form_id = '$form_ref'";
    $doSelectPicturesOfEntireBuilding = mysqli_query($dbc, $selectPicturesOfEntireBuilding);
    $checkIfNotEmpty7 = mysqli_num_rows($doSelectPicturesOfEntireBuilding);

    
    // Select pictures showing router positioning point
    $selectPicturesOfRouterPositioning ="SELECT file_name FROM site_survey_media_upload WHERE category = 'Pictures showing router positioning point' AND form_id = '$form_ref'";
    $doSelectPicturesOfRouterPositioning = mysqli_query($dbc, $selectPicturesOfRouterPositioning);
    $checkIfNotEmpty8 = mysqli_num_rows($doSelectPicturesOfRouterPositioning);
    


    $sn = 0;

    if($checkIfNotEmpty1 > 0 && $checkIfNotEmpty2 > 0){
        echo '
      <div class="container mt-0" id="equipmentLeaseForm">
        ';
        while($row1 = mysqli_fetch_array($doSelectSiteSurveyCustomerRecord)) {
            $sn++;
            $sId = $row1["id"];
            $clientName = $row1["client_name"];
            
        //select customer name here
        $dirName = "$clientName";
        
        //Remove space from client name and replace with an underscore
        $renameDirName =  str_replace(" ","_",$dirName);

            echo '
            <div class="row" style=margin-bottom: 10px;">
            <table style="width: 100%;">
                <tr style="height: 80px; text-align: right; color: #FFFFFF; font-family: Georgia, Times New Roman, Times, serif; font-size: 11px; font-weight: 300;">
                    <td> <img src="./../dist/img/IP-Order-Form-I-World-Networks-Logo.fw.png" alt="I-World Networks Logo"></td>
                </tr>
            </table>
        </div>


        <div class="row">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 50px; text-align: center; padding: 40px 0px 20px 0px; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 700;">
                    <td> <h4>SITE SURVEY DETAILS</h4></td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 5px; margin-bottom: -10px;">
            <table class="" style="width: 100%;">
                <tr style="height: 50px; text-align: left; background-color: #F58634; color: #FFFFFF !important;">
                    <td class="formField" style="font-size: 16px;"> <strong>CUSTOMER PRIMARY DETAILS</strong></td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 10px;">
            <table class="table-bordered" style="width: 100%;">
            <tr style="height: 30px; text-align: left;">
            <td class="formField"> Client/Customer Name: '.$row1["client_name"].'</td>
        </tr>

                <tr style="height: 30px; text-align: left;">
                    <td class="formField"> Address: '.$row1["address"].'</td>
                </tr>

                <tr style="height: 30px; text-align: left;">
                    <td class="formField"> Phone: '.$row1["phone"].'</td>
                </tr>

                <tr style="height: 30px; text-align: left;">
                    <td class="formField"> Accurate GPS Coordinate of the Site: '.$row1["coordinate"].'</td>
                </tr>

                <tr style="height: 30px; text-align: left;">
                    <td class="formField"> Cable Length: '.$row1["cable_length"].'</td>
                </tr>

                <tr style="height: 30px; text-align: left;">
                    <td class="formField"> Earthing Test Information: '.$row1["earth_test_info"].'</td>
                </tr>

                <tr style="height: 30px; text-align: left;">
                    <td class="formField"> Other Information: '.$row1["other_info"].'</td>
                </tr>

                <tr style="height: 30px; text-align: left;">
                    <td class="formField"> Site Survey Conducted By: '.$row1["conducted_by"].'</td>
                </tr>
                
                </table>
        </div>
        
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
        <table class="" style="width: 100%;">
            <tr style="height: 50px; text-align: left; background-color: #F58634; color: #FFFFFF;">
                <td class="formField" style="font-size: 16px; text-transform: uppercase;"> <strong>Pictures of the highest height on site</strong></td>
            </tr>
        </table>
    </div>        
    ';
    }



while($row3 = mysqli_fetch_array($doSelectPicturesOfHighestHeight))
        
    {


        echo '
        <a href="./../siteSurveyUploads/'.$renameDirName.'/'.$row3['file_name'].'" data-toggle="lightbox" data-gallery="example-gallery">
            <img src = "./../siteSurveyUploads/'.$renameDirName.'/'.$row3['file_name'].'" style="width: 350px; height: 350px; border: 1px solid #ededed;" class="img-fluid">
            
        </a>
        ';
        }
    
        echo '
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
        <table class="" style="width: 100%;">
            <tr style="height: 50px; text-align: left; background-color: #F58634; color: #FFFFFF;">
                <td class="formField" style="font-size: 16px; text-transform: uppercase;"> <strong>Pictures showing cabling route</strong></td>
            </tr>
        </table>
    </div>        
    ';
    
    if($checkIfNotEmpty4 > 0){
        
            while($row4 = mysqli_fetch_array($doSelectPicturesShowingCablingRoute))
            
        {
    
    
        echo '
        <a href="./../siteSurveyUploads/'.$renameDirName.'/'.$row4['file_name'].'" data-toggle="lightbox" data-gallery="example-gallery">
            <img src = "./../siteSurveyUploads/'.$renameDirName.'/'.$row4['file_name'].'" style="width: 350px; height: 350px; border: 1px solid #ededed;" class="img-fluid">
            
        </a>
        ';
        }
    
}else{
    echo '
    <div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>&times;</span>
      </button>
    No pictures showing cabling route uploaded!
    </div>
    </div>
    ';

}


echo '
<div class="row" style="margin-top: 10px; margin-bottom: 10px;">
<table class="" style="width: 100%;">
    <tr style="height: 50px; text-align: left; background-color: #F58634; color: #FFFFFF;">
        <td class="formField" style="font-size: 16px; text-transform: uppercase;"> <strong>Pictures of the link termination point and also indicating if conduit pipe or trunk will be used</strong></td>
    </tr>
</table>
</div>        
';

if($checkIfNotEmpty5 > 0){

    while($row5 = mysqli_fetch_array($doSelectPicturesOfLinkTerminationPoint))
    
{


echo '
<a href="./../siteSurveyUploads/'.$renameDirName.'/'.$row5['file_name'].'" data-toggle="lightbox" data-gallery="example-gallery">
    <img src = "./../siteSurveyUploads/'.$renameDirName.'/'.$row5['file_name'].'" style="width: 350px; height: 350px; border: 1px solid #ededed;" class="img-fluid">
    
</a>
';
}

}else{
echo '
<div class="alert alert-danger alert-dismissible show fade">
<div class="alert-body">
<button class="close" data-dismiss="alert">
<span>&times;</span>
</button>
No pictures of the link termination point uploaded!
</div>
</div>
';

}


echo '
<div class="row" style="margin-top: 10px; margin-bottom: 10px;">
<table class="" style="width: 100%;">
    <tr style="height: 50px; text-align: left; background-color: #F58634; color: #FFFFFF;">
        <td class="formField" style="font-size: 16px; text-transform: uppercase;"> <strong>Pictures of the LOS (line of sight) while standing on the highest point</strong></td>
    </tr>
</table>
</div>        
';

if($checkIfNotEmpty6 > 0){

    while($row6 = mysqli_fetch_array($doSelectPicturesOfLOS))
    
{


echo '
<a href="./../siteSurveyUploads/'.$renameDirName.'/'.$row6['file_name'].'" data-toggle="lightbox" data-gallery="example-gallery">
    <img src = "./../siteSurveyUploads/'.$renameDirName.'/'.$row6['file_name'].'" style="width: 350px; height: 350px; border: 1px solid #ededed;" class="img-fluid">
    
</a>
';
}

}else{
echo '
<div class="alert alert-danger alert-dismissible show fade">
<div class="alert-body">
<button class="close" data-dismiss="alert">
<span>&times;</span>
</button>
No pictures of the LOS (line of sight) while standing on the highest point uploaded!
</div>
</div>
';

}


echo '
<div class="row" style="margin-top: 10px; margin-bottom: 10px;">
<table class="" style="width: 100%;">
    <tr style="height: 50px; text-align: left; background-color: #F58634; color: #FFFFFF;">
        <td class="formField" style="font-size: 16px; text-transform: uppercase;"> <strong>Pictures or video of the entire building from a distance</strong></td>
    </tr>
</table>
</div>        
';

if($checkIfNotEmpty7 > 0){

    while($row7 = mysqli_fetch_array($doSelectPicturesOfEntireBuilding))
    
{


echo '
<a href="./../siteSurveyUploads/'.$renameDirName.'/'.$row7['file_name'].'" data-toggle="lightbox" data-gallery="example-gallery">
    <img src = "./../siteSurveyUploads/'.$renameDirName.'/'.$row7['file_name'].'" style="width: 350px; height: 350px; border: 1px solid #ededed;" class="img-fluid">
    
</a>
';
}

}else{
echo '
<div class="alert alert-danger alert-dismissible show fade">
<div class="alert-body">
<button class="close" data-dismiss="alert">
<span>&times;</span>
</button>
No pictures or video of the entire building from a distance uploaded!
</div>
</div>
';

}


echo '
<div class="row" style="margin-top: 10px; margin-bottom: 10px;">
<table class="" style="width: 100%;">
    <tr style="height: 50px; text-align: left; background-color: #F58634; color: #FFFFFF;">
        <td class="formField" style="font-size: 16px; text-transform: uppercase;"> <strong>Pictures showing router positioning point</strong></td>
    </tr>
</table>
</div>        
';

if($checkIfNotEmpty8 > 0){

    while($row8 = mysqli_fetch_array($doSelectPicturesOfRouterPositioning))
    
{


echo '
<a href="./../siteSurveyUploads/'.$renameDirName.'/'.$row8['file_name'].'" data-toggle="lightbox" data-gallery="example-gallery">
    <img src = "./../siteSurveyUploads/'.$renameDirName.'/'.$row8['file_name'].'" style="width: 350px; height: 350px; border: 1px solid #ededed;" class="img-fluid">
    
</a>
';


}

}else{
echo '
<div class="alert alert-danger alert-dismissible show fade">
<div class="alert-body">
<button class="close" data-dismiss="alert">
<span>&times;</span>
</button>
No pictures showing router positioning point uploaded!
</div>
</div>
';

}


echo '
<div class="row" style="margin-top: 10px; margin-bottom: 40px;">
<table class="" style="width: 100%;">
    <tr style="height: 50px; text-align: left; ">
        <td class="formField" style="font-size: 16px; text-transform: uppercase;"> </td>
    </tr>
</table>
</div>        
';

        

    }else{
        echo '
        <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>&times;</span>
          </button>
        No Record Data to show!
        </div>
        </div>
        ';

    }

    // Create dataTable here

}



////////////////////////////////////// OTHER APP FUNCTIONS ///////////////////////////////////////////////////////////
// Function to update user profile
function updateUserProfile(){
    global $dbc;

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $position = $_POST['position'];
        $id_session = $_POST['id_session'];


        // Hash Password Here
        $hashPassword = md5($_POST['password']); //encrypt password


            // Insert into app history table
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$email', 'Updated profile information')";

            $updateUserProfile = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', password='$hashPassword', normal_password='$password', position='$position' WHERE user_id = '$id_session' AND active_status = '1'";
            $doUpdateUserProfile = mysqli_query($dbc, $updateUserProfile);
            $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!"," You have successfully updated your profile","success").then( () => {
    location.href = "dashboard"
});';
            echo '}, 1000);
            </script>';



        }



//Logout Text Function
function logoutText(){
    $text = "Copyright &copy; 2021 <div class=bullet></div> <a href=https://iwn.ng>I-World Networks</a>";
    echo "$text";
    
}

//Logout Function
function logout(){
    global $connection;
    $logoutQuery = "SELECT * FROM users WHERE user_id='$id_session'";
    $doLogoutQuery = mysqli_query($dbc, $logoutQuery);
    $row=mysqli_fetch_array($doLogoutQuery);
    $getUser = $row['username'];

    date_default_timezone_set('Africa/Lagos');
    $date = date('M d, Y h:ia', time());

    session_start();
    session_destroy();

    //Insert Logout Action By User to app history database
    $insertLogoutHistoryQuery = "INSERT INTO app_history (date, action, user) VALUES ('$date', '$getUser Logged Out', '$getUser')";

    $doInsertLogoutHistoryQuery = mysqli_query($dbc, $insertLogoutHistoryQuery);

    //Perform Logout Action
    if(!$doInsertLogoutHistoryQuery){
        die("MySQL Query Failed" . mysqli_error($dbc));

    }
    else{
        header('location:./app-home');

    }

    

}

?>