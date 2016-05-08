<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/jquery-ui.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $(function() {
              $( "#date1" ).datepicker({dateFormat: "dd-mm-yy"});
              $( "#date2" ).datepicker({dateFormat: "dd-mm-yy"});
              $( "#date3" ).datepicker({dateFormat: "dd-mm-yy"});
            });
            
            $(document).ready(function(){
                //$(".numeric").numeric();
            });
            
            //AJAX FUNCTIONS
            function xhttp_open(xhttp){
                xhttp.open("POST", "action/form-action.php", true);
            }
            
            function xhttp_send(xhttp, action, param){
                xhttp.send("action="+action+"&"+param);
            }
        </script>
    </head>
    <body>
        <div class="container">
            <?php
            $developer_mode = true;
            include_once 'include/config.php';
            include_once 'action/action.php';
            include_once 'include/functions.php';
            $cfgs=  get_config();
            
            //message handling
            if(isset($_SESSION['message'])){
                $message = $_SESSION['message'];
                $strong = strtoupper(substr($message, 0,1)).substr($message, 1);
                $message=$message=='error'?'danger':$message;
                $messagetext = $_SESSION['messagetext'];
                echo"  
                    <div class='alert alert-$message'>
                        <a href='#' class='close' data-dismiss='alert'>&times;</a>
                        <strong>$strong!</strong> $messagetext
                    </div>";
                unset($_SESSION['message'],$_SESSION['messagetext']);
            }

            //end message handling
            if(!isset($_GET['page'])||$_GET['page']==''){
                redirect($cfgs['index']);
            }else{
                $action=$out;
                include("action/template.php");
            }


            if($developer_mode){
                echo "<br><br>";
                echo "<br> SESSION VARS = "; var_dump($_SESSION);
                echo '<br> CONFIG = '; var_dump($cfgs);
            }

            ?> 
        </div>
    </body>
</html>                                		