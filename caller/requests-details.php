<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{


// code for update the read notification status
$isread=1;
$did=intval($_GET['leaveid']);  
date_default_timezone_set('Asia/Kolkata');
$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
$sql="update data set IsRead=:isread where id=:did";
$query = $dbh->prepare($sql);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();

// code for action taken on leave
if(isset($_POST['update']))
{ 
$did=intval($_GET['leaveid']);
$caller=$_POST['caller'];
$about=$_POST['about'];
$status=$_POST['status'];   
date_default_timezone_set('Asia/Kolkata');
$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
$sql="update data set About=:about,Caller=:caller,Status=:status where id=:did";
$query = $dbh->prepare($sql);
$query->bindParam(':about',$about,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':caller',$caller,PDO::PARAM_STR);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();
$msg="Data Saved Successfully";
}



 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Customer Details </title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

                <link href="../assets/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css"/>  
        <!-- Theme Styles -->
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
                        <div class="page-title" style="font-size:24px;">Request Details</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Request Details</span>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                               
                                 
                                    <tbody>
<?php 
$lid=intval($_GET['leaveid']);
$sql = "SELECT data.id as lid,tbluploader.FirstName,tbluploader.EmpId,tbluploader.id,tbluploader.Phonenumber,data.Caller,data.About,data.Name,data.Website,data.Active,data.Contact,data.Fb,data.PostingDate,data.Status,data.Business,data.Address from data join tbluploader on data.empid=tbluploader.id where data.id=:lid";
$query = $dbh -> prepare($sql);
$query->bindParam(':lid',$lid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>  

                                     

                                          <tr>
                                             <td style="font-size:16px;"><b>Company Name :</b></td>
                                            <td><?php echo htmlentities($result->Name);?></td>
                                             <td style="font-size:16px;"><b>Address :</b></td>
                                            <td><?php echo htmlentities($result->Address);?></td>
                                            <td>&nbsp;</td>
                                             <td>&nbsp;</td>
                                        </tr>

  <tr>
                                             <td style="font-size:16px;"><b>Business :</b></td>
                                            <td><?php echo htmlentities($result->Business);?></td>
                                             <td style="font-size:16px;"><b>Company P. No. :</b></td>
                                            <td><?php echo htmlentities($result->Contact);?></td>
											 <td style="font-size:16px;"><b>Website :</b></td>
											 <td><?php echo htmlentities($result->Website);?></td>
                                           
                                        </tr>

<tr>											 <td style="font-size:16px;"><b>Posting Date</b></td>
                                           <td><?php echo htmlentities($result->PostingDate);?></td>
                                             <td style="font-size:16px;"><b>FB Likes : </b></td>
                                            <td ><?php echo htmlentities($result->Fb);?></td>
									        <td style="font-size:16px;"><b>Active : </b></td>
                                            <td ><?php echo htmlentities($result->Active);?></td>
                                          
                                        </tr>

<tr>
<td style="font-size:16px;"><b>Request Status :</b></td>
<td colspan="5"><?php $stats=$result->Status;
if($stats==3){
?>
<span style="color: green">	Called</span>
 <?php } if($stats!=3)  { ?>
<span style="color: red">Not Called</span>
<?php } ?>

</td>
</tr>

<tr>
<td style="font-size:16px;"><b>Called By: </b></td>
<td colspan="5"><?php

echo htmlentities($result->Caller);

?></td>
 </tr>

 <tr>
<td style="font-size:16px;"><b>About Customer : </b></td>
<td colspan="5"><?php

echo htmlentities($result->About);

?></td>
 </tr>
<?php 
if($stats!=3)
{

?>
<tr>
 <td colspan="5">
  <a class="modal-trigger waves-effect waves-light btn" href="#modal1">Take&nbsp;Action</a>
<form name="addemp" method="post">
<div id="modal1" class="modal modal-fixed-footer" style="height: 80%">
    <div class="modal-content" style="width:90%">
	    <h4>Take action</h4>
 <select class="browser-default" name="status" required="">
                                            <option value="">Choose your option</option>
                                            <option value="3">Called</option>
                                            <option value="4">Not Called</option>
                                        </select></p>
<input type="text" name="caller" placeholder="Enter your Name" required="">
                                           
										<p><textarea id="textarea1" name="about" class="materialize-textarea"  placeholder="Description" length="500" maxlength="500" required></textarea></p>
    </div>
                   

    <div class="modal-footer" style="width:90%">
       <input type="submit" class="waves-effect waves-light btn blue m-b-xs" name="update" value="Submit">
    </div>

</div>   

 </td>
</tr>
<?php } ?>
   </form>                                     </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
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
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
         <script src="assets/js/pages/ui-modals.js"></script>
        <script src="assets/plugins/google-code-prettify/prettify.js"></script>
        
    </body>
</html>
<?php } ?>