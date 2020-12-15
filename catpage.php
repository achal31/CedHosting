<?php 
include('header.php');
if(isset($_GET['add']))
{
    if(!isset($_SESSION['cart']))
    {
$_SESSION['cart']=array();
array_push($_SESSION['cart'],$_GET['add']);
    }else {
        
         
       if(!in_array($_GET['add'], $_SESSION['cart']))
        {
        array_push($_SESSION['cart'],$_GET['add']); 
    }
}
}
include_once ('Classes/Product.php');
$product = new Product();
?>
    <!---singleblog--->
    <div class="content">
        <div class="linux-section">
            <div class="container">
<?php $sql=$product->selectsubcategory($_GET['id']); 
if($sql=='0')
{
    echo "NO DATA AVAILABLE";
}else {
    foreach($sql as $result)
    {

        echo $result['html'];
    }
}
?>
            
            </div>
        </div>
   
        <div class="tab-prices">
            <div class="container">
                
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs left-tab" role="tablist">
                        <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">IN Hosting</a></li>
                        <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">US Hosting</a></li>
                    </ul>
                    
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                            <div class="linux-prices">
                            <?php 
 
$sql=$product->showdynamicdata($_GET['id']);
if($sql=='0')
{
    echo "NO DATA AVAILABLE";
}
else {
foreach($sql as $result)
{
    $product_id=$result['product_id'];
    $decoded=json_decode($result['description']);
    $productweb=$decoded->productweb;
    $productfreedomain=$decoded->productfreedomain;
    $productweb=$decoded->productweb;
    $productbandwidth=$decoded->productbandwidth;
    $producttechnology=$decoded->producttechnology;
    $productmailbox=$decoded->productmailbox;
    $productname=$result['prod_name'];
    $monthly=$result['mon_price'];
    $annual=$result['annual_price'];
    $productsku=$result['sku'];
?>
                                <div class="col-md-3 linux-price" id="plans">

                                    <div class="linux-top">
                                        <h4><?php echo $productname;?></h4>
                                    </div>

                                    <div class="linux-bottom">
                                        <h5>₹<?php echo $annual; ?>/-<span class="month">per Annual</span></h5>
                                        <h5>₹<?php echo $monthly; ?>/-<span class="month">per month</span></h5>
                                        <h6><?php echo $productfreedomain; ?> Domain</h6>
                                        <ul>
                                            <li>Disk Space:<strong><?php echo $productbandwidth; ?>GB</strong></li>
                                            <li>Data Transfer:<strong><?php echo $productweb; ?>00 GB</strong></li>
                                            <li>Technology:<strong><?php echo $producttechnology; ?></strong></li>
                                            <li>Mail Box:<strong><?php echo $productmailbox; ?></strong></li>
                                            <li>Product SKU:<strong><?php echo $productsku; ?></strong></li>
                                            <li><strong>location</strong> : <img src="images/india.png"></li>
                                        </ul>
                                    </div>
                                    <a href="catpage.php?id=<?php echo $_GET['id'] ; ?>&add=<?php echo $product_id ; ?>">buy now</a>
                                </div>
                                <?php } }?>
                              
                                
                                <div class="clearfix"></div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
       
        <!-- clients -->
        <div class="clients">
            <div class="container">
                <h3>Some of our satisfied clients include...</h3>
                <ul>
                    <li>
                        <a href="#"><img src="images/c1.png" title="disney" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="images/c2.png" title="apple" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="images/c3.png" title="microsoft" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="images/c4.png" title="timewarener" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="images/c5.png" title="disney" /></a>
                    </li>
                    <li>
                        <a href="#"><img src="images/c6.png" title="sony" /></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- clients -->
        <div class="whatdo">
            <div class="container">
                <h3><?php $sql=$product->selectsubcategory($_GET['id']); 
if($sql=='0')
{
    echo "NO DATA AVAILABLE";
}else {
    foreach($sql as $result)
    {

        echo $result['prod_name'];
    }
}
?>
 Features</h3>
                <div class="what-grids">
                    <div class="col-md-4 what-grid">
                        <div class="what-left">
                            <i class="glyphicon glyphicon-cog" aria-hidden="true"></i>
                        </div>
                        <div class="what-right">
                            <h4>Expert Web Design</h4>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-4 what-grid">
                        <div class="what-left">
                            <i class="glyphicon glyphicon-dashboard" aria-hidden="true"></i>
                        </div>
                        <div class="what-right">
                            <h4>Expert Web Design</h4>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-4 what-grid">
                        <div class="what-left">
                            <i class="glyphicon glyphicon-stats" aria-hidden="true"></i>
                        </div>
                        <div class="what-right">
                            <h4>Expert Web Design</h4>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="what-grids">
                    <div class="col-md-4 what-grid">
                        <div class="what-left">
                            <i class="glyphicon glyphicon-download-alt" aria-hidden="true"></i>
                        </div>
                        <div class="what-right">
                            <h4>Expert Web Design</h4>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-4 what-grid">
                        <div class="what-left">
                            <i class="glyphicon glyphicon-move" aria-hidden="true"></i>
                        </div>
                        <div class="what-right">
                            <h4>Expert Web Design</h4>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-4 what-grid">
                        <div class="what-left">
                            <i class="glyphicon glyphicon-screenshot" aria-hidden="true"></i>
                        </div>
                        <div class="what-right">
                            <h4>Expert Web Design</h4>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>
    <!---footer--->
    <?php include('footer.php'); ?>