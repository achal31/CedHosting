<?php
include ('header.php');
include_once ('../Classes/Product.php');
$product = new Product();

if(isset($_POST['createnewproduct'])||isset($_POST['updatenewproduct']))
{
    
    $productsubcategoryid=$_POST['parentcategory'];
    $productname=$_POST['product_name'];
    if(isset($_POST['producturl']))
    {
        $producturl=$_POST['producturl'];
    }
    else{
        $product="not found";
    }
    if(isset($_POST['status']))
    {
      $status=1;
    }
    else{
      $status=0;
    }
    $productstatus=$status;
    $productmonthlyprice=$_POST['monthlyprice'];
    $productannualprice=$_POST['annualprice'];
    $productsku=$_POST['sku'];
    $productwebspace=$_POST['webspace'];
    $productbandwidth=$_POST['bandwidth'];
    $producttechnology=$_POST['technology'];
    $productmailbox=$_POST['mailbox'];
    $productfreedomain=$_POST['freedomain'];
    

    $feature=array(
        'productweb'=>$productwebspace,
        'productfreedomain'=>$productfreedomain,
        'productbandwidth'=>$productbandwidth,
        'producttechnology'=>$producttechnology,
        'productmailbox'=>$productmailbox
        
    );
    $feature_encode=json_encode($feature);
    if(isset($_POST['createnewproduct']))
    {
      $check=$product->insertproduct($productsubcategoryid,$productname,$producturl, $productstatus,$productmonthlyprice,$productannualprice,$productsku,$feature_encode);
      if($check==0)
      {
          $message="<div class='alert alert-danger alert-dismissible fade show' role='alert' id='errormsg'>
      <strong id='alertcontent'>The Product Was Not Added!!</strong>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
      </div>";
      }
    }
    else{
      $productid=$_POST['productid'];
      echo $productid;
    $product->updateproduct($productsubcategoryid,$productname,$producturl,$productstatus,$productmonthlyprice,$productannualprice,$productsku,$feature_encode,$productid);
    }
    

}

?>
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Add new Product</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add new Product</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="#" class="btn btn-sm btn-neutral">New</a>
                            <a href="#" class="btn btn-sm btn-neutral">Filters</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt--6">
            <div class="row justify-content-center">
            <div class="col-sm-1 col-lg-1 col-md-1"></div>
            <div class="col-sm-10 col-lg-10 col-md-10">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h3 class="mb-0">CREATE NEW PRODUCT</h3>
                            <h6><span class="text-red">*</span>Mandatory Fields</h6>
                        </div>
                       
                        <div class="card-body">
                            <div class="row">
                            <div class="col-sm-1 col-lg-1 col-md-1"></div>
                        <div class="col-sm-10 col-lg-10 col-md-10">
                        <?php
if(isset($_POST['createnewproduct'])){
echo $message;
}
if(isset($_GET['edit']))
{
  
$prod_id=$_GET['id'];
$result=$product->fetchproducttoupdate($prod_id);
foreach($result as $productdetail)
{
  $productstatus=$productdetail['prod_available'];
  $productid=$productdetail['productid'];
  $prodname=$productdetail['prod_name'];
  $link=$productdetail['html'];
  $monthlyprice=$productdetail['mon_price'];
  $annualprice=$productdetail['annual_price'];
  $productsku=$productdetail['sku'];

/*-----------------JSON DECODED-------------------------*/
$decoded=json_decode($productdetail['description']);
$productweb=$decoded->productweb;
$productfreedomain=$decoded->productfreedomain;
$productbandwidth=$decoded->productbandwidth;
$producttechnology=$decoded->producttechnology;
$productmailbox=$decoded->productmailbox;
}

}
?>
                        <form role="form" id="formfield" action="addproduct.php" method="POST">
                          <?php if(isset($_GET['edit']))
{
  ?>
  <input type="hidden" value="<?php echo $_GET['id'] ?>" name="productid"?>
<?php } ?>


                                    <div class="sidebar-heading">
                                        <h1>PRODUCT NAME</h1>
                                    </div>
                                    <hr class="sidebar-divider">
                          

                                        <div class="input-group-prepend">
                                            <label class="text-dark" for="inputGroupSelect01">Product Category<span class="text-red">*</span></label>
                                        </div>
                                        <select class="custom-select" id="inputGroupSelect01" name="parentcategory" required>
