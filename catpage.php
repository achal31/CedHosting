<?php 
include('header.php');
?>
    <!---singleblog--->
    <div class="content">
        <div class="linux-section">
            <div class="container">

            <?php if($_GET['id']=='73')
            { ?>
                <div class="linux-grids">
                    <div class="col-md-8 linux-grid">
                        <h2>Linux Hosting</h2>
                        <ul>
                            <li><span>Unlimited </span> Domains, Disk Space, Bandwidth and Email Addresses</li>
                            <li><span>99.9% uptime </span> with dedicated 24/7 technical support</li>
                            <li><span>Powered by </span> CloudLinux, cPanel (demo), Apache, MySQL, PHP, Ruby & more</li>
                            <li><span>Launch  </span> your business with Rs. 2000* Google AdWords Credit *</li>
                            <li><span>30 day </span> Money Back Guarantee</li>
                        </ul>
                        <a href="#">view plans</a>
                    </div>
                    <div class="col-md-4 linux-grid1">
                        <img src="images/linux.png" class="img-responsive" alt="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

            <?php } else if($_GET['id']=='75'){?>


                <div class="linux-grids">
                    <div class="col-md-8 linux-grid">
                        <h2>CMS Hosting</h2>
                        <ul>
                            <li><span>Unlimited </span> domains, email and disk space</li>
                            <li><span>99.9% uptime </span> with dedicated 24/7 technical support</li>
                            <li><span>1 click</span> WordPress Installation with cPanel (demo) platform</li>
                            <li><span>Launch  </span> your business with Rs. 1000* Google AdWords Credit *</li>
                            <li><span>30 day </span> Money Back Guarantee</li>
                        </ul>
                        <a href="#">view plans</a>
                    </div>
                    <div class="col-md-4 linux-grid1">
                        <img src="images/cms.png" class="img-responsive" alt="" />
                    </div>
                    <div class="clearfix"></div>
                </div>

            <?php }else if($_GET['id']=='74'){ ?>

                <div class="linux-grids">
                    <div class="col-md-8 linux-grid">
                        <h2>Wordpress Hosting</h2>
                        <ul>
                            <li><span>Unlimited </span> domains, email and disk space</li>
                            <li><span>99.9% uptime </span> with dedicated 24/7 technical support</li>
                            <li><span>1 click</span> WordPress Installation with cPanel (demo) platform</li>
                            <li><span>Launch  </span> your business with Rs. 1000* Google AdWords Credit *</li>
                            <li><span>30 day </span> Money Back Guarantee</li>
                        </ul>
                        <a href="#">view plans</a>
                    </div>
                    <div class="col-md-4 linux-grid1">
                        <img src="images/word.png" class="img-responsive" alt="" />
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php } else if($_GET['id']=='76'){ ?>


                <div class="linux-grids">
                    <div class="col-md-8 linux-grid">
                        <h2>Windows Hosting</h2>
                        <ul>
                            <li>Disk Space, Bandwidth and Email Addresses</li>
                            <li><span>99.9% uptime </span> with dedicated 24/7 technical support</li>
                            <li><span>Powered by </span> CloudLinux, cPanel (demo), Apache, MySQL, PHP, Ruby & more</li>
                            <li><span>Launch  </span> your business with Rs. 2000* Google AdWords Credit *</li>
                            <li><span>30 day </span> Money Back Guarantee</li>
                        </ul>
                        <a href="#">view plans</a>
                    </div>
                    <div class="col-md-4 linux-grid1">
                        <img src="images/window.png" class="img-responsive" alt="" />
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php } ?>
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
                            <?php include_once ('Classes/Product.php');
$product = new Product(); 
$sql=$product->showdynamicdata($_GET['id']);
if($sql=='0')
{
    echo "NO DATA AVAILABLE";
}
else {
foreach($sql as $result)
{
    $decoded=json_decode($result['description']);
    $productweb=$decoded->productweb;
    $productfreedomain=$decoded->productfreedomain;
    $productbandwidth=$decoded->productbandwidth;
    $producttechnology=$decoded->producttechnology;
    $productmailbox=$decoded->productmailbox;
    $productname=$result['prod_name'];
    $monthly=$result['mon_price'];
    $annual=$result['annual_price'];
?>
                                <div class="col-md-3 linux-price">

                                    <div class="linux-top">
                                        <h4><?php echo $productname;?></h4>
                                    </div>

                                    <div class="linux-bottom">
                                        <h5><?php echo $annual; ?><span class="month">per Annual</span></h5>
                                        <h5><?php echo $monthly; ?><span class="month">per month</span></h5>
                                        <h6><?php echo $productfreedomain; ?> Domain</h6>
                                        <ul>
                                            <li><strong><?php echo $productbandwidth; ?></strong> Bandwidth</li>
                                            <li><strong><?php echo $producttechnology; ?></strong>Technology</li>
                                            <li><strong><?php echo $productmailbox; ?></strong>Mail Box</li>
                                            <li><strong>location</strong> : <img src="images/india.png"></li>
                                        </ul>
                                    </div>
                                    <a href="#">buy now</a>
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
                <h3>Linux Features</h3>
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