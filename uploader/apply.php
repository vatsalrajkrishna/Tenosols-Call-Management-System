<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplo'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['apply']))
{
$empid=$_SESSION['eid'];
 $leavetype=$_POST['leavetype'];
$fromdate=$_POST['fromdate'];  
$todate=$_POST['todate'];
$contact=$_POST['contact'];
$name=$_POST['name'];
$business=$_POST['business'];
$address=$_POST['address'];
$website=$_POST['website'];
$fb=$_POST['fb'];
$active=$_POST['active'];
$post=$_POST['post'];
 
$status=0;
$isread=0;
if($fromdate > $todate){
                $error=" ToDate should be greater than FromDate ";
           }
$sql="INSERT INTO data(Contact,Name,Business,Address,Website,Fb,Active,Post,Status,IsRead,empid) VALUES(:contact,:name,:business,:address,:website,:fb,:active,:post,:status,:isread,:empid)";
$query = $dbh->prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':contact',$contact,PDO::PARAM_STR);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':business',$business,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':website',$website,PDO::PARAM_STR);
$query->bindParam(':fb',$fb,PDO::PARAM_STR);
$query->bindParam(':active',$active,PDO::PARAM_STR);
$query->bindParam(':post',$post,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Customer Added successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Uploader| Event Request</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Call Management System" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Tecnosols" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
  <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
 


    </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
   <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">ADD DATA </div>
                    </div>
                    <div class="col s12 m12 l8">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addemp">
                                    <div>
                                        <h3>Fill Details</h3>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m12">
                                                        <div class="row">
     <?php if($error){?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>





<div class="input-field col m6 s12">
<label for="fromdate">Company Name</label>
<input placeholder="" id="mask1" name="name" class="masked" type="text"  required>
</div>
<div class="input-field col m6 s12">
<label for="todate">Contact Number</label>
<input placeholder="" id="mask1" name="contact" maxlength="10" class="masked" type="text"  required>
</div>
<div class="input-field col m12 s12">
<label for="todate">Business</label>
<input placeholder="" id="mask1" name="business" class="masked" type="text"  required>
</div>
<div class="input-field col m12 s12">
<label for="todate">Address</label>
<input placeholder="" id="mask1" name="address" class="masked" type="text"  required>
</div>
<div class="input-field col m6 s12">
<label for="todate">Website</label>
<input placeholder="" id="mask1" name="website" class="masked" type="text"  required>
</div>
<div class="input-field col m6 s12">
<label for="todate">Facebook Page Like</label>
<input placeholder="" id="mask1" name="fb" class="masked" type="text"  required>
</div>
<div class="col m6">
<div class="row">
<div class="input-field col m6 s12">
<select  name="active" autocomplete="off">
<option selected="true" value="" disabled="disabled">Active</option>                                          
<option value="Yes">Yes</option>
<option value="No">No</option>

</select>
</div>

</div>
</div>
<div class="input-field col m6 s12">
<label for="todate">Posts Like</label>
<input placeholder="" id="mask1" name="post" class="masked" type="text"  required>
</div>
<!--<div class="input-field col m12 s12">
<label for="birthdate">Description</label>    

<textarea id="textarea1" name="description" class="materialize-textarea" length="500" required></textarea>
</div>-->
</div>
      <button type="submit" name="apply" id="apply" class="waves-effect waves-light btn indigo m-b-xs">ADD</button>                                             

                                                </div>
                                            </div>
                                        </section>
                                     
                                    
                                        </section>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/form_elements.js"></script>
          <script src="../assets/js/pages/form-input-mask.js"></script>
                <script src="../assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
    </body>
</html>
<?php } ?> 