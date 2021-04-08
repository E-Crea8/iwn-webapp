<?php
    include ('./app-controller/functions.php');
    $form_id = $_GET['form_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <!-- Shortcut Icon -->
  <link rel="shortcut icon" href="../../dist/img/favicon.fw.png">
  <title>IWN App - Equipment Change Order Form</title>

  <link rel="stylesheet" href="../dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

  <link rel="stylesheet" href="../dist/css/demo.css">
  <link rel="stylesheet" href="../dist/css/style.css">
  
  <link rel="stylesheet" href="../assets/sweetalert/css/sweetalert2.min.css">

  <!-- PDF JS SCRIPT -->
  <script src="../assets/PDF/equipmentChangeOrderGenPDF.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
  
  <style>
      .formField{
        width: 35%; 
        padding-left: 10px; 
        text-align: left; 
        font-family: Georgia, 'Times New Roman', Times, serif; 
        font-size: 12px; 
        font-weight: 600;
      }
  </style>
</head>

<body style="background-color: #FFFFFF !important;">
  <div id="app">
    <section class="section">
      <div class="container">

      <!-- Echo PHP Table Here -->
      <?php
        equipmentChangeOrderForm($form_id);
      ?>

        

    </div>

    <div class="text-center" style="margin-bottom: 20px;">
        <button class="btn btn-dark" id="downloadEquipmentChangeOrderFormPDF">Download PDF</button>
      </div>

    </section>
  </div>

  <!-- Sweet Alert -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="../assets/sweetalert/js/sweetalert2.min.js"></script>

  <script src="../dist/modules/jquery.min.js"></script>
  <script src="../dist/modules/popper.js"></script>
  <script src="../dist/modules/tooltip.js"></script>
  <script src="../dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../dist/modules/moment.min.js"></script>
  <script src="../dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="../dist/js/sa-functions.js"></script>
  
  <script src="../dist/js/scripts.js"></script>
  <script src="../dist/js/custom.js"></script>
  <!-- <script src="../dist/js/demo.js"></script> -->



</body>
</html> 