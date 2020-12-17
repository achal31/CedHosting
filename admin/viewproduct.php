<?php include('header.php'); 
include_once ('../Classes/Product.php'); 
$category = new Product();
/*--------CONDITION TO DELETE THE PRODUCT--------------*/
if(isset($_GET['delete']))
{
  $productid=$_GET['id'];
  $result=$category->deleteproduct($productid);
}
else if(isset($_GET['productupdate'])){
  $message="<div class='alert alert-success alert-dismissible fade show' role='alert' id='errormsg'>
  <strong id='alertcontent'>The product Has Been Updated Successfully!!</strong>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
else if(isset($_GET['productadded']))
{
  $message="<div class='alert alert-success alert-dismissible fade show' role='alert' id='errormsg'>
  <strong id='alertcontent'>The product Has Been Added Successfully!!</strong>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
?>
<!-- Header -->
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">View Product</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#">Product</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View Product</li>
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
                            <h3 class="mb-0">VIEW PRODUCT</h3>
                        </div>
                        <div class="card-body">
                       
                       <?php if(isset($_GET['delete']))
{
  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' id='errormsg'>
<strong id='alertcontent'>The SubCategory Has Been Deleted Successfully!!!</strong>
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
</div>";
} else  if(isset($_GET['productupdate'])){
  echo $message;
} else if(isset($_GET['productadded']))
{ echo $message;
}
?>
                        <div class="table-responsive">
                        <table class="table align-items-center table-flush mx-auto" id="producttable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-white" data-sort="Sub Category">Product Sub Category</th>
                                    <th scope="col" class="text-white" data-sort="Product Name">Product Name</th>
                                    <th scope="col" class="text-white" data-sort="Monthly Price">Monthly Price</th>
                                    <th scope="col" class="text-white" data-sort="Annual Price">Annual Price</th>
                                    <th scope="col" class="text-white" data-sort="Web Space">Web Space</th>
                                    <th scope="col" class="text-white" data-sort="Free Domain">Free Domain</th>
                                    <th scope="col" class="text-white" data-sort="Bandwidth">Bandwidth</th>
                                    <th scope="col" class="text-white" data-sort="Product SKU">Product SKU</th>
                                    <th scope="col" class="text-white" data-sort="Technology">Technology</th>
                                    <th scope="col" class="text-white" data-sort="Mail Box">Mail Box</th>    
                                    <th scope="col" class="text-white" data-sort="Mail Box">Status</th>    
                                    <th scope="col" class="text-white" data-sort="Action">Action</th>
                        
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $fetchitem=$category->fetchproducttable();
                                if($fetchitem=='0')
                                {
                                  echo "No Data Available";
                                }else{
                                foreach($fetchitem as $product)
                                {
                                  echo"<tr>";
                                $getsubcategory=$category->getcategory($product['prod_parent_id']);
                                foreach($getsubcategory as $subcategory)
                                {
                                  echo "<td>$subcategory[prod_name]</td>";
                                }
                                echo "<td>$product[prod_name]</td>";
                                echo "<td>₹$product[mon_price]</td>";
                                echo "<td>₹$product[annual_price]</td>";
                             

                                /*-----------------JSON DECODED-------------------------*/
                                $decoded=json_decode($product['description']);
                                $productweb=$decoded->productweb;
                                $productfreedomain=$decoded->productfreedomain;
                                $productbandwidth=$decoded->productbandwidth;
                                $producttechnology=$decoded->producttechnology;
                                $productmailbox=$decoded->productmailbox;

                                echo "<td> $productweb GB</td>";
                             echo "<td> $productfreedomain</td>";
                             echo "<td> $productbandwidth GB</td>";
                             echo "<td>$product[sku]</td>";
                             echo "<td> $producttechnology</td>";
                             echo "<td> $productmailbox</td>";
                             if($product['prod_available']=='1')
                             {
                              echo "<td><span class='badge badge-dot mr-4'>
                              <i class='bg-success'></i>
                              <span class='status'>Available</span>
                                          </span></td>";
                             }
                             else {
                               echo"<td><span class='badge badge-dot mr-4'>
                               <i class='bg-warning'></i>
                               <span class='status'>Unvailable</span>
                                           </span></td>";
                             }
                     
                           
                     
                            echo "<td><button type='button' class='btn btn-warning'><a class='text-white' href='addproduct.php?edit=1&id=$product[prod_id]'>EDIT</a></button>
                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalCenter$product[prod_id]'>DELETE</button>
                            </td>";
                                echo"</tr>";
                             
                              ?>

                       
                   <!-- Modal -->
<div class="modal fade" id="exampleModalCenter<?php echo $product['prod_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">CONFIRMATION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ARE YOU SURE YOU WANT TO DELETE THE PRODUCT?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <button type='button' class='btn btn-danger'><a class='text-white' href='viewproduct.php?delete=1&id=<?php echo $product['prod_id'] ?>'>YES</a></button>
      </div>
    </div>
  </div>
</div>
<?php  } }?>
                            </tbody>
                        </table>
                        </div>
                        </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
 <?php include('footer.php'); ?>
 <script>
$(document).ready(function() {
    $('#producttable').DataTable();
});
</script>