<?php 
include('header.php');
include_once ('Classes/User.php');
if(isset($_GET['static']))
{
    
    $userdata = new User();
       $sql= $userdata->getdetail();
       if($sql=='0')
       {
           header('Location:login.php');
       }
       else {
           foreach($sql as $result)
           { 
            if(md5($result['email'])==$_GET['static'])
            { 
                $email=$result['email'];
                $mobile=$result['mobile'];
               
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
                                <input type="text" id="useremail" name="email" pattern="^(?!.*\.{2})[a-zA-Z0-9.]+@[a-zA-Z]+(?:\.[a-zA-Z]+)*$" value="<?php echo $email;?>">
                                <div class="register-but">
                                <button type="submit" name="SendMail" class="btn btn-success verify" id="emailverification">Verify</button>
                                 </div>
                                </div>
                                </form>


                                <form>
                                <div>
                                <!-------------USER MOBILE NUMBER------------------>
                                <span>Mobile Number<label>*</label></span>
                                <input type="text" id="userphone" name="mobile" pattern="^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$" value="<?php  echo $mobile; ?>"> 
                                <div class="register-but">
                                <button class="btn btn-success verify" id="emailverification">Verify</button>
                                </div>
                                </div>
                                </form>
                                </div>
                                </div>
            </div>
        </div>
        <!-- registration -->
    
    </div>

    <?php include('footer.php'); ?> 

