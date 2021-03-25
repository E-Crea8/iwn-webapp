<?php

//Database Connection
include ('./inc/dbcon.php');


// Function to create internet change order form
function InternetChangeOrderForm(){
    global $dbc;

        $customer_name = $_POST['customer_name'];
        $customer_address = $_POST['customer_address'];
        $customer_email = $_POST['customer_email'];
        $customer_phone = $_POST['customer_phone'];
        $acct_mgr_name = $_POST['acct_mgr_name'];
        $acct_mgr_email = $_POST['acct_mgr_email'];
        $current_plan = $_POST['current_plan'];
        $current_plan_price = $_POST['current_plan_price'];
        $req_new_plan = $_POST['req_new_plan'];
        $new_plan_price = $_POST['new_plan_price'];
        $change_date = $_POST['change_date'];
        $change_req_by = $_POST['change_req_by'];
        $remarks = $_POST['remarks'];

        // Create Random Unique Id
        $randomUID = md5(microtime(true).mt_Rand());


            // Insert into app history table
            $insertCustomerHistory = "INSERT INTO app_history (email, action) VALUES ('$customer_email', 'Submitted a new internet service order form')";

            $insertChangeOrderForm = "INSERT INTO change_internet_service_order_form (customer_name, customer_address, customer_email, customer_phone, acct_mgr_name, acct_mgr_email, current_plan, current_plan_price, req_new_plan, new_plan_price, change_date, change_req_by, remarks, form_id) 
            VALUES ('$customer_name', '$customer_address', '$customer_email', '$customer_phone', '$acct_mgr_name', '$acct_mgr_email', '$current_plan', '$current_plan_price', '$req_new_plan', '$new_plan_price', '$change_date', '$change_req_by', '$remarks', '$randomUID')";
            $doInsertChangeOrderForm = mysqli_query($dbc, $insertChangeOrderForm);
            $doInsertUserHistory = mysqli_query($dbc, $insertCustomerHistory);

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!"," Form Submitted Successfully","success");';
            echo '}, 1000);</script>';



        }



