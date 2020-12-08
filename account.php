<?php 
include('header.php');
include_once ('Classes/User.php');

if(isset($_POST['submit']))
{
$user_name=$_POST['username'];
$user_email=$_POST['email'];
$user_mobile=$_POST['mobile'];
$user_password=$_POST['pass'];
$user_repassword=$_POST['repass'];
$user_question=$_POST['selectquestion'];
$user_answer=$_POST['selectanswer'];

if($user_password == $user_repassword)
{
    $createAccount = new User();
    $sql = $createAccount->userRegister($user_name,$user_email,$user_mobile,$user_password,$user_question,$user_answer);
}
else {
    echo"<script>alert('Password Field Doesnt Match');</script>";
}
}
?>
    <!---login--->
    <div class="content">
        <!-- registration -->
        <div class="main-1">
             <div class="container">
                 <div class="register">
                        <form action="account.php" method="post">
                            <div class="register-top-grid">


                                <!----------USER PERSONAL INFORMATION FIELDS--------->
                                <h3>personal information</h3>
                                <div>
                                    <!------------USERNAME INPUT FIELD-------------->
                                <span>Name<label>*</label></span>

                                 <input type="text" id="username" name="username" pattern="[a-zA-Z][a-zA-Z]" oninvalid="InvalidMsg(this);"
            oninput="InvalidMsg(this);"  required>
                                </div>
                                <div>
                                    <!-------------USER EMAIL ADDRESS---------------->
                                    <span>Email Address<label>*</label></span>
                                    <input type="text" id="useremail" name="email" pattern="^[A-Z0-9_!#$%&'*+/=?`{|}~^.-]+@[A-Z0-9.-]+$" oninvalid="InvalidMsg(this);"
            oninput="InvalidMsg(this);"  required>
                                </div>
                                
                                <div>
                                    <!-------------USER MOBILE NUMBER------------------>
                                <span>Mobile Number<label>*</label></span>
                                <input type="text" id="userphone" name="mobile" pattern="[1-9]{1}[0-9]{9}" oninvalid="InvalidMsg(this);"
            oninput="InvalidMsg(this);"  required> 
                                </div>
                                
                                <div class="clearfix"> </div>
                            <a class="news-letter" href="#">

                                 <label class="checkbox"></label>
                                </a>
                            </div>

                        <div class="register-bottom-grid">


                            <!--------------USER LOGIN INFORMATION FIELDS------------->
                             <h3>login information</h3>
                                <div>
                                    <!-------------USER PASSWORD--------------->
                                   <span>Password<label>*</label></span>
                                <input type="password" id="userpassword" name="pass" pattern="^((?!.*[\s])(?=.*[A-Z])(?=.*\d).{8,16})" oninvalid="InvalidMsg(this);"
            oninput="InvalidMsg(this);"  required>

                             </div>
                                <div>
                                    <!---------USER CONFIRM PASSWORD------------>
                                   <span>Confirm Password<label>*</label></span>
                                   <input type="password" id="userconfirmpassword" name="repass" pattern=".{8,}" oninvalid="InvalidMsg(this);"
            oninput="InvalidMsg(this);"  required> 
                            </div>
                            <div>
                                    <!---------SHOW USER THE PASSWORD------------>
                                    <input type="checkbox" onclick="myFunction()">
                                   <span>Show Password<label>*</label></span>
                                  
                            </div>
                            
                            <div class="clearfix"> </div>
                            <a class="news-letter" href="#">
                                <label class="checkbox"></label>

                            </a>
                        </div>

                        <div class="register-top-grid">


                            <!-----------USER SECURITY INFORMATION FIELDS----------->
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
                                <input type="text" name="selectanswer" required>

                            </div>
                        </div>
                    <div class="clearfix"> </div>
                       <div class="register-but">
                           <input type="submit" value="submit" id="accountsubmit" name="submit">
                            <div class="clearfix"> </div>
                        </div>
                </div>
                        </form>
            </div>
        </div>
        <!-- registration -->
    
    </div>

    <?php include('footer.php'); ?> 

    <script >
    /*------------Validation Function For the user-----------*/
    function InvalidMsg(textbox) {

        /*-----------Validation message for the empty or wrong phone number-----------*/
        if (textbox.id == 'userphone') {
            if (textbox.value === '') {
                textbox.setCustomValidity('Entering an Phone Number is necessary!');
            } else if (textbox.validity.patternMismatch) {
                textbox.setCustomValidity('You have enter an invalid Phone Number, please try again!!');
            } else {
                textbox.setCustomValidity('');
            }
        }
        /*-----------Validation message for the empty or invalid passsword-----------*/
        else if (textbox.id == 'userpassword' || textbox.id == 'userconfirmpassword') {
            if (textbox.value === '') {
                textbox.setCustomValidity('Entering a Password is necessary!');
            } else if (textbox.validity.patternMismatch) {
                textbox.setCustomValidity('Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters');
            } else {
                textbox.setCustomValidity('');
            }
        }
        /*-----------Validation message for the empty or wrong username-----------*/
        else if (textbox.id == 'username') {
            if (textbox.value === '') {
                textbox.setCustomValidity('Entering User Name is necessary!');
            } else if (textbox.validity.patternMismatch) {
                textbox.setCustomValidity('You have enter an invalid User Name, please try again!!');
            } else {
                textbox.setCustomValidity('');
            }
        }
        /*-----------Validation message for the empty or wrong Email Address-----------*/
        else if (textbox.id == 'useremail') {
            if (textbox.value === '') {
                textbox.setCustomValidity('Entering an Email Id is necessary!');
            } else if (textbox.validity.patternMismatch) {
                textbox.setCustomValidity('You have enter an invalid email address, please try again!');
            } else {
                textbox.setCustomValidity('');
            }
        }

    }

/***********FUNCTION TO USER THE PASSWORD FIELD INPUT********* */
function myFunction(id) {
    var x = document.getElementById("userpassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }

    var y = document.getElementById("userconfirmpassword");
    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
}

</script> 