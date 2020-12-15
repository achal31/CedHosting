<?php include('header.php'); 

include_once ('./Classes/User.php');
$accountLogin = new User();
if(isset($_POST['changepassword']))
{
    if($_POST['pass']==$_POST['repass'])
    {
$sql=$changepassword->changepassword($_SESSION['email'],$_POST['pass']);
    }
}
if(isset($_POST['Reset']))
{
$user_email=$_POST['useremail'];
$_SESSION['email']=$user_email;
$user_quest=$_POST['selectquestion'];
$user_answer=$_POST['selectanswer'];
$sql=$accountLogin->verifyuserIdentity($user_email,$user_quest,$user_answer);
if($sql=='1')
{
    echo "<script>
    $(document).ready(function(){
    $('#exampleModalCenter').modal();
    });
    </script>";
}
else {
    echo "error";
}
}
?>

<div class="content">
        <div class="main-1">
            <div class="container">
                <div class="login-page">
                    <div class="account_grid">
                        <div class="col-md-6 login-left">
                            <h3>RESET PASSWORD</h3>
                            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                        </div>
                        <div class="col-md-6 login-right">
                            <h3>Enter Your Email Address</h3>
                            <p>Enter correct email address and select the desired question and mention the right answer</p>
                            <!-------------FORM FOR USER LOGIN-------------------->
                            <form action="forgetpassword.php" method="post">
                                <!-----------EMAIL INPUT FIELD-------------------->
                                <div>
                                    <span>Email Address<label>*</label></span>
                                    <input type="text" name="useremail" required>
                                </div>
                                <h3>Security information</h3>
                            <div>
                                <!------------SECURITY QUESTION------------------->
                                <span>Security Questions<label>*</label></span>

                               <select id="selectquestion" name="selectquestion" required>
                                   <option value="What is your Nick name?">What is your Nick name?</option>
                                   <option value="What is your pet name?">What is your pet name?</option>
                                   <option value="What is the name of your school?">What is the name of your school?</option>
                                   <option value="What is the name of your best friend?">What is the name of your best friend?</option>
                                   <option value="What is Collge Name?">What is Collge Name?</option>
                               </select>

                            </div>
                            <!---------------SECURITY ANSWER FIELD--------------->
                            <div>
                                <span>Security Answer<label>*</label></span>
                                <input type="text" name="selectanswer" pattern="^([A-Za-z0-9]+ )+[A-Za-z0-9]+$|^[A-Za-z0-9]+$" value="<?php if(isset($_POST['submit'])) { echo $user_answer ;} ?>" required>

                            </div>
                                <!----------PASSWORD INPUT FIELD------------------->
                                <input type="submit" value="Reset" name="Reset">
                            </form>

                            <form action="forgetpassword.php" method="POST">      
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">YOU HAVE BEEN VERIFIED!!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   
      <div class="modal-body-verification">
         
      <div>
                                    <!-------------USER PASSWORD--------------->
                                   <span>Password<label>*</label></span>
                                <input type="password" id="userpassword" name="pass" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$"  required>

                             </div>
                                <div>
                                    <!---------USER CONFIRM PASSWORD------------>
                                   <span>Confirm Password<label>*</label></span>
                                   <input type="password" id="userconfirmpassword" name="repass" required> 
                            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="verify" data-dismiss="modal">NO</button>
     <input type="submit" value="RESET" name="changepassword">
      </div>
    </div>
  </div>
</div>
                            </form>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




<?php include('footer.php'); ?>