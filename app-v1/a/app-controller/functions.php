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
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', 'Created a new enterprise internet service order form for $f_name')";

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


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function to create work order form
function createWorkOrderForm(){
    global $dbc;

        $title = $_POST['title'];
        $start_date = $_POST['start_date'];
        $delivery_date = $_POST['delivery_date'];
        $project_overview = $_POST['project_overview'];
        $required_tools = $_POST['required_tools'];
        $standard_instruction = $_POST['standard_instruction'];
        $budget_url = $_POST['budget_url'];
        $installation_report_url = $_POST['installation_report_url'];
        $pick_up_time = $_POST['pick_up_time'];
        $pre_visit = $_POST['pre_visit'];
        $on_site = $_POST['on_site'];
        $taskCheckList1 = implode(',', $pre_visit);
        $taskCheckList2 = implode(',', $on_site);
        $material_accessories_fee = $_POST['material_accessories_fee'];
        $work_order_fee = $_POST['work_order_fee'];
        $pm_name = $_POST['pm_name'];
        $pm_phone = $_POST['pm_phone'];
        $pm_email = $_POST['pm_email'];
        $pm_whatsapp = $_POST['pm_whatsapp'];
        $approved_by = $_POST['approved_by'];
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
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', 'Created a new work order form for $title $pm_name')";

            $insertWorkOrderForm = "INSERT INTO work_order_form (title, start_date, delivery_date, project_overview, required_tools, standard_instruction, budget_url, installation_report_url, pick_up_time, pre_visit, on_site, material_accessories_fee, work_order_fee, pm_name, pm_phone, pm_email, pm_whatsapp, approved_by, form_id, date_submitted) 
            VALUES ('$title', '$start_date', '$delivery_date', '$project_overview', '$required_tools', '$standard_instruction', '$budget_url', '$installation_report_url', '$pick_up_time', '" . $taskCheckList1 . "', '" . $taskCheckList2 . "', '$material_accessories_fee', '$work_order_fee', '$pm_name', '$pm_phone', '$pm_email', '$pm_whatsapp', '$approved_by', '$randomUID', '$date')";
            $doWorkOrderForm = mysqli_query($dbc, $insertWorkOrderForm);
            $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);

            // echo '<script type="text/javascript">';
            // echo 'setTimeout(function () { swal.fire("Success!"," Work order form for internet service created for '.$title.' '.$pm_name.'.","success");';
            // echo '}, 1000);</script>';

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!","Work order form for '.$title.' '.$pm_name.'. Click OK to view form data","success").then( () => {
    location.href = "work-order-record"});';
            echo '}, 1000);
            </script>';        
    
            // echo json_encode($doWorkOrderForm);


        }