<?php
include_once ('../Classes/Product.php');
$category = new Product();
$sql = $category->getsubcategory();
if ($sql == '0')
{
    echo "No Data Available";
}
else
{
    foreach ($sql as $subcategory)
    {
      ?>

        <option value="<?php echo $subcategory['id'] ?>" <?php if(isset($_GET['edit'])){ if($subcategory['id']==$productid) { echo "selected";}} ?> ><?php echo $subcategory['prod_name']; ?></option>";
   
   <?php    }
}
?>
</select>
                                   

                                
                                        <div class="input-group-prepend mt-2">
                                            <span class="text-dark" id="addon-wrapping">Product Name<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Product Name" value="<?php if(isset($_GET['edit'])){ echo $prodname; }?>" id="product_name" name="product_name" required>

                   
                                        <div class="input-group-prepend mt-2">
                                            <span class="text-dark" id="addon-wrapping">Page URL</span>
                                        </div>
                                        <input type="url" class="form-control" placeholder="Enter Page URL" value="<?php if(isset($_GET['edit'])){ echo $link; } ?>" name="producturl" required>
                                  

                                    <div class="sidebar-heading">
                                        <h1>PRODUCT DESCRIPTION</h1>
                                    </div>
                                    <hr class="sidebar-divider">


                                   
                                        <div class="input-group-prepend mt-2">
                                            <span class="text-dark" id="addon-wrapping">Monthly Price<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Monthly Price" value="<?php if(isset($_GET['edit'])){ echo $monthlyprice; }?>"  name="monthlyprice">
                                  

                 
                                        <div class="input-group-prepend mt-2">
                                        <span class="text-dark" id="addon-wrapping">Annual Price<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Annual Price" value="<?php if(isset($_GET['edit'])){ echo $annualprice; }?>" name="annualprice" required>
                       

                                        <div class="input-group-prepend mt-2">
                                        <span class="text-dark" id="addon-wrapping">SKU<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter SKU" value="<?php if(isset($_GET['edit'])){ echo $productsku; }?>" name="sku" required>
                            



                                    <div class="sidebar-heading">
                                        <h1>FEATURES</h1>
                                    </div>
                                    <hr class="sidebar-divider">


                                  
                                        <div class="input-group-prepend mt-2">
                                        <span class="text-dark" id="addon-wrapping">Web Space(in GB)<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter 0.5 for 512 MB" name="webspace"  value="<?php if(isset($_GET['edit'])){ echo $productweb; }?>" required>
                               

                                 
                                        <div class="input-group-prepend mt-2">
                                        <span class="text-dark" id="addon-wrapping">Free Domain<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter 0 if No Domain Available in the service" name="freedomain"  value="<?php if(isset($_GET['edit'])){ echo $productfreedomain; }?>"  required>
                  
                                        <div class="input-group-prepend mt-2">
                                        <span class="text-dark" id="addon-wrapping">BandWidth(in GB)<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter 0.5 for 512 MB" name="bandwidth"  value="<?php if(isset($_GET['edit'])){ echo $productbandwidth; }?>" required>
                    

                                    
                                        <div class="input-group-prepend mt-2">
                                        <span class="text-dark" id="addon-wrapping">Technology Support<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter BandWidth Space" name="technology"  value="<?php if(isset($_GET['edit'])){ echo $producttechnology; }?>" required>
                                    

                
                                        <div class="input-group-prepend mt-2">
                                        <span class="text-dark" id="addon-wrapping">MailBox<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Number of mailbox will be provided, enter 0 if none" name="mailbox"  value="<?php if(isset($_GET['edit'])){ echo $productmailbox; }?>" required>
                                        <div class="input-group-prepend mt-2">
                                       
                                        <label class="custom-toggle">
                                <input type="checkbox" name="status" id="check" <?php if(isset($_GET['edit'])){ if($productstatus=='1'){ echo "checked"; }} ?>>
         
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                </label>
                                        </div>

                                        <?php if(isset($_GET['edit']))
                                        {  ?>
                                          <input type="button" value="Update The Product" id="Updatebtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-warning mt-2" disabled/>
                                        <?php 
                                        } else { ?>
                                        <input type="button" value="Create New Product" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-success mt-2" disabled/>
                                        <?php } ?>
                                    
                                    <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
               ARE YOU SURE YOU WANT TO CREATE A NEW PRODUCT?
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <?php if(isset($_GET['edit']))
                                        {  ?>
                        <input type="submit" value="YES" id="submit" name="updatenewproduct"  class="btn btn-default"/>
                                        <?php } else { ?>                
                <input type="submit" value="YES" id="submit" name="createnewproduct"  class="btn btn-default"/>
                                        <?php } ?>
                
            </div>
        </div>
    </div>
