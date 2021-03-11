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
            $insertUserHistory = "INSERT INTO app_history (email, action) VALUES ('$getEmail', 'Submitted a new internet service order form for $f_name')";

            $insertIPOrderForm = "INSERT INTO internet_service_order_form (f_name, h_address, phone, email, web_address, cp_name, cp_phone, cp_email, cpb_name, cpb_phone, cpb_email, plan, non_recurrent_cost, installation_date, official_info, form_id) 
            VALUES ('$f_name', '$h_address', '$phone', '$email', '$web_address', '$cp_name', '$cp_phone', '$cp_email', '$cpb_name', '$cpb_phone', '$cpb_email', '$plan', '$non_recurrent_cost', '$installation_date', '$official_info', '$randomUID')";
            $doIPOrderForm = mysqli_query($dbc, $insertIPOrderForm);
            $doInsertUserHistory = mysqli_query($dbc, $insertUserHistory);

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal.fire("Success!"," Form Submitted Successfully","success");';
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

?>