// Function to create IP order form
function createInternetServiceOrderForm(){
    global $dbc;

        $f_name = $_POST['f_name'];
        $h_address = $_POST['h_address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $web_address = $_POST['web_address'];
        $cp_name = $_POST['cp_name'];
        $cp_phone = $_POST['cp_phone'];
        $cp_email = $_POST['cp_email'];
        $cpb_name = $_POST['cpb_name'];
        $cpb_phone = $_POST['cpb_phone'];
        $cpb_email = $_POST['cpb_email'];
        $plan = $_POST['plan'];
        $non_recurrent_cost = $_POST['non_recurrent_cost'];
        $installation_date = $_POST['installation_date'];
        $official_info = $_POST['official_info'];
        $id_session = $_POST['id_session'];

        // Create Random Unique Id
        $randomUID = md5(microtime(true).mt_Rand());

        // Get username for user for the history table
        $getNameQuery = "SELECT * FROM users WHERE user_id='$id_session'";
        $doGetNameQuery = mysqli_query($dbc, $getNameQuery);
    
        $row=mysqli_fetch_array($doGetNameQuery);
        $getEmail = $row['email'];

        // Check if customer record existed in table



            // Insert into app history table
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', '$f_name submitted a new internet service order form')";

            $insertIPOrderForm = "INSERT INTO internet_service_order_form (f_name, h_address, phone, email, web_address, cp_name, cp_phone, cp_email, cpb_name, cpb_phone, cpb_email, plan, non_recurrent_cost, installation_date, official_info, form_id) 
            VALUES ('$f_name', '$h_address', '$phone', '$email', '$web_address', '$cp_name', '$cp_phone', '$cp_email', '$cpb_name', '$cpb_phone', '$cpb_email', '$plan', '$non_recurrent_cost', '$installation_date', '$official_info', '$randomUID')";
            $doIPOrderForm = mysqli_query($dbc, $insertIPOrderForm);
            $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!"," Form Submitted Successfully","success");';
            echo '}, 1000);</script>';

            // echo json_encode($doInsertCategoryName);


        }
        

// Function to create Enterprise order form
function createEnterpriseServiceOrderForm(){
    global $dbc;

        $f_name = $_POST['f_name'];
        $h_address = $_POST['h_address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $web_address = $_POST['web_address'];
        $cp_name = $_POST['cp_name'];
        $cp_phone = $_POST['cp_phone'];
        $cp_email = $_POST['cp_email'];
        $cpb_name = $_POST['cpb_name'];
        $cpb_phone = $_POST['cpb_phone'];
        $cpb_email = $_POST['cpb_email'];
        $plan = $_POST['plan'];
        $bandwidth_cost = $_POST['bandwidth_cost'];
        $non_recurrent_cost = $_POST['non_recurrent_cost'];
        $installation_date = $_POST['installation_date'];
        $official_info = $_POST['official_info'];
        $id_session = $_POST['id_session'];

        // Create Random Unique Id
        $randomUID = md5(microtime(true).mt_Rand());

        // Get username for user for the history table
        $getNameQuery = "SELECT * FROM users WHERE user_id='$id_session'";
        $doGetNameQuery = mysqli_query($dbc, $getNameQuery);
    
        $row=mysqli_fetch_array($doGetNameQuery);
        $getEmail = $row['email'];

        // Check if customer record existed in table

        // Generate date - Lagos time format
        date_default_timezone_set("Africa/Lagos");

        $date = date('M d, Y');
        // $date = date('M d, Y', time());
        



            // Insert into app history table
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', '$f_name submitted a new enterprise internet service order form')";

            $insertEnterpriseOrderForm = "INSERT INTO ent_order_form (f_name, h_address, phone, email, web_address, cp_name, cp_phone, cp_email, cpb_name, cpb_phone, cpb_email, plan, bandwidth_cost, non_recurrent_cost, installation_date, official_info, form_id, date_submitted) 
            VALUES ('$f_name', '$h_address', '$phone', '$email', '$web_address', '$cp_name', '$cp_phone', '$cp_email', '$cpb_name', '$cpb_phone', '$cpb_email', '$plan', '$bandwidth_cost', '$non_recurrent_cost', '$installation_date', '$official_info', '$randomUID', '$date')";
            $doEnterpriseOrderForm = mysqli_query($dbc, $insertEnterpriseOrderForm);
            $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!"," Enterprise Internet Service Order Form Submitted Successfully.","success");';
            echo '}, 1000);</script>';

            // echo json_encode($doInsertCategoryName);


        }


// Function to create equipment lease form
function createEquipmentLeaseForm(){
    global $dbc;

        $client_name = $_POST['client_name'];
        $title = $_POST['title'];
        $customer_name = $_POST['customer_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $device_model_1 = $_POST['device_model_1'];
        $mac_add_1 = $_POST['mac_add_1'];
        $device_model_2 = $_POST['device_model_2'];
        $mac_add_2 = $_POST['mac_add_2'];
        $device_model_3 = $_POST['device_model_3'];
        $mac_add_3 = $_POST['mac_add_3'];
        $device_model_4 = $_POST['device_model_4'];
        $mac_add_4 = $_POST['mac_add_4'];
        $agreement_date = $_POST['agreement_date'];
        $witness_name = $_POST['witness_name'];
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



            // Insert into app history table
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', '$client_name submitted a new equipment lease form')";

            $insertEquipmentLeaseForm = "INSERT INTO equipment_lease_form (client_name, title, customer_name, phone, email, address, device_model_1, mac_add_1, device_model_2, mac_add_2, device_model_3, mac_add_3, device_model_4, mac_add_4, agreement_date, witness_name, form_id, date_submitted) 
            VALUES ('$client_name', '$title', '$customer_name', '$phone', '$email', '$address', '$device_model_1', '$mac_add_1', '$device_model_2', '$mac_add_2', '$device_model_3', '$mac_add_3', '$device_model_4', '$mac_add_4', '$agreement_date', '$witness_name', '$randomUID', '$date')";
            $doEquipmentLeaseForm = mysqli_query($dbc, $insertEquipmentLeaseForm);
            $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!"," Form Submitted Successfully ","success");';
            echo '}, 1000);</script>';

            // echo json_encode($doInsertCategoryName);


        }


////////////// SITE SURVEY FORMS FUNCTIONS HERE//////////////////////////////////////////////////////////////////////////////////////////
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
                    <td> <img src="./app-v1/dist/img/IP-Order-Form-I-World-Networks-Logo.fw.png" alt="I-World Networks Logo"></td>
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
        <a href="./app-v1/siteSurveyUploads/'.$renameDirName.'/'.$row3['file_name'].'" data-toggle="lightbox" data-gallery="example-gallery">
            <img src = "./app-v1/siteSurveyUploads/'.$renameDirName.'/'.$row3['file_name'].'" style="width: 350px; height: 350px; border: 1px solid #ededed;" class="img-fluid">
            
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
        <a href="./app-v1/siteSurveyUploads/'.$renameDirName.'/'.$row4['file_name'].'" data-toggle="lightbox" data-gallery="example-gallery">
            <img src = "./app-v1/siteSurveyUploads/'.$renameDirName.'/'.$row4['file_name'].'" style="width: 350px; height: 350px; border: 1px solid #ededed;" class="img-fluid">
            
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
<a href="./app-v1/siteSurveyUploads/'.$renameDirName.'/'.$row5['file_name'].'" data-toggle="lightbox" data-gallery="example-gallery">
    <img src = "./app-v1/siteSurveyUploads/'.$renameDirName.'/'.$row5['file_name'].'" style="width: 350px; height: 350px; border: 1px solid #ededed;" class="img-fluid">
    
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
<a href="./app-v1/siteSurveyUploads/'.$renameDirName.'/'.$row6['file_name'].'" data-toggle="lightbox" data-gallery="example-gallery">
    <img src = "./app-v1/siteSurveyUploads/'.$renameDirName.'/'.$row6['file_name'].'" style="width: 350px; height: 350px; border: 1px solid #ededed;" class="img-fluid">
    
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
<a href="./app-v1/siteSurveyUploads/'.$renameDirName.'/'.$row7['file_name'].'" data-toggle="lightbox" data-gallery="example-gallery">
    <img src = "./app-v1/siteSurveyUploads/'.$renameDirName.'/'.$row7['file_name'].'" style="width: 350px; height: 350px; border: 1px solid #ededed;" class="img-fluid">
    
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
<a href="./app-v1/siteSurveyUploads/'.$renameDirName.'/'.$row8['file_name'].'" data-toggle="lightbox" data-gallery="example-gallery">
    <img src = "./app-v1/siteSurveyUploads/'.$renameDirName.'/'.$row8['file_name'].'" style="width: 350px; height: 350px; border: 1px solid #ededed;" class="img-fluid">
    
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

?>