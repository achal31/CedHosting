<?php
// session_start();

include('Dbcon.php');
class User
{
    
    function __construct()
    {
        $conn      = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->dbh = $conn;
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }


    /*--------------------USER REGISTRATION FUNCTION-----------------------------------*/
    public function userRegister($username,$useremail,$usermobile,$userpass,$userquestion,$useranswer)
    {
        $checkexistingName = mysqli_query($this->dbh, "SELECT * FROM tbl_user WHERE `email`='$useremail' OR `mobile`='$usermobile'");
        $useravailable=mysqli_num_rows($checkexistingName);
        /*--------------IF USER ALREADY EXIST OR NOT----------------*/
        if($useravailable=='0')
        {
            /*----------PASSWORD MD5 ENCY-----------------------------*/
            $enc_userpass=md5($userpass);
            /*------------QUERY TO INSERT USER DETAIL--------------*/
            $insertuserDetail = mysqli_query($this->dbh, "INSERT into tbl_user ( email, name, mobile, active, is_admin, password, security_question, security_answer) VALUES('$useremail', '$username', '$usermobile','1', '0','$enc_userpass', '$userquestion', '$useranswer')");
            /*------------------WHETHER QUERY EXECUTE OR NOT-----------*/    
       
            if($insertuserDetail)
                {
                    echo "<script>alert('Please Verify Your Contact');</script>";
                    $ency_email=md5($useremail);
                    echo "<script>window.location.href='userverification.php?static=$ency_email'</script>";
                }
                else {
                    /*--------------IF QUERY DOESNT EXECUTE---------------------*/
                    echo "ERROR OCCUREED".mysqli_error($this->dbh);
                echo $useranswer;
                echo $userquestion;
                }
        }
        else {
            /*------------------IF USERNAME OR EMAIL ALREADY EXIST IN THE DATABASE--------------*/
            echo "<script>alert('Account Detail Already exist');</script>";
        }
    }


    /*--------------------FUNCTION TO MAKE USER LOGIN --------------------------------*/
    public function userLogin($email,$userpass)
    {
        /*------------PASSWORD MD5 ENCY---------------------*/
        $enc_userpass     = md5($userpass);
        /*-------QUERY TO CHECK USER LOGIN DETAIL--------------------*/
        $userlogincheck= mysqli_query($this->dbh, "SELECT * FROM tbl_user where `email`='$email' AND `password`='$enc_userpass'");
        $userdata = mysqli_fetch_assoc($userlogincheck);
        $useravailable=mysqli_num_rows($userlogincheck);
        if($useravailable=='1')
        {
            
            if($userdata['active']=='0')
            {
                $ency_email=md5($email);
                echo "<script>window.location.href='userverification.php?static=$ency_email'</script>";
            }
            else {
                $_SESSION['username']=$userdata['name'];
                echo "<script>window.location.href='index.php'</script>";
            }
            /*----------------SENDING HEADER ON ANOTHER PAGE------------------*/
          
        }
        else{
            /*----------------IF DETAIL DOESWNT MATCH-------------------------*/
            echo "<script>alert('Account Detail Doesnt Match');</script>";
        }
    }

    /*-------------------FUNCTION TO GET THE USER DETAILS----------------------------*/
    public function getdetail()
    {
        $userlogincheck= mysqli_query($this->dbh, "SELECT email,mobile,active FROM tbl_user");
        if (mysqli_num_rows($userlogincheck) > 0)
        {
            return $userlogincheck;
        }
        else
        {
            return 0;
        }
    }

    public function userverify($data)
    {
        $userlogincheck= mysqli_query($this->dbh, "SELECT * FROM tbl_user");
        $userdata = mysqli_fetch_assoc($userlogincheck);
        if($data==md5($userdata['email']))
        {
        $userlogincheck= mysqli_query($this->dbh, "UPDATE tbl_user SET `active`='1' ,`email_approved`='1' WHERE `email`='$userdata[email]'");
        }
    }
}