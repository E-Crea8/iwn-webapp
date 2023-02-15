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
    $getNoOfInternetServiceOrderForm = "SELECT COUNT(*) FROM ip_order_form";
    $doGetNoOfInternetServiceOrderForm = mysqli_query($dbc, $getNoOfInternetServiceOrderForm);

    $row = mysqli_fetch_array($doGetNoOfInternetServiceOrderForm);

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


// Function to create internet change order form
function createInternetChangeOrderForm(){
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
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', 'Created a new internet service change order form for $customer_name')";

            $insertChangeOrderForm = "INSERT INTO change_internet_service_order_form (customer_name, customer_address, customer_email, customer_phone, acct_mgr_name, acct_mgr_email, current_plan, current_plan_price, req_new_plan, new_plan_price, change_date, change_req_by, remarks, form_id) 
            VALUES ('$customer_name', '$customer_address', '$customer_email', '$customer_phone', '$acct_mgr_name', '$acct_mgr_email', '$current_plan', '$current_plan_price', '$req_new_plan', '$new_plan_price', '$change_date', '$change_req_by', '$remarks', '$randomUID')";
            $doInsertChangeOrderForm = mysqli_query($dbc, $insertChangeOrderForm);
            $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!","Internet service change order form for '.$customer_name.' created successfully. Click OK to view form data","success").then( () => {
    location.href = "change-order-record"});';
            echo '}, 1000);
            </script>';        

            // echo json_encode($doInsertCategoryName);


        }

        
// Function to manage change order form for internet service
function manageInternetChangeOrderForm(){
    global $dbc;
    $selectChangeOrderFormData = "SELECT * FROM change_internet_service_order_form ORDER BY id DESC";
    $doSelectChangeOrderFormData = mysqli_query($dbc, $selectChangeOrderFormData);
    $checkIfNotEmpty = mysqli_num_rows($doSelectChangeOrderFormData);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
        <table id="change-order-form-data" class="table table-striped">
        <thead style="font-size:12px;">
            <tr>
                <th>SN</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Date of Change</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot style="font-size:12px;">
            <tr>
            <th>SN</th>
            <th>Customer Name</th>
            <th>Customer Phone</th>
            <th>Date of Change</th>
            <th>Action</th>
    </tr>
        </tfoot>
        ';
        while($row = mysqli_fetch_array($doSelectChangeOrderFormData))
        
        {
            $sn++;
            $changeId = $row["id"];
            $customerName = $row["customer_name"];
            echo '
            <tr style="font-size:12px;">
            <td> '.$sn.' </td>
            <td> '.$row["customer_name"].' </td>
            <td> '.$row["customer_phone"].' </td>
            <td> '.$row["change_date"].' </td>
            <td> <a href="edit-change-order-form?sn='.$row["id"].'" class="btn btn-sm btn-info" ><i class="ion-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="delete_change_order_form" data-id="'.$changeId.'"><i class="ion-trash-a"></i></a>
            <a href="pdf-change-order-form?form_id='.$row["form_id"].'" target=_blank class="btn btn-sm btn-primary" >PDF</a>
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

    // End dataTable here

}


// Function to print change order form for internet service
function InternetChangeOrderForm($form_id){
    global $dbc;
    $selectChangeOrderFormRecord = "SELECT * FROM change_internet_service_order_form WHERE form_id = '$form_id'";
    $doSelectChangeOrderFormRecord = mysqli_query($dbc, $selectChangeOrderFormRecord);
    $checkIfNotEmpty = mysqli_num_rows($doSelectChangeOrderFormRecord);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
      <div class="container mt-0" id="changeOrderForm">
        ';
        while($row = mysqli_fetch_array($doSelectChangeOrderFormRecord))
        
        {
            $sn++;
            $changeId = $row["id"];
            $customerName = $row["customer_name"];
            $currentPrice = number_format($row["current_plan_price"],2);

            echo '
            <div class="row" style=margin-bottom: 10px;">
            <table style="width: 100%;">
                <tr style="height: 80px; text-align: right; color: #FFFFFF; font-family: Georgia, Times New Roman, Times, serif; font-size: 11px; font-weight: 300;">
                    <td> <img src="./../dist/img/I-World Networks Logo.fw.png" alt="I-World Networks Logo"><br>
                    <i><span style="text-align: right; color: #9CCA48;"> The Best Fixed Wireless Broadband in Nigeria &nbsp;&nbsp;</span></i></td>
                </tr>
            </table>
        </div>


        <div class="row">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 80px; text-align: center; padding: 40px 0px 40px 0px; background-color: #9CCA48; color: #FFFFFF; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 700;">
                    <td> <h4>CHANGE ORDER FOR SERVICE</h4></td>
                </tr>
                <tr style="height: 40px; text-align: center; text-transform: uppercase; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 600;">
                    <td>section a: equipment replacement</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Customer Name:</td>
                    <td style="padding-left: 10px;">'.$row["customer_name"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Customer Address:</td>
                    <td style="padding-left: 10px;">'.$row["customer_address"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Customer Email(s):</td>
                    <td style="padding-left: 10px;">'.$row["customer_email"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 40px; text-align: center; text-transform: uppercase; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 600;">
                    <td>section b: account manager&#39;s details</td>
                </tr>
            </table>
        </div>
        

        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Account Manager&#39;s Name:</td>
                    <td style="padding-left: 10px;">'.$row["acct_mgr_name"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Account Manager&#39;s Email:</td>
                    <td style="padding-left: 10px;">'.$row["acct_mgr_email"].'</td>
                </tr>
            </table>
        </div>

        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 40px; text-align: center; text-transform: uppercase; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 600;">
                    <td>service change details</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Current Plan:</td>
                    <td style="padding-left: 10px;">'.$row["current_plan"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Price of Current Plan:</td>
                    <td style="padding-left: 10px;">&#8358;'.$currentPrice.'</td>
                </tr>
            </table>
        </div>

        
        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Requested New Plan:</td>
                    <td style="padding-left: 10px;">'.$row["req_new_plan"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Price of New Plan:</td>
                    <td style="padding-left: 10px;">&#8358;'.number_format($row["new_plan_price"],2).'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Date of Change:</td>
                    <td style="padding-left: 10px;">'.$row["change_date"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 40px; text-align: left;">
                    <td class="formField"> Change Requested by: </td>
                    <td style="padding-left: 10px;">'.$row["change_req_by"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px; margin-bottom: 30px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 50px; text-align: center;">
                    <td style="padding-left: 10px; text-align: left; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 600;"> Remarks: <span style="padding-left: 1px; font-weight: normal;">'.$row["remarks"].'</span></td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px; margin-bottom: 20px;">
            <table style="width: 100%;">
                <tr style="height: 60px; text-align: center;">
                    <td style="text-align: center; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 400;"> ------------------------------------------------------<br>
                        <span style="text-align: center;">Customer Signature and Date</span></td>
                    <td style="text-align: center; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 400;"> ------------------------------------------------------<br>
                    <span style="text-align: center;">I-World Representative Signature and Date</span></td>
                </tr>
            </table>
        </div>
            
            
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

    // Create dataTable here

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
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', 'Created a new internet service order form for $f_name')";

            $insertIPOrderForm = "INSERT INTO ip_order_form (f_name, h_address, phone, email, web_address, cp_name, cp_phone, cp_email, cpb_name, cpb_phone, cpb_email, plan, non_recurrent_cost, installation_date, official_info, form_id) 
            VALUES ('$f_name', '$h_address', '$phone', '$email', '$web_address', '$cp_name', '$cp_phone', '$cp_email', '$cpb_name', '$cpb_phone', '$cpb_email', '$plan', '$non_recurrent_cost', '$installation_date', '$official_info', '$randomUID')";
            $doIPOrderForm = mysqli_query($dbc, $insertIPOrderForm);
            $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!","Internet service order form for '.$f_name.' created successfully. Click OK to view form data","success").then( () => {
    location.href = "ip-order-form-record"});';
            echo '}, 1000);
            </script>';        

            // echo json_encode($doInsertCategoryName);


        }


