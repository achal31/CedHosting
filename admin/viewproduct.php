<?php include('header.php'); 
include_once ('../Classes/Product.php'); 
$category = new Product();?>
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
                            <h3 class="mb-0">VIEW PRODUCT</h3>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                        <table class="table align-items-center table-flush mx-auto" id="subcategorytable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort" data-sort="Sub Category">Product Sub Category</th>
                                    <th scope="col" class="sort" data-sort="Product Name">Product Name</th>
                                    <th scope="col" class="sort" data-sort="Status">Status</th>
                                    <th scope="col" class="sort" data-sort="Web Space">Web Space</th>
                                    <th scope="col" class="sort" data-sort="Free Domain">Free Domain</th>
                                    <th scope="col" class="sort" data-sort="Bandwidth">Bandwidth</th>
                                    <th scope="col" class="sort" data-sort="Technology">Technology</th>
                                    <th scope="col" class="sort" data-sort="Mail Box">Mail Box</th>
                                    <th scope="col" class="sort" data-sort="Monthly Price">Monthly Price</th>
                                    <th scope="col" class="sort" data-sort="Annual Price">Annual Price</th>
                                    <th scope="col" class="sort" data-sort="Product SKU">Product SKU</th>
                                    <th scope="col" class="sort" data-sort="Action">Action</th>
                        
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $fetchitem=$category->fetchproducttable();
                                foreach($fetchitem as $product)
                                {
                                  echo"<tr>";
                                $getsubcategory=$category->getcategory($product['prod_parent_id']);
                                foreach($getsubcategory as $subcategory)
                                {
                                  echo "<td>$subcategory[prod_name]</td>";
                                }
                                echo"</tr>";
                              }
                              ?>

                       
                   <!-- Modal -->
<div class="modal fade" id="exampleModalCenter<?php echo $result['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">CONFIRMATION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ARE YOU SURE YOU WANT TO DELETE THE SUBCATEGORY
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <button type='button' class='btn btn-danger'><a class='text-white' href='createcategory.php?delete=1&id=<?php echo $result['id'] ?>'>DELETE</a></button>
      </div>
    </div>
  </div>
</div>
                            </tbody>
                        </table>
                        </div>
                        </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
 <?php include('footer.php'); ?>