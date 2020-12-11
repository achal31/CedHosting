<?php
include ('header.php');
include_once ('../Classes/Product.php');
$product = new Product();
if(isset($_POST['createnewproduct']))
{
    
    $productsubcategoryid=$_POST['parentcategory'];
    $productname=$_POST['productname'];
    if(isset($_POST['producturl']))
    {
        $producturl=$_POST['producturl'];
    }
    else{
        $product="not found";
    }
    $productmonthlyprice=$_POST['monthlyprice'];
    $productannualprice=$_POST['annualprice'];
    $productsku=$_POST['sku'];
    $productwebspace=$_POST['webspace'];
    $productbandwidth=$_POST['bandwidth'];
    $producttechnology=$_POST['technology'];
    $productmailbox=$_POST['mailbox'];

    $feature=array(
        'productweb'=>$productwebspace,
        'productbandwidth'=>$productbandwidth,
        'producttechnology'=>$producttechnology,
        'productmailbox'=>$productmailbox
    );
    $feature_encode=json_encode($feature);
$check=$product->insertproduct($productsubcategoryid,$productname,$producturl,$productmonthlyprice,$productannualprice,$productsku,$feature_encode);
if($check==1)
{
    $message="<div class='alert alert-success alert-dismissible fade show' role='alert' id='errormsg'>
    <strong id='alertcontent'>The product Has Been Added Successfully!!</strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
}
else{
    $message="<div class='alert alert-danger alert-dismissible fade show' role='alert' id='errormsg'>
<strong id='alertcontent'>The Product Was Not Added!!</strong>
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
</div>";
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
?>
                        <form role="form" id="formfield" action="addproduct.php" method="POST">
                                    <div class="sidebar-heading">
                                        <h1>PRODUCT NAME</h1>
                                    </div>
                                    <hr class="sidebar-divider">
                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">
                                            <label class="input-group-text bg-blue text-white dimension" for="inputGroupSelect01">Product Category<span class="text-red">*</span></label>
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
        echo "<option value=" . $subcategory['id'] . ">$subcategory[prod_name]</option>";
    }
}
?>
</select>
                                    </div>

                                    <div class="input-group flex-nowrap mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-blue text-white dimension" id="addon-wrapping">Product Name<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Product Name" name="productname" required>
                                    </div>

                                    <div class="input-group flex-nowrap mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-blue text-white dimension" id="addon-wrapping">Page URL</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Page URL" name="producturl" required>
                                    </div>

                                    <div class="sidebar-heading">
                                        <h1>PRODUCT DESCRIPTION</h1>
                                    </div>
                                    <hr class="sidebar-divider">


                                    <div class="input-group flex-nowrap mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-blue text-white dimension" id="addon-wrapping">Monthly Price<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Monthly Price" name="monthlyprice" required>
                                    </div>

                                    <div class="input-group flex-nowrap mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-blue text-white dimension" id="addon-wrapping">Annual Price<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Annual Price" name="annualprice" required>
                                    </div>




                                    <div class="input-group flex-nowrap mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-blue text-white dimension" id="addon-wrapping">SKU<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter SKU" name="sku" required>
                                    </div>



                                    <div class="sidebar-heading">
                                        <h1>FEATURES</h1>
                                    </div>
                                    <hr class="sidebar-divider">


                                    <div class="input-group flex-nowrap mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-blue text-white dimension" id="addon-wrapping">Web Space(in GB)<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter 0.5 for 512 MB" name="webspace" required>
                                    </div>

                                    <div class="input-group flex-nowrap mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-blue text-white dimension" id="addon-wrapping">Free Domain<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter 0 if No Domain Available in the service" name="freedomain" required>
                                    </div>

                                    <div class="input-group flex-nowrap mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-blue text-white dimension" id="addon-wrapping">BandWidth(in GB)<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter 0.5 for 512 MB" name="bandwidth" required>
                                    </div>

                                    <div class="input-group flex-nowrap mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-blue text-white dimension" id="addon-wrapping">Technology Support<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter BandWidth Space" name="technology" required>
                                    </div>

                                    <div class="input-group flex-nowrap mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-blue text-white dimension" id="addon-wrapping">MailBox<span class="text-red">*</span></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Number of mailbox will be provided, enter 0 if none" name="mailbox" required>
                                    </div>
                                    <input type="button" name="btn" value="Submit" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-default" />
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
                <input type="submit" value="YES" id="submit" name="createnewproduct"  class="btn btn-default" />
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
<script>
    $(document).ready(function(){
        $('#submit').click(function(){
    $('#formfield').submit();
});

    });
</script>