<?php

require('inc/dbcon.php');
require('session.php');

if (isset($_POST['login'])) {


  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $hashPassword = md5($password);
  $active_status = 1;
if ($hashPassword == ''){
     ?>    
                  
                  <script>
                    setTimeout(function () { 
                      swal.fire({
                        title: "Login Error!",
                        text: "Password is missing",
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                        className : "btn btn-danger",
                        confirmButtonText: "OK"
                      },
                      ); }, 1000); 
              </script>                 
                  
                  
     
                <!-- <script type="text/javascript">
                alert("Password is missing!");
                window.location = "../app-home";
                </script> -->
        <?php
}else{
//create some sql statement             
        $checkUserSql = "SELECT * FROM  users WHERE  email='" . $email . "' AND  password =  '" . $hashPassword . "'";
        $result = $dbc->query($checkUserSql);

        if ($result){
        //get the number of results based in the sql statement
        //check the number of result, if equal to one   
        //IF theres a result
            if ( $result->num_rows > 0) {
                //store the result to a array and passed to variable found_user
                $found_user  = mysqli_fetch_array($result);
                
                // Remember Me Action
                if(!empty($_POST["remember"])) {
                  setcookie ("email", $email, time()+ (10 * 365 * 24 * 60 * 60));  
                  setcookie ("password",	$password,	time()+ (10 * 365 * 24 * 60 * 60));
              } else {
                  setcookie ("email",""); 
                  setcookie ("password","");
              }

                //fill the result to session variable
                $_SESSION['user_id']  = $found_user['user_id']; 
                $_SESSION['firstname'] = $found_user['firstname']; 
                $_SESSION['lastname']  =  $found_user['lastname'];  
                $_SESSION['email']  =  $found_user['email'];
                $_SESSION['password']  =  $found_user['password'];
                $_SESSION['active_status']  =  $found_user['active_status']; 
                $_SESSION['department']  =  $found_user['department']; 
                $user = $_SESSION['user_id'];
                $getEmail = $_SESSION['email'];
                $dept = $_SESSION['department'];

        //login as super administrator if department is Super Admin
        if ($email == $_SESSION['email'] && $hashPassword == $_SESSION['password'] && $dept == 'Super Admin'){
          $userLoginHistory = "INSERT INTO app_history (id,email,action,date)VALUES(Null,'$getEmail','Logged In',Null)";
          mysqli_query($dbc,$userLoginHistory)or die ('Error in adding User Action to app history table');

          ?>    
             
             <?php

                  echo '
                  <script>
                  setTimeout(function () { 
                    swal.fire({
                      title: "Login Successful!",
                      text: "Welcome back, '.$_SESSION['firstname'].'",
                      icon: "success",
                      confirmButtonText: "Proceed to Dashboard"
                    }
                    )
                    .then(function (result) {
                      if (result.value) {
                          window.location = "./app-v1/sa/dashboard";
                      }
                  }); }, 1000); 
                    </script>                 
                  
                  ';
                      


            ?>

             <?php        
           
        }

        //login as  administrator if department is Admin
        if ($email == $_SESSION['email'] && $hashPassword == $_SESSION['password'] && $dept == 'Admin'){
          $userLoginHistory = "INSERT INTO app_history (id,email,action,date)VALUES(Null,'$getEmail','Logged In',Null)";
          mysqli_query($dbc,$userLoginHistory)or die ('Error in adding User Action to app history table');

          ?>    
             
             <?php

                  echo '
                  <script>
                  setTimeout(function () { 
                    swal.fire({
                      title: "Login Successful!",
                      text: "Welcome back, '.$_SESSION['firstname'].'",
                      icon: "success",
                      confirmButtonText: "Proceed to Dashboard"
                    }
                    )
                    .then(function (result) {
                      if (result.value) {
                          window.location = "./app-v1/a/dashboard";
                      }
                  }); }, 1000); 
                    </script>                 
                  
                  ';
                      


            ?>

             <?php        
           
        }


        //login as business if department is Business
        if ($email == $_SESSION['email'] && $hashPassword == $_SESSION['password'] && $dept == 'Business'){
          $userLoginHistory = "INSERT INTO app_history (id,email,action,date)VALUES(Null,'$getEmail','Logged In',Null)";
          mysqli_query($dbc,$userLoginHistory)or die ('Error in adding User Action to app history table');

          ?>    
             
             <?php

                  echo '
                  <script>
                  setTimeout(function () { 
                    swal.fire({
                      title: "Login Successful!",
                      text: "Welcome back, '.$_SESSION['firstname'].'",
                      icon: "success",
                      confirmButtonText: "Proceed to Dashboard"
                    }
                    )
                    .then(function (result) {
                      if (result.value) {
                          window.location = "./app-v1/b/dashboard";
                      }
                  }); }, 1000); 
                    </script>                 
                  
                  ';
                      


            ?>

             <?php        
           
        }        


        //login as business if department is Support
        if ($email == $_SESSION['email'] && $hashPassword == $_SESSION['password'] && $dept == 'Support'){
          $userLoginHistory = "INSERT INTO app_history (id,email,action,date)VALUES(Null,'$getEmail','Logged In',Null)";
          mysqli_query($dbc,$userLoginHistory)or die ('Error in adding User Action to app history table');

          ?>    
             
             <?php

                  echo '
                  <script>
                  setTimeout(function () { 
                    swal.fire({
                      title: "Login Successful!",
                      text: "Welcome back, '.$_SESSION['firstname'].'",
                      icon: "success",
                      confirmButtonText: "Proceed to Dashboard"
                    }
                    )
                    .then(function (result) {
                      if (result.value) {
                          window.location = "./app-v1/s/dashboard";
                      }
                  }); }, 1000); 
                    </script>                 
                  
                  ';
                      


            ?>

             <?php        
           
        }        
        
        elseif ($_SESSION['active_status']=='0'){
           
            ?>                        
            <script>
            setTimeout(function () { 
              swal.fire({
                title: "Login Error!",
                text: "You account is inactive. Contact the super administrator. ",
                icon: "error",
                confirmButtonColor: "#3085d6",
                className : "btn btn-danger",
                confirmButtonText: "OK"
              },
              ); }, 1000); 
              </script>                 

            <?php        
          
       }
            } else {
            //IF user is not active
              ?>
                <!-- <script type="text/javascript">
                alert("Username or Password is not correct.");
                window.location = "./app-home";
                </script> -->

                <?php


                    echo '
                    <script>
                    setTimeout(function () { 
                      swal.fire({
                        title: "Login Error!",
                        text: "Kindly check your login credentials. ",
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                        className : "btn btn-danger",
                        confirmButtonText: "Try again"
                      },
                      ); }, 1000); 
                      </script>                 

                     ';
  ?>          
                  
                  

              <?php

            }

         } else {
                 # code...
        echo "Error: " . $sql . "<br>" . $dbc->error;
        }
        
    }       
} 
 $dbc->close();
?>