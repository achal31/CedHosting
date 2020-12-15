<?php
session_start();
include ('header.php');
include_once ('Classes/User.php');

if (isset($_POST['mobileverification']))
{
    $email = $_POST['email'];
    $otp = $_POST['otpverfiy'];
    if ($otp == $_SESSION['OTP'])
    {
?>
                    <script>
                   $(document).ready(function(){
                    $('#verifyotp').val('Verified');
                    
                    $('#mobileverification').hide();
                  
                   });
                   </script>


                   <?php
        include_once ('Classes/User.php');
        $userdata = new User();
        $sql = $userdata->userverify($email, 2);
        echo "<script>
         
        $('#mobverification').modal();</script>";
        ?>
                <?php
        echo "<script>window.location.href='login.php'</script>";
    }
}

if (isset($_GET['static']) || isset($_GET['send']) || isset($_GET['dynamic']))
{
    if (isset($_GET['send']))
    {
        $val = $_GET['send'];
        echo "<script>
        $(document).ready(function(){
             $('#exampleModalCenter').modal();
        });
        </script>";
    }
    else if (isset($_GET['dynamic']))
    {
        $val = $_GET['dynamic'];
?>
                <script>
                   $(document).ready(function(){
                    $('#mobileverification').show();
                    $('#mobverification').modal();
                   
                   });
                </script>
        <?php
    }
    else
    {
        $val = $_GET['static'];

    }
    $userdata = new User();
    $sql = $userdata->getdetail();
    if ($sql == '0')
    {
        header('Location:login.php');
    }
    else
    {
        foreach ($sql as $result)
        {
            if (md5($result['email']) == $val)
            {
                $email = $result['email'];
                $mobile = $result['mobile'];
                if ($result['active'] == '1')
                {
?>
                   <script>
                   $(document).ready(function(){
                    $('#emailverification').val('Verified');
                   });
                   </script>
                   <?php
                }
            }
        }
    }
}
?>
    <!---login--->
    <div class="content">
        <!-- registration -->
        <div class="main-1">
             <div class="container">
                 <div class="register">
                            <div class="register-top-grid">


                                <!----------USER PERSONAL INFORMATION FIELDS--------->
                                <h3>User Verification</h3>
                                <form action="email.php" method="post">
                                <div>
                                <!-------------USER EMAIL ADDRESS---------------->
                                <span>Email Address<label>*</label></span>
                                <input type="text" id="useremail" name="email" pattern="^(?!.*\.{2})[a-zA-Z0-9.]+@[a-zA-Z]+(?:\.[a-zA-Z]+)*$" value="<?php echo $email; ?>">
                                <div class="register-but">
                                <input type="submit" name="SendMail" class="btn btn-success verify" value="Verify" id="emailverification">
                                 </div>
                                </div>
                                </form>


                                <form action="mobile_otp.php" method="post">
                                <div>
                                <!-------------USER MOBILE NUMBER------------------>
                                <span>Mobile Number<label>*</label></span>
                                <input type="hidden" id="useremail" name="email" pattern="^(?!.*\.{2})[a-zA-Z0-9.]+@[a-zA-Z]+(?:\.[a-zA-Z]+)*$" value="<?php echo $email; ?>">
                                <input type="text" id="userphone" name="mobile" pattern="^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$" value="<?php echo $mobile; ?>"> 
                                <div class="register-but">
                                <button class="btn btn-success verify" id="emailverification">Verify</button>
                                </div>
                                </div>
                                </form>

                                
                                <form  method="post" id="mobileverification">
                                <div>
                                <!-------------USER MOBILE NUMBER------------------>
                                <span>Enter Otp<label>*</label></span>
                                <input type="hidden" id="useremail" name="email" pattern="^(?!.*\.{2})[a-zA-Z0-9.]+@[a-zA-Z]+(?:\.[a-zA-Z]+)*$" value="<?php echo $email; ?>">
                                <input type="text" id="userphone" name="otpverfiy"> 
                                <div class="register-but">
                                <input type="submit" name="mobileverification" class="btn btn-success verify" value="Verify" id="verifyotp">
                                
                                </div>
                                </div>

                                </form>
                             
                                </div>
                                </div>
            </div>
        </div>
        <!-- registration -->
    
    </div>


       <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">VERIFICATION LINK SEND</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    EMAIL VERIFICATION LINK HAS BEEN SEND PLEASE CHECK YOUR EMAIL!!
      </div>
      <div class="modal-footer">
        <button type="button" class="verify" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="mobverification" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">VERIFICATION OTP SEND</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   PLEASE ENTER THE RECEIVED OTP.
      </div>
      <div class="modal-footer">
        <button type="button" class="verify" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

    <?php include ('footer.php'); ?>
