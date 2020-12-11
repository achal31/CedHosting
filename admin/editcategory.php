<?php include('header.php');
include_once ('../Classes/Product.php'); 
$category = new Product(); 
$message="";
if(isset($_POST['updatesubcategory']))
{
    $subcategoryid=$_POST['id'];
    $subcategory=$_POST['subcategory'];
    $subcategoryhref=$_POST['subcategoryhref'];
    if(isset($_POST['check']))
    {
        $available='1';
    }else{
        $available='0';
    }
   
  $alert=$category->updatesubcategory($subcategoryid,$subcategory,$subcategoryhref,$available);
   if($alert=='1')
   {
?>
 <script>window.location.href='createcategory.php?static=1'</script>";
  <?php 
   }else {
    $message="<div class='alert alert-warning alert-dismissible fade show' role='alert' id='errormsg'>
       <strong id='alertcontent'>Sub Category Already Exist</strong>
       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
         <span aria-hidden='true'>&times;</span>
       </button>
     </div>";
   }
}
?>
<!-- Header -->
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Google maps</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Maps</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Google maps</li>
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
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
            <div class="card-header bg-transparent">
                            <h3 class="mb-0">EDIT SUB-CATEGORY</h3>
                        </div>
                        <div class="card-body">
                        <form method="POST">
                        <?php
                        if(isset($_GET['edit']))
                        {
                            $subcategoryid=$_GET['id'];
                            $sql=$category->getcategory($subcategoryid);
                        if($sql=='0')
                        {
                            echo "No Data Available";
                        }
                        else {
                            foreach($sql as $fetchsubcategory)
                            {

                           
                        ?>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="subcategory" placeholder="Enter A Sub Category" value="<?php echo $fetchsubcategory['prod_name']; ?>" required>
                                    <input type="text" class="form-control" name="subcategoryhref" placeholder="Enter The Page Href" value="<?php echo $fetchsubcategory['link']; ?>" required>
                                    <input type="hidden" name="id" value="<?php echo $fetchsubcategory['id'] ?>">
                                    <div class="input-group-prepend">
                                    <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalCenter'>UPDATE SUB CATEGORY</button>
                                    </div>
                                </div>
                                <label class="form-control-label">Product Availability</label><br>
                                <label class="custom-toggle">
                                <input type="checkbox" name="check" id="check" <?php if($fetchsubcategory['prod_available']=='1'){echo "checked";}?> >
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                </label>
                            
                                <?php }}}?>

                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">CONFIRMATION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ARE YOU SURE YOU WANT TO UPDATE THE CHANGES?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <input type="submit" class="btn" id="button-addon1" name="updatesubcategory" value="YES">
      </div>
    </div>
  </div>
</div>
                            </form>
                            <?php echo $message?>
                            </div>
                        </div>
                
            </div>
        </div>
    </div>
    <!-- Footer -->
 <?php include('footer.php'); ?>