</div>
                                </form>
                               
                            </div>
                            </div>
                                    <div class="col-sm-1 col-lg-1 col-md-1"></div>
                        </div>
                                   
                    </div>
            </div>
            <div class="col-sm-1 col-lg-1 col-md-1"></div>
                </div>
            </div>
            <?php include ('footer.php'); ?>
    
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>


$(document).ready(function() {
  $('#Updatebtn').removeAttr('disabled'); 
  (function() {
    $('form > input[type=text]').keyup(function() {

        var empty = false;
        $('form > input[type=text]').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });

        if (empty) {
              
          $('#Updatebtn').attr('disabled', 'disabled');
            $('#submitBtn').attr('disabled', 'disabled');
        } else {
          if ($("#formfield").valid()) {
            $('#Updatebtn').removeAttr('disabled'); 
            $('#submitBtn').removeAttr('disabled'); 
          }
        }
    });
})()

    $("#formfield").validate({
        errorClass: "error fail-alert",
    validClass: "valid success-alert",
    onfocusout:function(element)
    {
      this.element(element);
    },
    rules: {
        parentcategory:{
            required: true,
        name:false,
        },
        product_name : {
        required: true,
        name:true,
      },
      producturl: {
        required: false,
        name:false,
      },
      monthlyprice: {
        required: true,
        maxlength: 15,
        number: true,
        name:false,
      },
      annualprice: {
        required: true,
        maxlength: 15,
        number: true,
        name:false,
      },
      sku: {
        required: true,
        name:false,
        sku:true,
      },
      webspace: {
        required: true,
        maxlength: 5,
        number: true,
        name:false,
      },
      bandwidth: {
        required: true,
        maxlength: 5,
        number: true,
        name:false,
      },
      technology: {
        required: true,
        name:false,
        technology:true,
      },
      mailbox: {
        required: true,
        name:false,
        check:true,
      },
      freedomain: {
        required: true,
        name:false,
        check:true,
      },
      
    },
    messages : {
        product_name : {
        required: "Please Enter the Product Name",
      },
      monthlyprice: {
        required: "Please Enter Monthly Price",
        maxlength:"Please Enter Value Less Than 15",
        number: "Please Enter A Numeric Value",
      },
      annualprice: {
        required: "Please Enter Annual Price",
        maxlength:"Please Enter Value Less Than 15",
        number: "Please Enter A Numeric Value",
      },
      sku: {
        required: "Please Enter Product Sku",
      },
      webspace: {
        required: "Please Enter Product Web Space",
        maxlength:"Please Enter Value Less Than 5",
        number: "Please Enter A Numeric Value",
      },
      bandwidth: {
        required: "Please Enter Product Bandwidth",
        maxlength:"Please Enter Value Less Than 5",
        number: "Please Enter A Numeric Value",
      },
      technology: {
        required: "Please Enter Technology Name",
      },
      mailbox: {
        required: "Please Enter Total Mail Box",
      },
      freedomain: {
        required: "Please Enter the total domain",
      },
    }
  });
  $.validator.addMethod("name",function(value,element){
        return this.optional(element) || /^[a-zA-Z0-9]*[-\s]?[a-zA-Z]+[-\s]?[0-9]*(([a-zA-Z0-9]*[-\s]?[a-zA-Z]+[-\s]?[0-9]*)+)*$/.test(value);
    },"Enter Product Name that should start with alphabet");
    $.validator.addMethod("sku",function(value,element){
        return this.optional(element) || /^[a-zA-Z0-9#](?:[a-zA-Z0-9_-]*[a-zA-Z0-9])?$/.test(value);
    },"Enter A Valid Sku For The Product");

    $.validator.addMethod("check",function(value,element){
        return this.optional(element) || /((^[0-9]*$)|(^[A-Za-z]+$))/.test(value);
    },"Enter Value That is only Numeric or Only Alphabetic");

    $.validator.addMethod("technology",function(value,element){
        return this.optional(element) || /(^[a-zA-Z0-9]*[a-zA-Z]+[0-9]*(,?([a-zA-Z0-9]*[a-zA-Z]+[0-9]*)+)*$)/.test(value);
    },"Enter Value That is only Alphabatic or Only Alphabetic");

   
});


  
 
</script>