// Function to manage work order form
function manageWorkOrderForm(){
    global $dbc;
    $selectWorkOrderFormData = "SELECT * FROM work_order_form ORDER BY id DESC";
    $doSelectWorkOrderFormData = mysqli_query($dbc, $selectWorkOrderFormData);
    $checkIfNotEmpty = mysqli_num_rows($doSelectWorkOrderFormData);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
        <table id="workOrderFormData" class="table table-striped">
        <thead style="font-size:12px;">
            <tr>
                <th>SN</th>
                <th>Project Manager</th>
                <th>Start Date</th>
                <th>Delivery Date</th>
                <th style="width: 20%;">Action</th>
            </tr>
        </thead>
        <tfoot style="font-size:12px;">
            <tr>
            <th>SN</th>
            <th>Project Manager</th>
            <th>Start Date</th>
            <th>Delivery Date</th>
        <th style="width: 20%;">Action</th>
</tr>
        </tfoot>
        ';
        while($row = mysqli_fetch_array($doSelectWorkOrderFormData))
        
        {
            $sn++;
            $wId = $row["id"];
            $pmName = $row["pm_name"];

            // Create Random Unique Id
            $randomUID = md5(microtime(true).mt_Rand());

            echo '
            <tr style="font-size:12px;">
            <td> '.$sn.' </td>
            <td> '.$row["title"].'&nbsp;'.$row["pm_name"].' </td>
            <td> '.$row["start_date"].' </td>
            <td> '.$row["delivery_date"].' </td>
            <td><a href="view-work-order-form?form_id='.$row["id"].'&form_ref='.$randomUID.'" target=_blank class="btn btn-sm btn-primary"><i class="ion-ios-eye"></i></a>
            <a href="edit-work-order-form?id='.$row["id"].'" class="btn btn-sm btn-info" ><i class="ion-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="delete-work-order-form" data-id="'.$wId.'"><i class="ion-trash-a"></i></a>
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


// Function to view work order form
function workOrderForm($form_id){
    global $dbc;
    $selectWorkOrderFormRecord = "SELECT * FROM work_order_form WHERE id = '$form_id'";
    $doSelectWorkOrderFormRecord = mysqli_query($dbc, $selectWorkOrderFormRecord);
    $checkIfNotEmpty = mysqli_num_rows($doSelectWorkOrderFormRecord);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
      <div class="container mt-0" id="workOrderForm">
        ';
        while($row = mysqli_fetch_array($doSelectWorkOrderFormRecord))
        
        {
            $sn++;
            $wId = $row["id"];
            $pmName = $row["pm_name"];
            $materialAccessoriesFee = number_format($row["material_accessories_fee"],2);
            $workOrderFee = number_format($row["work_order_fee"],2);

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
                    <td> <h4>WORK ORDER FORM</h4></td>
                </tr>
                <tr style="height: 40px; text-align: left; background-color: #DCDADB; text-transform: uppercase; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 600;">
                    <td style="padding-left: 10px !important;">project manager details</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> NAME: '.$row["title"].'&nbsp;'.$row["pm_name"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
            <tr style="height: 35px; text-align: left;">
            <td class="formField"> PHONE NUMBER: '.$row["pm_phone"].'</td>
        </tr>

                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> EMAIL ADDRESS: '.$row["pm_email"].'</td>
                </tr>

                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> WHATSAPP: '.$row["pm_whatsapp"].'</td>
                </tr>

                </table>
        </div>

        <div class="row">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 40px; text-align: left; background-color: #DCDADB; text-transform: uppercase; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 600;">
                    <td style="padding-left: 10px !important;">project details</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
            <tr style="height: 35px; text-align: left;">
                <td class="formField"> START DATE: '.$row["start_date"].'</td>
            </tr>

            <tr style="height: 35px; text-align: left;">
                <td class="formField"> DELIVERY DATE: '.$row["delivery_date"].'</td>
            </tr>

            <tr style="height: 35px; text-align: left;">
                <td class="formField"> PROJECT OVERVIEW: '.$row["project_overview"].'</td>
            </tr>

            <tr style="height: 35px; text-align: left;">
            <td class="formField"> REQUIRED TOOLS: '.$row["required_tools"].'</td>
            </tr>

            <tr style="height: 35px; text-align: left;">
            <td class="formField"> STANDARD INSTRUCTION: '.$row["standard_instruction"].'</td>
            </tr>

            <tr style="height: 35px; text-align: left;">
            <td class="formField"> <span style="text-transform: uppercase;">Link Budget & Installation Design URL:</span> '.$row["budget_url"].'</td>
            </tr>

            <tr style="height: 35px; text-align: left;">
            <td class="formField"> <span style="text-transform: uppercase;">Installation Report URL:</span> '.$row["installation_report_url"].'</td>
            </tr>

            <tr style="height: 35px; text-align: left;">
            <td class="formField"> <span style="text-transform: uppercase;"> Equipment Pick Up time:</span> '.$row["pick_up_time"].'</td>
            </tr>

            </table>
        </div>


        <div class="row">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 40px; text-align: left; background-color: #DCDADB; text-transform: uppercase; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 600;">
                    <td style="padding-left: 10px !important;">task checklist</td>
                </tr>
            </table>
        </div>

        

        <div class="row" style="margin-top: 0px;">
        <table class="table-bordered" style="width: 100%;">
        <tr style="height: 35px; text-align: left;">
            <td class="formField"> PRE-VISIT: '.$row["pre_visit"].'</td>
        </tr>

        <tr style="height: 35px; text-align: left;">
            <td class="formField"> ON SITE: '.$row["on_site"].'</td>
        </tr>

        </table>
        </div>


        <div class="row">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 40px; text-align: left; background-color: #DCDADB; text-transform: uppercase; font-family: Georgia, Times New Roman, Times, serif; font-size: 16px; font-weight: 600;">
                    <td style="padding-left: 10px !important;">FEES</td>
                </tr>
            </table>
        </div>

        

        <div class="row" style="margin-top: 0px;">
        <table class="table-bordered" style="width: 100%;">
        <tr style="height: 35px; text-align: left;">
            <td class="formField"> <span style="text-transform: uppercase;"> Materials & Accessories:</span> &#8358;'.number_format($row["material_accessories_fee"],2).'</td>
        </tr>

        <tr style="height: 35px; text-align: left;">
            <td class="formField"> <span style="text-transform: uppercase;"> Work order Fee:</span> &#8358;'.number_format($row["work_order_fee"],2).' </td>
        </tr>

        <tr style="height: 35px; text-align: left;">
            <td class="formField"> <span style="text-transform: uppercase;"> APPROVED  BY:</span> '.$row["approved_by"].'</td>
        </tr>

        
        <div style="margin-bottom: 120px;"></div>
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


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function to create installation completion form
function createInstallationCompletionForm(){
    global $dbc;

        $customer_name = $_POST['customer_name'];
        $customer_address = $_POST['customer_address'];
        $customer_sub_details = $_POST['customer_sub_details'];
        $station_radio_type = $_POST['station_radio_type'];
        $router_type = $_POST['router_type'];
        $installation_type = $_POST['installation_type'];
        $surge_protector_available = $_POST['surge_protector_available'];
        $power_backup_available = $_POST['power_backup_available'];
        $associated_ap = $_POST['associated_ap'];
        $signal_level = $_POST['signal_level'];
        $link_ccq = $_POST['link_ccq'];
        $tx = $_POST['tx'];
        $rx = $_POST['rx'];
        $downlink = $_POST['downlink'];
        $uplink = $_POST['uplink'];
        $lan_speed = $_POST['lan_speed'];
        $customer_portal_activation_status = $_POST['customer_portal_activation_status'];
        $customer_training_status = $_POST['customer_training_status'];
        $app_mgt_status = $_POST['app_mgt_status'];
        $password_change_status = $_POST['password_change_status'];
        $downlink = $_POST['downlink'];

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
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', 'Created a new installation completion form for $customer_name')";

            $insertInstallationCompletionForm = "INSERT INTO installation_completion_form (customer_name, customer_address, customer_sub_details, station_radio_type, router_type, installation_type, surge_protector_available, power_backup_available, associated_ap, signal_level, link_ccq, tx, rx, downlink, uplink, lan_speed, customer_portal_activation_status, customer_training_status, app_mgt_status, password_change_status, form_id, date_submitted) 
            VALUES ('$customer_name', '$customer_address', '$customer_sub_details', '$station_radio_type', '$router_type', '$installation_type', '$surge_protector_available', '$power_backup_available', '$associated_ap', '$signal_level', '$link_ccq', '$tx', '$rx', '$downlink', '$uplink', '$lan_speed', '$customer_portal_activation_status', '$customer_training_status', '$app_mgt_status', '$password_change_status', '$randomUID', '$date')";
            $doInstallationCompletionForm = mysqli_query($dbc, $insertInstallationCompletionForm);
            $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);

            // echo '<script type="text/javascript">';
            // echo 'setTimeout(function () { swal.fire("Success!"," Work order form for internet service created for '.$title.' '.$pm_name.'.","success");';
            // echo '}, 1000);</script>';

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!","Installation completion certification form for '.$customer_name.' created successfully. Click OK to view form data","success").then( () => {
    location.href = "installation-completion-record"});';
            echo '}, 1000);
            </script>';        
    
            // echo json_encode($doWorkOrderForm);


        }


// Function to manage installation completion form
function manageInstallationCompletionForm(){
    global $dbc;
    $selectInstallationCompletionData = "SELECT * FROM installation_completion_form ORDER BY id DESC";
    $doSelectInstallationCompletionData = mysqli_query($dbc, $selectInstallationCompletionData);
    $checkIfNotEmpty = mysqli_num_rows($doSelectInstallationCompletionData);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
        <table id="installationCompletionData" class="table table-striped">
        <thead style="font-size:12px;">
            <tr>
                <th>SN</th>
                <th>Customer Name</th>
                <th>Customer Address</th>
                <th>LAN Speed</th>
                <th style="width: 20%;">Action</th>
            </tr>
        </thead>
        <tfoot style="font-size:12px;">
            <tr>
            <th>SN</th>
            <th>Customer Name</th>
            <th>Customer Address</th>
            <th>LAN Speed</th>
        <th style="width: 20%;">Action</th>
</tr>
        </tfoot>
        ';
        while($row = mysqli_fetch_array($doSelectInstallationCompletionData))
        
        {
            $sn++;
            $iId = $row["id"];
            $customerName = $row["customer_name"];

            // Create Random Unique Id
            $randomUID = md5(microtime(true).mt_Rand());

            echo '
            <tr style="font-size:12px;">
            <td> '.$sn.' </td>
            <td> '.$row["customer_name"].' </td>
            <td> '.$row["customer_address"].' </td>
            <td> '.$row["lan_speed"].' </td>
            <td><a href="view-installation-completion-form?form_id='.$row["id"].'&form_ref='.$randomUID.'" target=_blank class="btn btn-sm btn-primary"><i class="ion-ios-eye"></i></a>
            <a href="edit-installation-completion-form?id='.$row["id"].'" class="btn btn-sm btn-info" ><i class="ion-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="delete-installation-completion-form" data-id="'.$iId.'"><i class="ion-trash-a"></i></a>
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


// Function to view installation completion form
function installationCompletionForm($form_id){
    global $dbc;
    $selectInstallationCompletionFormRecord = "SELECT * FROM installation_completion_form WHERE id = '$form_id'";
    $doSelectInstallationCompletionFormRecord = mysqli_query($dbc, $selectInstallationCompletionFormRecord);
    $checkIfNotEmpty = mysqli_num_rows($doSelectInstallationCompletionFormRecord);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
      <div class="container mt-0" id="installationCompletionForm">
        ';
        while($row = mysqli_fetch_array($doSelectInstallationCompletionFormRecord))
        
        {
            $sn++;
            $iId = $row["id"];
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
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 40px; text-align: center; padding: 30px 0px 20px 0px; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 700;">
                    <td> <h4>Installation Completion Certification Form</h4></td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                <td class="formField" style=" width: 10%;"> Customer Name</td>
                <td class="formField" width="80%">'.$row["customer_name"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
            <tr style="height: 35px; text-align: left;">
            <td class="formField" style=" width: 10%;"> Address</td>
            <td class="formField"> '.$row["customer_address"].'</td>
        </tr>
        </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField" style=" width: 10%;"> Customer Subscription Details</td>
                    <td class="formField"> '.$row["customer_sub_details"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField" style=" width: 20%;"> Equipment Details</td>
                    <td class="formField"> Type of Station Radio with MAC :- '.$row["station_radio_type"].'</td>
                    <td class="formField"> Type of Router with MAC :- '.$row["router_type"].'</td>
                </tr>
            </table>
        </div>

        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField" style=" width: 10%;"> Type of Installation</td>
                    <td class="formField"> '.$row["installation_type"].'</td>
                </tr>
            </table>
        </div>


        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField" style=" width: 20%;"> Power Status</td>
                    <td class="formField"> Type of Surge Protector Available Onsite :- '.$row["surge_protector_available"].'</td>
                    <td class="formField"> Type of Power Backup Available Onsite :- '.$row["power_backup_available"].'</td>
                </tr>
            </table>
        </div>

        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField" style=" width: 20%;"> Installation Baseline Parameter</td>
                    <td class="formField" style=" width: 10%;"> Associated AP :- '.$row["associated_ap"].'</td>
                    <td class="formField" style=" width: 10%;"> Signal Level :- '.$row["signal_level"].'</td>
                    <td class="formField" style=" width: 10%;"> Link CCQ :- '.$row["link_ccq"].'</td>
                    <td class="formField" style=" width: 15%; text-align: left;">
                        <div >
                            <table class="table-bordered" style=" width: 100%;">
                                <tr style="height: 35px; text-align: left; colspan="2">
                                    <td colspan="2"> Radio Capacity</td>
                                </tr>
                                <tr style="height: 35px; text-align: left;">
                                    <td>TX:- '.$row["tx"].'</td>
                                    <td>RX:- '.$row["rx"].'</td>
                                </tr>
                            </table>
                        </div> 
                    </td>
                    <td class="formField" style=" width: 15%;">
                        <div >
                            <table class="table-bordered">
                                <tr style="height: 35px; text-align: left; colspan="2">
                                    <td colspan="2"> Speed Test</td>
                                </tr>
                                <tr style="height: 35px; text-align: left;">
                                    <td>Downlink:- '.$row["downlink"].'</td>
                                    <td>Uplink:- '.$row["uplink"].'</td>
                                </tr>
                            </table>
                        </div> 
                    </td>
                    <td class="formField" style=" width: 15%;">
                    <div >
                    <table class="table-bordered" style=" width: 100%;">
                        <tr style="height: 35px; text-align: left;">
                            <td> LAN Speed</td>
                        </tr>
                        <tr style="height: 35px; text-align: left;">
                            <td>'.$row["lan_speed"].'</td>
                        </tr>
                    </table>
                </div> 
            </td>
                </tr>
            </table>
        </div>
        
        <div class="row" style="margin-top: 0px;">
            <table class="table-bordered" style="width: 100%;">
                <tr style="height: 35px; text-align: left;">
                    <td class="formField"> <h5>User Onboarding Process Checklist:</h5></td>
                    
                </tr>
            </table>
        </div>

        <div class="row" style="margin-top: 0px;">
        <table class="table-bordered" style="width: 100%;">
            <tr style="height: 35px; text-align: left;">
                <td class="formField"><span style="font-weight: 700; font-size: 18px;">o</span> Is customer account portal activated? <span style="border: 2px solid #DFDFDF; padding: 5px;">'.$row["customer_portal_activation_status"].'</span></td>
                
            </tr>
            <tr style="height: 35px; text-align: left;">
            <td class="formField"> <span style="font-weight: 700; font-size: 18px;">o</span> Has the customer been enlightened on how to make use of the account portal to pay invoice, check his usage, send email for support request, etc.? <span style="border: 2px solid #DFDFDF; padding: 5px;">'.$row["customer_training_status"].'</span></td>
            
        </tr>
        <tr style="height: 35px; text-align: left;">
        <td class="formField"> <span style="font-weight: 700; font-size: 18px;">o</span> Is the wireless app management of the router installed for customer? <span style="border: 2px solid #DFDFDF; padding: 5px;">'.$row["app_mgt_status"].'</span></td>
        
    </tr>
    <tr style="height: 35px; text-align: left;">
        <td class="formField"> <span style="font-weight: 700; font-size: 18px;">o</span> Can the customer change his/her wireless password? <span style="border: 2px solid #DFDFDF; padding: 5px;">'.$row["password_change_status"].'</span></span></td>
        
    </tr>
        </table>
    </div>

<div class="row" style="margin-top: 0px;">
<table class="table-bordered" style="width: 100%;">
    <tr style="height: 35px; text-align: left;">
        <td > 
        <h5 style="padding-left: 10px;">User Precautionary Tips Of Getting The Best Out Of Your Internet</h5>
        <span style="font-size: 12px !important;font-weight: 500;">
        <ul >
        <li>
        Your wireless password is like the key to your home. Always protect it and its advisable you change it often.
        </li>
        <li>
        When using your internet for streaming ensure no other heavy activity like downloading is done on the internet for you to get the best of streaming experience.
        </li>
        <li>
        Always ensure your computer is connected with the LAN cable during live streaming and ensure you restrict other internet users during your live streaming session.
        </li>
        <li>
        Are you using your Internet for business? Be in charge of your internet by effective management of all your users. Assign independent login and Bandwidth to each user. Request for a bandwidth management device to enjoy this feature.
        </li>
        <li>
        Are you using your Internet for business? Be in charge of your internet by effective management of all your users. Assign independent login and Bandwidth to each user. Request for a bandwidth management device to enjoy this feature.
        </li>
        </ul>
        </span>

        
        
        </td>
    </tr>
</table>
</div>

<div class="row" style="margin-top: 0px;">
<table class="table-bordered" style="width: 100%;">
    <tr style="height: 35px; text-align: left;">
        <td class="formField"> This is to certify that the installation has been done and completed and all information herein are correctly captured.<br>
        I hereby confirm that the internet meets my expectation and my internet need.</td>
        
    </tr>
</table>
</div>

<div class="row" style="margin-top: 40px; margin-bottom: 10px;">
<table style="width: 100%;">
    <tr style="height: 50px; text-align: center;">
        <td style="text-align: center; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 400;"> ------------------------------------------------------<br>
            <span style="text-align: center;">Customer Signature | Date</span></td>
        <td style="text-align: center; font-family: Georgia, Times New Roman, Times, serif; font-size: 14px; font-weight: 400;"> ------------------------------------------------------<br>
        <span style="text-align: center;">Installer Signature | Date</span></td>
    </tr>
</table>
</div>

        
        <div style="margin-bottom: 30px;"></div>
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


////////////////////////////////////// OTHER APP FUNCTIONS //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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


// Function to show internet subscription records
function manageInternetSubscriptions(){
    global $dbc;
    $selectSubscriptionData = "SELECT * FROM subscription ORDER BY id DESC";
    $doSelectSubscriptionData = mysqli_query($dbc, $selectSubscriptionData);
    $checkIfNotEmpty = mysqli_num_rows($doSelectSubscriptionData);

    $sn = 0;

    if($checkIfNotEmpty > 0){
        echo '
        <table id="enterpriseOrderFormData" class="table table-striped">
        <thead style="font-size:12px;">
            <tr>
                <th>SN</th>
                <th>Customer Account Name</th>
                <th>Invoice No.</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tfoot style="font-size:12px;">
            <tr>
            <th>SN</th>
            <th>Customer Account Name</th>
            <th>Invoice No.</th>
            <th>Email</th>
            <th>Amount</th>
            <th>Date</th>
</tr>
        </tfoot>
        ';
        while($row = mysqli_fetch_array($doSelectSubscriptionData))
        
        {
            $sn++;
            $subId = $row["id"];
            $customer_account_name = $row["customer_account_name"];

            // Create Random Unique Id
            $randomUID = md5(microtime(true).mt_Rand());

            echo '
            <tr style="font-size:12px;">
            <td> '.$sn.' </td>
            <td> '.$row["customer_account_name"].' </td>
            <td> '.$row["invoice_number"].' </td>
            <td> '.$row["email"].' </td>
            <td> '.$row["amount"].' </td>
            <td> '.$row["date_paid"].' </td>
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
        No Internet Subscription Record Data to show!
        </div>
        </div>
        ';

    }


}




//Logout Text Function
function logoutText(){
    $text = "Copyright &copy; 2021 <div class=bullet></div> <a href=https://iwn.ng>I-World Networks</a>";
    echo "$text";
    
}

//Logout Function
// function logout(){
//     global $connection;
//     $logoutQuery = "SELECT * FROM users WHERE user_id='$id_session'";
//     $doLogoutQuery = mysqli_query($dbc, $logoutQuery);
//     $row=mysqli_fetch_array($doLogoutQuery);
//     $getUser = $row['username'];

//     date_default_timezone_set('Africa/Lagos');
//     $date = date('M d, Y h:ia', time());

//     session_start();
//     session_destroy();

//     //Insert Logout Action By User to app history database
//     $insertLogoutHistoryQuery = "INSERT INTO app_history (date, action, user) VALUES ('$date', '$getUser Logged Out', '$getUser')";

//     $doInsertLogoutHistoryQuery = mysqli_query($dbc, $insertLogoutHistoryQuery);

//     //Perform Logout Action
//     if(!$doInsertLogoutHistoryQuery){
//         die("MySQL Query Failed" . mysqli_error($dbc));

//     }
//     else{
//         header('location:./app-home');

//     }

    

// }

?>