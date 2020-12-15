<?php 
if (!isset($_SESSION)) {
    session_start();
    
}
if(isset($_SESSION['usertype']))
{
echo $_SESSION['usertype'];
    if($_SESSION['usertype']=='1')
    {
        header("Location:admin/dashboard.php");
    }else if($_SESSION['usertype']=='0')
    {
        header('Location:index.php');
    }
}


include('header.php');
include_once ('./Classes/User.php');
if(isset($_POST['login']))
{
$user_email=$_POST['useremail'];
$user_pass=$_POST['userpassword'];
$accountLogin = new User();
    $sql = $accountLogin->userLogin($user_email,$user_pass);
    if($sql)
    {
        $encrypted_email=$sql;
        echo "<script>
        $(document).ready(function(){
             $('#exampleModalCenter').modal();
             $('#verifyuser').click(function() {

                window.location.href = 'userverification.php?static=$encrypted_email';
                })
        });
        </script>";
    }

}
?>
    <!---login--->
    <div class="content">
        <div class="main-1">
            <div class="container">
                <div class="login-page">
                    <div class="account_grid">
                        <div class="col-md-6 login-left">
                            <h3>new customers</h3>
                            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                            <a class="acount-btn" href="account.php">Create an Account</a>
                        </div>
                        <div class="col-md-6 login-right">
                            <h3>registered</h3>
                            <p>If you have an account with us, please log in.</p>
                            <!-------------FORM FOR USER LOGIN-------------------->
                            <form action="login.php" method="post">
                                <!-----------EMAIL INPUT FIELD-------------------->
                                <div>
                                    <span>Email Address<label>*</label></span>
                                    <input type="text" name="useremail" value="<?php if(isset($_POST['login'])){ echo $user_email; }?>"required>
                                </div>
                                <!----------PASSWORD INPUT FIELD------------------->
                                <div>
                                    <span>Password<label>*</label></span>
                                    <input type="password" name="userpassword" id="userpassword" value="<?php if(isset($_POST['login'])){ echo $user_pass; }?>" required> 
                                </div>
                                <div>
                                <input type="checkbox" onclick="myFunction()">
                                   <span>Show Password<label>*</label></span>
                                </div>
                                <a class="forgot" href="forgetpassword.php">Forgot Your Password?</a>
                                <input type="submit" value="Login" name="login">

                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">CONTACT DETAIL NOT VERIFIED!!!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       DO YOU WANT TO VERIFY THEM IN CASE IF YOU WANT TO LOGIN?
      </div>
      <div class="modal-footer">
        <button type="button" class="verify" data-dismiss="modal">NO</button>
        <button type="button" class="verify" data-dismiss="modal" id="verifyuser">YES</button>
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
    <!-- login -->
    <!---footer--->
    <?php include('footer.php'); ?>
    <script>
        
        /***********FUNCTION TO USER THE PASSWORD FIELD INPUT********* */
function myFunction(id) {
    var x = document.getElementById("userpassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

    </script>