     <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper">
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-image">
                            <img src="../assets/images/abacuslogo.png" class="circle" alt="">
                        </div>
                        <div class="sidebar-profile-info">
                    <?php 
$eid=$_SESSION['eid'];
$sql = "SELECT FirstName,LastName,EmpId from  tblcaller where id=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                <p><?php echo htmlentities($result->FirstName." ".$result->LastName);?></p>
                                <span><?php echo htmlentities($result->EmpId)?></span>
                         <?php }} ?>
                        </div>
                    </div>
              
                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                  
  <li class="no-padding"><a class="waves-effect waves-grey" href="myprofile.php"><i class="material-icons">account_box</i>Caller Information</a></li>
  <li class="no-padding"><a class="waves-effect waves-grey" href="changepassword.php"><i class="material-icons">settings_input_svideo</i>Change Password</a></li>
                  
   <li class="no-padding"><a class="waves-effect waves-grey" href="apply.php"><i class="material-icons">apps</i>Requests</a></li>
                
         
               
                  <li class="no-padding">
                                <a class="waves-effect waves-grey" href="logout.php"><i class="material-icons">exit_to_app</i>Sign Out</a>
                            </li>  
                 
                   
                </ul>
                <div class="footer">
                    <p class="copyright"><a href="http://tecnosols.com/">TECNOSOLS </a>©</p>
                
                </div>
                </div>
            </aside>