// Function to manage IP order form
function manageInternetServiceOrderForm(){
    global $dbc;
    $selectIPOrderFormData = "SELECT * FROM ip_order_form ORDER BY id DESC";
    $doSelectIPOrderFormData = mysqli_query($dbc, $selectIPOrderFormData);
    $checkIfNotEmpty = mysqli_num_rows($doSelectIPOrderFormData);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
        <table id="ipOrderFormData" class="table table-striped">
        <thead style="font-size:12px;">
            <tr>
                <th>SN</th>
                <th>Organization/Client Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th style="width: 20%;">Action</th>
            </tr>
        </thead>
        <tfoot style="font-size:12px;">
            <tr>
            <th>SN</th>
            <th>Organization/Client Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th style="width: 20%;">Action</th>
</tr>
        </tfoot>
        ';
        while($row = mysqli_fetch_array($doSelectIPOrderFormData))
        
        {
            $sn++;
            $ipId = $row["id"];
            $clientName = $row["f_name"];

            // Create Random Unique Id
            $randomUID = md5(microtime(true).mt_Rand());

            echo '
            <tr style="font-size:12px;">
            <td> '.$sn.' </td>
            <td> '.$row["f_name"].' </td>
            <td> '.$row["h_address"].' </td>
            <td> '.$row["phone"].' </td>
            <td> <a href="edit-internet-service-order-form?id='.$row["id"].'" class="btn btn-sm btn-info" ><i class="ion-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="delete-internet-service-order-form" data-id="'.$ipId.'"><i class="ion-trash-a"></i></a>
            <a href="pdf-internet-service-order-form?form_id='.$row["id"].'&form_ref='.$randomUID.'" target=_blank class="btn btn-sm btn-primary" >PDF</a>
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


// Function to print IP order form
function InternetServiceOrderForm($form_id){
    global $dbc;
    $selectIPOrderFormRecord = "SELECT * FROM ip_order_form WHERE id = '$form_id'";
    $doSelectIPOrderFormRecord = mysqli_query($dbc, $selectIPOrderFormRecord);
    $checkIfNotEmpty = mysqli_num_rows($doSelectIPOrderFormRecord);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
      <div class="container mt-0" id="ipOrderForm">
        ';
        while($row = mysqli_fetch_array($doSelectIPOrderFormRecord))
        
        {
            $sn++;
            $IPId = $row["id"];
            $clientName = $row["f_name"];
            $currentPrice = number_format($row["non_recurrent_cost"],2);

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
                    <td> <h4>INTERNET SERVICE ORDER FORM</h4></td>
                </tr>
                <tr style="height: 40px; text-align: center; background-color: #DCDADB; text-transform: uppercase; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 600;">
                    <td>client information</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> NAMES OF ORGANIZATIONS/CLIENTS: '.$row["f_name"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
            <tr style="height: 35px; text-align: left;">
            <td class="formField"> BUSINESS/HOME ADDRESS: '.$row["h_address"].'</td>
        </tr>

                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> TELEPHONE NUMBER: '.$row["phone"].'</td>
                </tr>

                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> EMAIL ADDRESS: '.$row["email"].'</td>
                </tr>

                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> WEB ADDRESS: '.$row["web_address"].'</td>
                </tr>
                </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
            <tr style="height: 35px; text-align: left;">
                <td class="formField"> NAME OF CONTACT PERSON (TECHNICAL): '.$row["cp_name"].'</td>
            </tr>

            <tr style="height: 35px; text-align: left;">
                <td class="formField"> MOBILE NUMBER: '.$row["cp_phone"].'</td>
            </tr>

            <tr style="height: 35px; text-align: left;">
                <td class="formField"> EMAIL ADDRESS: '.$row["cp_email"].'</td>
            </tr>

            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
        <table class="table-bordered" style="width: 100%;">
        <tr style="height: 35px; text-align: left;">
            <td class="formField"> NAME OF CONTACT PERSON (BILLING): '.$row["cpb_name"].'</td>
        </tr>

        <tr style="height: 35px; text-align: left;">
            <td class="formField"> MOBILE NUMBER: '.$row["cpb_phone"].'</td>
        </tr>

        <tr style="height: 35px; text-align: left;">
            <td class="formField"> EMAIL ADDRESS: '.$row["cpb_email"].'</td>
        </tr>

        </table>
        </div>

        <div style="padding: 5px;"></div> 
        
        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
            <tr style="height: 35px; text-align: left;">
            <td class="formField"> PLAN: '.$row["plan"].'</td>
            </tr>

            <tr style="height: 35px; text-align: left;">
            <td class="formField"> NON-RECURRENT FEE: &#8358;'.number_format($row["non_recurrent_cost"],2).'</td>
            </tr>
        </table>
        </div>

        <div style="padding: 20px; margin-left: -35px; margin-top: -15px">
        This is to request for a Site survey / Installation to be carried out by I-World Networks at the above address.<br>
        This should be carried out on (date) '.$row["installation_date"].'
        </div> 

        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 40px; background-color: #DCDADB; text-align: center; text-transform: uppercase; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 600;">
                    <td>official use</td>
                </tr>
            </table>
        </div>
        

        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 65px; text-align: left;">
                    <td style="padding-left: 10px;">'.$row["official_info"].'</td>
                </tr>
            </table>
        </div>

        <div style="padding: 20px; margin-left: -35px; margin-bottom: 30px; margin-top: -15px">
        <strong>NOTE:</strong> It is highly recommended that all internet equipment be protected against electrical surge by powering it through UPS or a stabilizer with a surge protector. 
        Electrical damage of the equipment will not be catered for by I-World Networks.        
        </div> 


        <div class="row" style="margin-top: 0px; margin-bottom: 10px;">
            <table style="width: 100%;">
                <tr style="height: 60px; text-align: center;">
                    <td style="text-align: center; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 400;"> ------------------------------------------------------<br>
                        <span style="text-align: center;">Client Signature</span></td>
                    <td style="text-align: center; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 400;"> ------------------------------------------------------<br>
                    <span style="text-align: center;">Account Manager</span></td>
                </tr>
            </table>
        </div>
            
            
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

    // Create dataTable here

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
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', 'Created a new internet service order form for $f_name')";

            $insertEnterpriseOrderForm = "INSERT INTO ent_order_form (f_name, h_address, phone, email, web_address, cp_name, cp_phone, cp_email, cpb_name, cpb_phone, cpb_email, plan, bandwidth_cost, non_recurrent_cost, installation_date, official_info, form_id, date_submitted) 
            VALUES ('$f_name', '$h_address', '$phone', '$email', '$web_address', '$cp_name', '$cp_phone', '$cp_email', '$cpb_name', '$cpb_phone', '$cpb_email', '$plan', '$bandwidth_cost', '$non_recurrent_cost', '$installation_date', '$official_info', '$randomUID', '$date')";
            $doEnterpriseOrderForm = mysqli_query($dbc, $insertEnterpriseOrderForm);
            $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!","Enterprise internet service order form for '.$f_name.' created successfully. Click OK to view form data","success").then( () => {
    location.href = "enterprise-order-record"});';
            echo '}, 1000);
            </script>';        

            // echo json_encode($doInsertCategoryName);


        }


// Function to manage enterprise order form
function manageEnterpriseServiceOrderForm(){
    global $dbc;
    $selectEnterpriseOrderFormData = "SELECT * FROM ent_order_form ORDER BY id DESC";
    $doSelectEnterpriseOrderFormData = mysqli_query($dbc, $selectEnterpriseOrderFormData);
    $checkIfNotEmpty = mysqli_num_rows($doSelectEnterpriseOrderFormData);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
        <table id="enterpriseOrderFormData" class="table table-striped">
        <thead style="font-size:12px;">
            <tr>
                <th>SN</th>
                <th>Organization/Client Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th style="width: 20%;">Action</th>
            </tr>
        </thead>
        <tfoot style="font-size:12px;">
            <tr>
            <th>SN</th>
            <th>Organization/Client Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th style="width: 20%;">Action</th>
</tr>
        </tfoot>
        ';
        while($row = mysqli_fetch_array($doSelectEnterpriseOrderFormData))
        
        {
            $sn++;
            $entId = $row["id"];
            $clientName = $row["f_name"];

            // Create Random Unique Id
            $randomUID = md5(microtime(true).mt_Rand());

            echo '
            <tr style="font-size:12px;">
            <td> '.$sn.' </td>
            <td> '.$row["f_name"].' </td>
            <td> '.$row["h_address"].' </td>
            <td> '.$row["phone"].' </td>
            <td> <a href="edit-enterprise-service-order-form?id='.$row["id"].'" class="btn btn-sm btn-info" ><i class="ion-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="delete-enterprise-service-order-form" data-id="'.$entId.'"><i class="ion-trash-a"></i></a>
            <a href="pdf-enterprise-service-order-form?form_id='.$row["id"].'&form_ref='.$randomUID.'" target=_blank class="btn btn-sm btn-primary" >PDF</a>
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


// Function to print Enterprise order form
function EnterpriseServiceOrderForm($form_id){
    global $dbc;
    $selectEnterpriseOrderFormRecord = "SELECT * FROM ent_order_form WHERE id = '$form_id'";
    $doSelectEnterpriseOrderFormRecord = mysqli_query($dbc, $selectEnterpriseOrderFormRecord);
    $checkIfNotEmpty = mysqli_num_rows($doSelectEnterpriseOrderFormRecord);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
      <div class="container mt-0" id="enterpriseOrderForm">
        ';
        while($row = mysqli_fetch_array($doSelectEnterpriseOrderFormRecord))
        
        {
            $sn++;
            $entId = $row["id"];
            $clientName = $row["f_name"];
            $currentPrice = number_format($row["non_recurrent_cost"],2);

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
                    <td> <h4>ENTERPRISE SERVICE ORDER FORM</h4></td>
                </tr>
                <tr style="height: 40px; text-align: center; background-color: #DCDADB; text-transform: uppercase; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 600;">
                    <td>client information</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> NAMES OF ORGANIZATIONS/CLIENTS: '.$row["f_name"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
            <tr style="height: 35px; text-align: left;">
            <td class="formField"> BUSINESS/HOME ADDRESS: '.$row["h_address"].'</td>
        </tr>

                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> TELEPHONE NUMBER: '.$row["phone"].'</td>
                </tr>

                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> EMAIL ADDRESS: '.$row["email"].'</td>
                </tr>

                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> WEB ADDRESS: '.$row["web_address"].'</td>
                </tr>
                </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
            <tr style="height: 35px; text-align: left;">
                <td class="formField"> NAME OF CONTACT PERSON (TECHNICAL): '.$row["cp_name"].'</td>
            </tr>

            <tr style="height: 35px; text-align: left;">
                <td class="formField"> MOBILE NUMBER: '.$row["cp_phone"].'</td>
            </tr>

            <tr style="height: 35px; text-align: left;">
                <td class="formField"> EMAIL ADDRESS: '.$row["cp_email"].'</td>
            </tr>

            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
        <table class="table-bordered" style="width: 100%;">
        <tr style="height: 35px; text-align: left;">
            <td class="formField"> NAME OF CONTACT PERSON (BILLING): '.$row["cpb_name"].'</td>
        </tr>

        <tr style="height: 35px; text-align: left;">
            <td class="formField"> MOBILE NUMBER: '.$row["cpb_phone"].'</td>
        </tr>

        <tr style="height: 35px; text-align: left;">
            <td class="formField"> EMAIL ADDRESS: '.$row["cpb_email"].'</td>
        </tr>

        </table>
        </div>

        <div style="padding: 5px;"></div> 
        
        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
            <tr style="height: 35px; text-align: left;">
            <td class="formField"> PLAN: '.$row["plan"].'</td>
            </tr>

            <tr style="height: 30px; text-align: left;">
            <td class="formField"> BANDWIDTH COST: &#8358;'.number_format($row["bandwidth_cost"],2).'</td>
            </tr>


            <tr style="height: 30px; text-align: left;">
            <td class="formField"> NON-RECURRENT FEE: &#8358;'.number_format($row["non_recurrent_cost"],2).'</td>
            </tr>
            </table>
        </div>

        <div style="padding: 20px; margin-left: -35px; margin-top: -15px">
        This is to request for a Site survey / Installation to be carried out by I-World Networks at the above address.<br>
        This should be carried out on (date) '.$row["installation_date"].'
        </div> 

        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 40px; background-color: #DCDADB; text-align: center; text-transform: uppercase; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 600;">
                    <td>official use</td>
                </tr>
            </table>
        </div>
        

        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 50px; text-align: left;">
                    <td style="padding-left: 10px;">'.$row["official_info"].'</td>
                </tr>
            </table>
        </div>

        <div style="padding: 20px; margin-left: -35px; margin-bottom: 30px; margin-top: -15px">
        <strong>NOTE:</strong> It is highly recommended that all internet equipment be protected against electrical surge by powering it through UPS or a stabilizer with a surge protector. 
        Electrical damage of the equipment will not be catered for by I-World Networks.        
        </div> 


        <div class="row" style="margin-top: 0px; margin-bottom: 10px;">
            <table style="width: 100%;">
                <tr style="height: 50px; text-align: center;">
                    <td style="text-align: center; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 400;"> ------------------------------------------------------<br>
                        <span style="text-align: center;">Client Signature</span></td>
                    <td style="text-align: center; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 400;"> ------------------------------------------------------<br>
                    <span style="text-align: center;">Account Manager</span></td>
                </tr>
            </table>
        </div>
            
            
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

    // Create dataTable here

}



// Function to create equipment lease form
function createEquipmentLeaseForm(){
    global $dbc;

        $title = $_POST['title'];
        $customer_name = $_POST['customer_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $gps_coordinate = $_POST['gps_coordinate'];
        $equipment_name_1 = $_POST['equipment_name_1'];
        $equipment_type_1 = $_POST['equipment_type_1'];
        $mac_add_1 = $_POST['mac_add_1'];
        $serial_number_1 = $_POST['serial_number_1'];
        $model_part_1 = $_POST['model_part_1'];
        $equipment_name_2 = $_POST['equipment_name_2'];
        $equipment_type_2 = $_POST['equipment_type_2'];
        $mac_add_2 = $_POST['mac_add_2'];
        $serial_number_2 = $_POST['serial_number_2'];
        $model_part_2 = $_POST['model_part_2'];
        $equipment_name_3 = $_POST['equipment_name_3'];
        $equipment_type_3 = $_POST['equipment_type_3'];
        $mac_add_3 = $_POST['mac_add_3'];
        $serial_number_3 = $_POST['serial_number_3'];
        $model_part_3 = $_POST['model_part_3'];
        $equipment_name_4 = $_POST['equipment_name_4'];
        $equipment_type_4 = $_POST['equipment_type_4'];
        $mac_add_4 = $_POST['mac_add_4'];
        $serial_number_4 = $_POST['serial_number_4'];
        $model_part_4 = $_POST['model_part_4'];        
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
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', 'Created a new equipment lease form form for $customer_name')";

            $insertEquipmentLeaseForm = "INSERT INTO equipment_lease_form (title, customer_name, phone, email, address, gps_coordinate, equipment_name_1, equipment_type_1, mac_add_1, serial_number_1, model_part_1, equipment_name_2, equipment_type_2, mac_add_2, serial_number_2, model_part_2, equipment_name_3, equipment_type_3, mac_add_3, serial_number_3, model_part_3, equipment_name_4, equipment_type_4, mac_add_4, serial_number_4, model_part_4, agreement_date, witness_name, form_id, date_submitted) 
            VALUES ('$title', '$customer_name', '$phone', '$email', '$address', '$gps_coordinate', '$equipment_name_1', '$equipment_type_1', '$mac_add_1', '$serial_number_1', '$model_part_1', '$equipment_name_2', '$equipment_type_2', '$mac_add_2', '$serial_number_2', '$model_part_2', '$equipment_name_3', '$equipment_type_3', '$mac_add_3', '$serial_number_3', '$model_part_3', '$equipment_name_4', '$equipment_type_4', '$mac_add_4', '$serial_number_4', '$model_part_4', '$agreement_date', '$witness_name', '$randomUID', '$date')";
            $doEquipmentLeaseForm = mysqli_query($dbc, $insertEquipmentLeaseForm);
            $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);


            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!","Equipment lease form for '.$customer_name.' created successfully. Click OK to view form data","success").then( () => {
    location.href = "equipment-lease-record"});';
            echo '}, 1000);
            </script>';        
            
            // echo json_encode($doInsertCategoryName);


        }


// Function to manage equipment lease form
function manageEquipmentLeaseForm(){
    global $dbc;
    $selectEquipmentLeaseFormData = "SELECT * FROM equipment_lease_form ORDER BY id DESC";
    $doSelectEquipmentLeaseFormData = mysqli_query($dbc, $selectEquipmentLeaseFormData);
    $checkIfNotEmpty = mysqli_num_rows($doSelectEquipmentLeaseFormData);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
        <table id="equipmentLeaseFormData" class="table table-striped">
        <thead style="font-size:12px;">
            <tr>
                <th>SN</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th style="width: 20%;">Action</th>
            </tr>
        </thead>
        <tfoot style="font-size:12px;">
            <tr>
            <th>SN</th>
            <th>Cusstomer Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th style="width: 20%;">Action</th>
</tr>
        </tfoot>
        ';
        while($row = mysqli_fetch_array($doSelectEquipmentLeaseFormData))
        
        {
            $sn++;
            $eLId = $row["id"];
            $customerName = $row["customer_name"];

            // Create Random Unique Id
            $randomUID = md5(microtime(true).mt_Rand());

            echo '
            <tr style="font-size:12px;">
            <td> '.$sn.' </td>
            <td> '.$row["customer_name"].' </td>
            <td> '.$row["phone"].' </td>
            <td> '.$row["email"].' </td>
            <td> <a href="edit-equipment-lease-form?id='.$row["id"].'" class="btn btn-sm btn-info" ><i class="ion-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="delete-equipment-lease-form" data-id="'.$eLId.'"><i class="ion-trash-a"></i></a>
            <a href="pdf-equipment-lease-form?form_id='.$row["id"].'&form_ref='.$randomUID.'" target=_blank class="btn btn-sm btn-primary" >PDF</a>
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


// Function to print equipment lease form
function equipmentLeaseForm($form_id){
    global $dbc;
    $selectEquipmentLeaseFormRecord = "SELECT * FROM equipment_lease_form WHERE id = '$form_id'";
    $doSelectEquipmentLeaseFormRecord = mysqli_query($dbc, $selectEquipmentLeaseFormRecord);
    $checkIfNotEmpty = mysqli_num_rows($doSelectEquipmentLeaseFormRecord);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
      <div class="container mt-0" id="equipmentLeaseForm">
        ';
        while($row = mysqli_fetch_array($doSelectEquipmentLeaseFormRecord))
        
        {
            $sn++;
            $eLId = $row["id"];
            $customerName = $row["customer_name"];

            echo '
            <div class="row" style=margin-bottom: 10px;">
            <table style="width: 100%;">
                <tr style="height: 80px; text-align: right; color: #FFFFFF; font-family: Georgia, Times New Roman, Times, serif; font-size: 11px; font-weight: 300;">
                    <td> <img src="./../dist/img/IP-Order-Form-I-World-Networks-Logo.fw.png" alt="I-World Networks Logo"></td>
                </tr>
            </table>
        </div>


        <div class="row">
            <div style="width: 100%; padding: 5px 10px;">
                 <h4 style="text-align: center; padding: 40px 0px 20px 0px; font-family: Georgia, Times New Roman, Times, serif; font-size: 18px; font-weight: 700;">
                 EQUIPMENT CUSTODY FORM AND AGREEMENT </h4>
                 <p> This is the Internet Service Equipment Custody agreement between 
                 I-World Networks Limited RC 1556660 (Also Referred to as Internet Service Provider “ISP”) with 
                 NCC License Number INT /025/19 and <span style=" font-weight: 600; text-decoration: underline;">'.$row["title"].'&nbsp;'.$row["customer_name"].'</span> 
                 of <span style=" font-weight: 600; text-decoration: underline;">'.$row["address"].'</span></p>
                 
                 <p>The following equipment was installed at <span style=" font-weight: 600; text-decoration: underline;">'.$row["address"].'</span> and <span style=" font-weight: 600; text-decoration: underline;">'.$row["gps_coordinate"].'</span>
                  for the purpose of providing Internet Service for <span style=" font-weight: 600; text-decoration: underline;">'.$row["title"].'&nbsp;'.$row["customer_name"].'</span>  and remains the property of
                   I-World Networks Limited.
                 </p>
                
            </div>
        </div>

        <div class="row">
        <div style="width: 100%; padding: 0px 10px;">
        <h4 style="text-align: left; padding: 40px 0px 20px 0px; font-family: Georgia, Times New Roman, Times, serif; font-size: 18px; font-weight: 700; margin-bottom: -10px;":>Installed Equipment Details </h4>
        <span style"font-weight: bold;"> <strong>1.</strong> </span><br>
        <p>
        <span style="font-weight: 600">Equipment Name:</span> '.$row["equipment_name_1"].'<br>
        <span style="font-weight: 600">Equipment Type:</span> '.$row["equipment_type_1"].'<br>
        <span style="font-weight: 600">Mac Address:</span> '.$row["mac_add_1"].'<br> 
        <span style="font-weight: 600">Serial Number:</span> '.$row["serial_number_1"].'<br>
        <span style="font-weight: 600">Model Part (SKU):</span> '.$row["model_part_1"].'
                
        </p>
       
   </div>
</div>


<div class="row">
<div style="width: 100%; padding: 0px 10px;">
<span style"font-weight: bold;"> <strong>2.</strong> </span><br>
<p>
<span style="font-weight: 600">Equipment Name:</span> '.$row["equipment_name_2"].'<br>
<span style="font-weight: 600">Equipment Type:</span> '.$row["equipment_type_2"].'<br>
<span style="font-weight: 600">Mac Address:</span> '.$row["mac_add_2"].'<br> 
<span style="font-weight: 600">Serial Number:</span> '.$row["serial_number_2"].'<br>
<span style="font-weight: 600">Model Part (SKU):</span> '.$row["model_part_2"].'
        
</p>

</div>
</div>


<div class="row">
<div style="width: 100%; padding: 0px 10px;">
<span style"font-weight: bold;"> <strong>3.</strong> </span><br>
<p>
<span style="font-weight: 600">Equipment Name:</span> '.$row["equipment_name_3"].'<br>
<span style="font-weight: 600">Equipment Type:</span> '.$row["equipment_type_3"].'<br>
<span style="font-weight: 600">Mac Address:</span> '.$row["mac_add_3"].'<br> 
<span style="font-weight: 600">Serial Number:</span> '.$row["serial_number_3"].'<br>
<span style="font-weight: 600">Model Part (SKU):</span> '.$row["model_part_3"].'
        
</p>

</div>
</div>


<div class="row">
<div style="width: 100%; padding: 0px 10px 50px 10px;">
<span style"font-weight: bold;"> <strong>4.</strong> </span><br>
<p>
<span style="font-weight: 600">Equipment Name:</span> '.$row["equipment_name_4"].'<br>
<span style="font-weight: 600">Equipment Type:</span> '.$row["equipment_type_4"].'<br>
<span style="font-weight: 600">Mac Address:</span> '.$row["mac_add_4"].'<br> 
<span style="font-weight: 600">Serial Number:</span> '.$row["serial_number_4"].'<br>
<span style="font-weight: 600">Model Part (SKU):</span> '.$row["model_part_4"].'
        
</p>

</div>
</div>

<div class="row">
<div style="width: 100%; padding: 0px 10px;">
     <h4 style="text-align: left; margin-bottom: -10px; padding: 40px 0px 20px 0px; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 700;">
     (RIGHTS & OBLIGATION UNER THIS AGREEMENT) </h4>
     <p style="font-weight: 700"> This is the Internet Service Equipment Custody agreement between
      I-World Networks Rights and Obligation to Equipment in Clients Custody 
      <ol>
            <li> I-World Networks (ISP) reserves the right to change and upgrade equipment to the latest technology
             to improve on service to the client at any time.  
            </li>
            <li> I-World Networks (ISP) reserves the right to scheduled or Emergency Maintenance on equipment. </li>
            <li> I-World Networks (ISP) reserves the right to retrieve equipment within 60days of client account non 
            inactive due to non-renewal of Monthly Internet Service subscription or due to travelling or temporary relocation.</li>

      </ol>

     </p>
         
</div>
</div>


<div class="row">
<div style="width: 100%; padding: 5px 10px;">
     <h4 style="text-align: left; margin-bottom: -10px; padding: 40px 0px 20px 0px; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 700;">
     Client Rights and Obligation to Equipment </h4>
     <p style="font-weight: 500"> I, <span style=" font-weight: 600; text-decoration: underline;">'.$row["title"].'&nbsp;'.$row["customer_name"].'</span>,
      (also referred to as Client) of the above address, agree to the following: 
      <ol>
            <li> Client agrees that the above stated equipment belongs to I-World Networks Ltd..  
            </li>
            <li> Client is obligated to regularly renew his subscription every month. </li>
            <li> Client is obligated to protect the devices properly with either of the following.</li>
            <div style="margin-left: 70px; line-height: 20px; margin-top: 2px;"> a) UPS, Stabilizer or Surge Protector.<br>
            b) Also, it is advisable to ensure that the earthing system of the premises is in good condition.
        </div>
        
            <li> When planning to travel out of town or country for more than Thirty (30) days, the client is 
            
            obligated to officially give at least Three (3) days prior notice to I-World Networks Ltd so that the 
            equipment can be retrieved in an attempt to protect it from damage. The equipment will be re-installed
            at no cost upon arrival.</li>

      </ol>
     </p>

         
</div>
</div>





        <div class="row" style="margin-top: 10px; margin-bottom: 25px;">
            <table style="width: 100%;">
                <tr style="height: 45px; text-align: left;">
                    <td style="padding-left: 10px; font-size: 14px;" >Agreed to this on '.$row["agreement_date"].' in the presence of '.$row["witness_name"].'
                    </td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px; margin-bottom: 50px;">
            <table style="width: 100%;">
                <tr style="height: 60px; text-align: center;">
                    <td style="text-align: center; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 400;"> -----------------------------------<br>
                        <span style="text-align: center;">Customer Signature</span></td>
                        
                        <td style="text-align: center; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 400;"> -----------------------------------<br>
                        <span style="text-align: center;">Customer Witness Signature</span></td>

                        <td style="text-align: center; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 400;"> -----------------------------------<br>
                        <span style="text-align: center;">I-World Representative</span></td>
                            </tr>
            </table>
        </div>

        <div class="row" style="margin-top: 10px;">
            <table class="" style="width: 100%;">
                <tr style="height: 20px; font-style: italic;">
                    <td class="formField" style="text-align: center;"> I-World Networks Customer Lease Agreement Form © 2021</td>
                </tr>
            </table>
        </div>
            
            
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

    // Create dataTable here

}



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function to create equipment change order form
function createEquipmentChangeOrderForm(){
    global $dbc;

        $customer_name = $_POST['customer_name'];
        $customer_address = $_POST['customer_address'];
        $customer_email = $_POST['customer_email'];
        $customer_phone = $_POST['customer_phone'];
        $equipment_removed = $_POST['equipment_removed'];
        $equipment_replaced = $_POST['equipment_replaced'];
        $equipment_change_date = $_POST['equipment_change_date'];
        $equipment_change_time = $_POST['equipment_change_time'];
        $change_requested_by = $_POST['change_requested_by'];
        $technician_name = $_POST['technician_name'];
        $technician_id = $_POST['technician_id'];
        $technician_activity_details = $_POST['technician_activity_details'];
        $remarks = $_POST['remarks'];
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
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', 'Created a new internet service change order form for $customer_name')";

            $insertChangeOrderForm = "INSERT INTO equipment_change_order_form (customer_name, customer_address, customer_email, customer_phone, equipment_removed, equipment_replaced, equipment_change_date, equipment_change_time, change_requested_by, technician_name, technician_id, technician_activity_details, remarks, form_id, date_submitted) 
            VALUES ('$customer_name', '$customer_address', '$customer_email', '$customer_phone', '$equipment_removed', '$equipment_replaced', '$equipment_change_date', '$equipment_change_time', '$change_requested_by', '$technician_name', '$technician_id', '$technician_activity_details', '$remarks', '$randomUID', '$date')";
            $doInsertChangeOrderForm = mysqli_query($dbc, $insertChangeOrderForm);
            $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!","Equipment change order form for '.$customer_name.' created successfully. Click OK to view form data","success").then( () => {
    location.href = "equipment-change-record"});';
            echo '}, 1000);
            </script>';        


            // echo json_encode($doInsertCategoryName);


        }


// Function to manage equipment change order form
function manageEquipmentChangeOrderForm(){
    global $dbc;
    $selectEquipmentChangeOrderData = "SELECT * FROM equipment_change_order_form ORDER BY id DESC";
    $doSelectEquipmentChangeOrderData = mysqli_query($dbc, $selectEquipmentChangeOrderData);
    $checkIfNotEmpty = mysqli_num_rows($doSelectEquipmentChangeOrderData);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
        <table id="equipmentChangeOrderData" class="table table-striped">
        <thead style="font-size:12px;">
            <tr>
                <th>SN</th>
                <th>Customer Name</th>
                <th>Customer Address</th>
                <th>Customer Email</th>
                <th style="width: 20%;">Action</th>
            </tr>
        </thead>
        <tfoot style="font-size:12px;">
            <tr>
            <th>SN</th>
            <th>Customer Name</th>
            <th>Customer Address</th>
            <th>Customer Email</th>
            <th style="width: 20%;">Action</th>
</tr>
        </tfoot>
        ';
        while($row = mysqli_fetch_array($doSelectEquipmentChangeOrderData))
        
        {
            $sn++;
            $ecId = $row["id"];
            $customerName = $row["customer_name"];

            // Create Random Unique Id
            $randomUID = md5(microtime(true).mt_Rand());

            echo '
            <tr style="font-size:12px;">
            <td> '.$sn.' </td>
            <td> '.$row["customer_name"].' </td>
            <td> '.$row["customer_address"].' </td>
            <td> '.$row["customer_email"].' </td>
            <td><a href="view-equipment-change-order-form?form_id='.$row["id"].'&form_ref='.$randomUID.'" target=_blank class="btn btn-sm btn-primary"><i class="ion-ios-eye"></i></a>
            <a href="edit-equipment-change-order-form?id='.$row["id"].'" class="btn btn-sm btn-info" ><i class="ion-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="delete-equipment-change-order-form" data-id="'.$ecId.'"><i class="ion-trash-a"></i></a>
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
  

// Function to print equipment change order form 
function equipmentChangeOrderForm($form_id){
    global $dbc;
    $selectEquipmentChangeOrderRecord = "SELECT * FROM equipment_change_order_form WHERE id = '$form_id'";
    $doSelectEquipmentChangeOrderRecord = mysqli_query($dbc, $selectEquipmentChangeOrderRecord);
    $checkIfNotEmpty = mysqli_num_rows($doSelectEquipmentChangeOrderRecord);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
      <div class="container mt-0" id="equipmentChangeOrderForm">
        ';
        while($row = mysqli_fetch_array($doSelectEquipmentChangeOrderRecord))
        
        {
            $sn++;
            $changeId = $row["id"];
            $customerName = $row["customer_name"];
            // $currentPrice = number_format($row["current_plan_price"],2);

            echo '
            <div class="row" style=margin-bottom: 10px;">
            <table style="width: 100%;">
                <tr style="height: 80px; text-align: right; color: #FFFFFF; font-family: Georgia, Times New Roman, Times, serif; font-size: 11px; font-weight: 300;">
                    <td> <img src="./../dist/img/I-World Networks Logo.fw.png" alt="I-World Networks Logo"><br>
                    <i><span style="text-align: right; color: #9CCA48;"> The Best Fixed Wireless Broadband in Nigeria &nbsp;&nbsp;</span></i></td>
                </tr>
            </table>
        </div>


        <div class="row">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 80px; text-align: center; padding: 40px 0px 40px 0px; background-color: #9CCA48; color: #FFFFFF; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 700;">
                    <td> <h4>CHANGE ORDER FOR EQUIPMENT</h4></td>
                </tr>
                <tr style="height: 40px; text-align: center; text-transform: uppercase; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 600;">
                    <td>section a: equipment replacement</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Customer Name:</td>
                    <td style="padding-left: 10px;">'.$row["customer_name"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Customer Address:</td>
                    <td style="padding-left: 10px;">'.$row["customer_address"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Customer Email(s):</td>
                    <td style="padding-left: 10px;">'.$row["customer_email"].'</td>
                </tr>
            </table>
        </div>

        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Customer Phone(s):</td>
                    <td style="padding-left: 10px;">'.$row["customer_phone"].'</td>
                </tr>
            </table>
        </div>

        
        <div class="row" style="margin-top: 0px;">
        <table class="table-bordered" style="width: 100%;">
            <tr style="height: 35px; text-align: left;">
                <td class="formField"> Equipment Removed (Type, MAC/MODEL):</td>
                <td style="padding-left: 10px;">'.$row["equipment_removed"].'</td>
            </tr>
        </table>
    </div>

    <div class="row" style="margin-top: 0px;">
    <table class="table-bordered" style="width: 100%;">
        <tr style="height: 35px; text-align: left;">
            <td class="formField"> Equipment Replaced (Type, MAC/MODEL):</td>
            <td style="padding-left: 10px;">'.$row["equipment_replaced"].'</td>
        </tr>
    </table>
</div>

<div class="row" style="margin-top: 0px;">
<table class="table-bordered" style="width: 100%;">
    <tr style="height: 35px; text-align: left;">
        <td class="formField"> Date of Equipment Change:</td>
        <td style="padding-left: 10px;">'.$row["equipment_change_date"].'</td>
    </tr>
</table>
</div>

<div class="row" style="margin-top: 0px;">
<table class="table-bordered" style="width: 100%;">
    <tr style="height: 35px; text-align: left;">
        <td class="formField"> Time of Equipment Change:</td>
        <td style="padding-left: 10px;">'.$row["equipment_change_time"].'</td>
    </tr>
</table>
</div>

<div class="row" style="margin-top: 0px;">
<table class="table-bordered" style="width: 100%;">
    <tr style="height: 35px; text-align: left;">
        <td class="formField"> Change requested by:</td>
        <td style="padding-left: 10px;">'.$row["change_requested_by"].'</td>
    </tr>
</table>
</div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 40px; text-align: center; text-transform: uppercase; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 600;">
                    <td>section b: account technician&#39;s details</td>
                </tr>
            </table>
        </div>
        

        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Technician’s Name:</td>
                    <td style="padding-left: 10px;">'.$row["technician_name"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Technician’s ID Number:</td>
                    <td style="padding-left: 10px;">'.$row["technician_id"].'</td>
                </tr>
            </table>
        </div>

        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> Technician’s Activity Details:</td>
                    <td style="padding-left: 10px;">'.$row["technician_activity_details"].'</td>
                </tr>
            </table>
        </div>

        <div class="row" style="margin-top: 0px; margin-bottom: 30px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 50px; text-align: center;">
                    <td style="padding-left: 10px; text-align: left; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 600;"> Remarks: <span style="padding-left: 1px; font-weight: normal;">'.$row["remarks"].'</span></td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px; margin-bottom: 20px;">
            <table style="width: 100%;">
                <tr style="height: 60px; text-align: center;">
                    <td style="text-align: center; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 400;"> ------------------------------------------------------<br>
                        <span style="text-align: center;">Customer Signature and Date</span></td>
                    <td style="text-align: center; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 400;"> ------------------------------------------------------<br>
                    <span style="text-align: center;">I-World Representative Signature and Date</span></td>
                </tr>
            </table>
        </div>
            
            
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

    // Create dataTable here

}



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