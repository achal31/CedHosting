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
                    /*--------------TAKING HEADER TO LOGIN PAGE-----------------*/
                    echo "<script>alert('Registration successfull.');</script>";
                    echo "<script>window.location.href='login.php'</script>";
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
            $_SESSION['username']=$userdata['name'];
            /*----------------SENDING HEADER ON ANOTHER PAGE------------------*/
            echo "<script>window.location.href='index.php'</script>";
        }
        else{
            /*----------------IF DETAIL DOESWNT MATCH-------------------------*/
            echo "<script>alert('Account Detail Doesnt Match');</script>";
        }
    }
}