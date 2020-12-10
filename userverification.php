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
        echo "<script>alert('OTP VERIFIED SUCCESSFULLY');</script>";
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
        echo "<script>alert('Email Sended Successfully');</script>";
    }
    else if (isset($_GET['dynamic']))
    {
        $val = $_GET['dynamic'];
?>
                <script>
                   $(document).ready(function(){
                    $('#mobileverification').show();
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

    <?php include ('footer.php'); ?>
