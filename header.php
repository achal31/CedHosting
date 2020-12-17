<?php 
if (!isset($_SESSION)) {
    session_start();
    
}

$activePage = basename($_SERVER['REQUEST_URI']);
$pages=array('linuxhosting.php','wordpresshosting.php','windowshosting.php','cmshosting.php');
?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>

<head>
<title>CedHosting</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Planet Hosting Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript">
addEventListener("load", function() {
setTimeout(hideURLbar, 0);
}, false);

function hideURLbar() {
window.scrollTo(0, 1);
}
</script>
<!---fonts-->
<link href='//fonts.googleapis.com/css?family=Voltaire' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="script.js"></script>
<link rel="stylesheet" href="style.css" />
<!---fonts-->

</head>

<body>
    <!---header--->
    <div class="header">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<i class="sr-only">Toggle navigation</i>
								<i class="icon-bar"></i>
								<i class="icon-bar"></i>
								<i class="icon-bar"></i>
							</button>
                        <div class="navbar-brand">
                            <a href="index.php"></a><img src="CEDHOSTING.png" width="65%" style="margin-top:-30px;">
                        </div>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li <?php if($activePage == "index.php")echo 'class="active"'; ?> ><a href="index.php">Home <i class="sr-only">(current)</i></a></li>
                            <li <?php if($activePage == "about.php")echo 'class="active"'; ?> ><a href="about.php">About</a></li>
                            <li <?php if($activePage == "services.php")echo 'class="active"'; ?> ><a href="services.php">Services</a></li>
                            <li class="dropdown <?php if (in_array($activePage, $pages)):?>active<?php endif; ?>">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hosting<i class="caret"></i></a>
									<ul class="dropdown-menu">
                                    <?php 
                                    include_once ('Classes/Product.php'); 
                                                $category = new Product();
                                                    $sql = $category->getsubcategory();
                                                    if($sql=='0')
                                                    {
                                                        echo "No Data Available";
                                                    }
                                                    else {
                                                        foreach($sql as $subcategory)
                                                        {
                                                          
                                                            ?>
                                                            <li><a href='catpage.php?id=<?php echo $subcategory['id']; ?>' ><?php echo $subcategory['prod_name']; ?></a></li>
                                                            <?php
                                                        }
                                                    }
                                                        ?>
									</ul>			
								</li>
                            <li <?php if($activePage == "portfolio.php")echo 'class="active"'; ?> ><a href="portfolio.php">Pricing</a></li>
                            <li <?php if($activePage == "blog.php")echo 'class="active"'; ?> ><a href="blog.php">blog</a></li>
                            <li <?php if($activePage == "contact.php")echo 'class="active"'; ?> ><a href="contact.php">Contact</a></li>
                            <li <?php if($activePage == "codes.php")echo 'class="active"'; ?> ><a href="cart.php"><i class="fa fa-shopping-cart" style="font-size:22px;color:#E6653D"><span class="badge badge-success"><?php if(isset($_SESSION['cart'])){echo count($_SESSION['cart']); } ?></span></i></a></li>
                           <?php if(isset($_SESSION['usertype']))
                           {   
                               if($_SESSION['usertype']=='0')
                               {
                              ?>
                                <li <?php if($activePage == "logout.php")echo 'class="active"'; ?> ><a href="logout.php">Logout</a></li> 
                          <?php }
                          else{
                              ?>
                            <li <?php if($activePage == "login.php")echo 'class="active"'; ?> ><a href="login.php">Login</a></li> 
                          <?php }}
                           else {
                               ?>
                           
                            <li <?php if($activePage == "login.php")echo 'class="active"'; ?> ><a href="login.php">Login</a></li> 
                          <?php } ?> 
                        </ul>

                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </div>
    </div>