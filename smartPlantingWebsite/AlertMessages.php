<?php
 include_once "classDatabase.php";

 class AlertMessages
 {
     public static function AlertMeassage($icon,$Title)
     {
            echo '<!DOCTYPE html>
            <html>
             <head>
              <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
              <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
             </head>
             <body>
              <script>
              swal({ type:"'.$icon.'",title: "'.$Title.'"});
              </script>
              </body>
            </html>
            ';
           
     }
     
   //   public static function failed()
   //   {
   //      echo'<html lang="en">
   //      <head>
   //      <meta charset="utf-8">
   //      <meta http-equiv="x-ua-compatible" content="ie=edge">
   //      <title>Alert - srtdash</title>
   //      <meta name="viewport" content="width=device-width, initial-scale=1">
   //      <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
   //      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   //      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
   //      <link rel="stylesheet" href="assets/css/themify-icons.css">
   //      <link rel="stylesheet" href="assets/css/metisMenu.css">
   //      <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
   //      <!-- amcharts css -->
   //      <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
   //      <!-- style css -->
   //      <link rel="stylesheet" href="assets/css/typography.css">
   //      <link rel="stylesheet" href="assets/css/default-css.css">
   //      <link rel="stylesheet" href="assets/css/styles.css">
   //      <link rel="stylesheet" href="assets/css/responsive.css">
   //      <!-- modernizr css -->
   //      <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
   //       </head>
   //       <body>
   //      <div class="alert alert-danger" role="alert" >
   //         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   //         <h4 class="alert-heading">Somthing went wrong Please check again!</h4>
   //     </div>
   //        </body>
   //        </html>';
   //   }
   //   public static function repeateddata()
   //   {
   //      echo'<html lang="en">
   //      <head>
   //      <meta charset="utf-8">
   //          <meta http-equiv="x-ua-compatible" content="ie=edge">
   //          <title>Alert - srtdash</title>
   //          <meta name="viewport" content="width=device-width, initial-scale=1">
   //          <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
   //          <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   //          <link rel="stylesheet" href="assets/css/font-awesome.min.css">
   //          <link rel="stylesheet" href="assets/css/themify-icons.css">
   //          <link rel="stylesheet" href="assets/css/metisMenu.css">
   //          <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
   //          <!-- amcharts css -->
   //          <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
   //          <!-- style css -->
   //          <link rel="stylesheet" href="assets/css/typography.css">
   //          <link rel="stylesheet" href="assets/css/default-css.css">
   //          <link rel="stylesheet" href="assets/css/styles.css">
   //          <link rel="stylesheet" href="assets/css/responsive.css">
   //          <!-- modernizr css -->
   //          <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
   //        </head>
   //       <body>
   //      <div class="alert alert-danger" role="alert" >
   //         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   //         <h4 class="alert-heading">Already Exits </h4>
   //     </div>
   //        </body>
   //        </html>';
   //   }
   //   public static function CheckPass()
   //   {
   //      echo'<html lang="en">
   //      <head>
   //      <meta charset="utf-8">
   //      <meta http-equiv="x-ua-compatible" content="ie=edge">
   //      <title>Alert - srtdash</title>
   //      <meta name="viewport" content="width=device-width, initial-scale=1">
   //      <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
   //      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   //      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
   //      <link rel="stylesheet" href="assets/css/themify-icons.css">
   //      <link rel="stylesheet" href="assets/css/metisMenu.css">
   //      <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
   //      <!-- amcharts css -->
   //      <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
   //      <!-- style css -->
   //      <link rel="stylesheet" href="assets/css/typography.css">
   //      <link rel="stylesheet" href="assets/css/default-css.css">
   //      <link rel="stylesheet" href="assets/css/styles.css">
   //      <link rel="stylesheet" href="assets/css/responsive.css">
   //      <!-- modernizr css -->
   //      <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
   //       </head>
   //       <body>
   //      <div class="alert alert-danger" role="alert" >
   //         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   //         <h4 class="alert-heading"> Confromed password is not the same as the original password </h4>
   //     </div>
   //        </body>
   //        </html>';
   //   }
     
     
 }


?>