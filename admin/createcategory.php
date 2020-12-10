<?php 
if (!isset($_SESSION)) {
    session_start();
    
}
if(isset($_SESSION['usertype']))
{
    if($_SESSION['usertype']=='0')
    {
        header('Location:index.php');
    }
}
include('header.php');
include_once ('../Classes/Product.php'); 
$category = new Product();
if(isset($_POST['addsubcategory']))
{
    $subcategory=$_POST['subcategory'];
    $selectedcategory=$_POST['selectedcategory'];
    $categoryhref=$_POST['subcategoryhref'];
    $sql = $category->addsubcategory($subcategory,$selectedcategory,$categoryhref);
    if($sql=='1')
    {
        echo"<script>alert('Sub Category Added');</script>";
    }
}
?>
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Create Sub-Category</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">COMPONENTS</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Sub-Category</li>
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
                            <h3 class="mb-0">SUB-CATEGORY</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <h3 class="mb-0 text-dark">SELECT CATEGORY</h3>

                                <div class="input-group mb-3">
                                    <select class="custom-select" id="inputGroupSelect01" name="selectedcategory">
                        <?php 
                        $sql = $category->getcategory('0');
                            if($sql=='0')
                            {
                                echo "No Category Available";
                            }else{
                                foreach($sql as $showcategory)
                                {
                                echo "<option value=".$showcategory['id'].">$showcategory[prod_name]</option>";
                                }
                            }
                        ?>
                        </select>
                                </div>
                                <h3 class="mb-0 text-dark">ADD SUB CATEGORY</h3>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="subcategory" placeholder="Enter A Sub Category" required>
                                    <input type="text" class="form-control" name="subcategoryhref" placeholder="Enter The Page Href" required>
                                    <div class="input-group-prepend">
                                        <input type="submit" class="btn" id="button-addon1" name="addsubcategory" value="SAVE SUB CATEGORY">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h3 class="mb-0">Icons</h3>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                        <table class="table align-items-center table-flush mx-auto" id="subcategorytable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort" data-sort="Category">Category</th>
                                    <th scope="col" class="sort" data-sort="Sub Category">Sub Category</th>
                                    <th scope="col" class="sort" data-sort="Status">Status</th>
                                    <th scope="col" class="sort" data-sort="Launch Date">Launch Date</th>
                                    <th scope="col" class="sort" data-sort="Action">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php 
                    $sql = $category->getsubcategory();
                    if($sql=='0')
                    {
                        echo "No Data Available";
                    }
                    else {
                        $i=1;
                        foreach($sql as $result)
                        {
                           echo "<tr>";
                           $select = $category->getcategory($result['prod_parent_id']);
                           foreach($select as $categories)
                           {
                               echo "<td>$categories[prod_name]</td>";
                           }
                            
                           
                            echo "<td>$result[prod_name]</td>";
                            if($result['prod_available']=='1')
                            {
                               echo "<td><span class='badge badge-dot mr-4'>
                               <i class='bg-success'></i>
                               <span class='status'>Available</span>
                                           </span></td>";
                            }
                            else{
                               echo "<td><span class='badge badge-dot mr-4'>
                               <i class='bg-warning'></i>
                               <span class='status'>Unvailable</span>
                                           </span></td>";
                            }
                            echo"<td>$result[prod_launch_date]</td>";
                            echo "<td><button type='button' class='btn btn-warning'>EDIT</button>
                                   <button type='button' class='btn btn-danger'>DELETE</button></td>";
                            echo "</tr>";
                            $i++;
                        }
                    }
                   ?>
                            </tbody>
                        </table>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include('footer.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('#subcategorytable').DataTable();
});
</script>
