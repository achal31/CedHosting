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
/*-----------------TO DELETE THE SELECTED SUB-CATEGORY-----------------------*/
if(isset($_GET['delete']))
{
    $subcategoryid=$_GET['id'];
$category->deleteitem($subcategoryid);
}

/*-----------------INSERTING SUBCATEGORY INSIDE THE DATABASE------------------*/

if(isset($_POST['addsubcategory']))
{
    $subcategory=$_POST['subcategory'];
    $selectedcategory=$_POST['selectedcategory'];
    $sql = $category->addsubcategory($subcategory,$selectedcategory);
    if($sql=='1')
    {
       $message="<div class='alert alert-success alert-dismissible fade show' role='alert' id='errormsg'>
       <strong id='alertcontent'>The SubCategory Has Been Added Successfully!!</strong>
       <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
         <span aria-hidden='true'>&times;</span>
       </button>
     </div>";
    }
    else {
        $message="<div class='alert alert-danger alert-dismissible fade show' role='alert' id='errormsg'>
<strong id='alertcontent'>The SubCategory Already Exist!!</strong>
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
                            <h6 class="h2 text-white d-inline-block mb-0">Create Sub-Category</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Product</a></li>
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

         <?php if(isset($_POST['addsubcategory']))
         {
            echo $message;
         }else if(isset($_GET['delete']))
         {
echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' id='errormsg'>
<strong id='alertcontent'>The SubCategory Has Been Deleted Successfully!!!</strong>
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button>
</div>";
         }
         else if(isset($_GET['static']))
                            {
                                echo "  <div class='alert alert-success alert-dismissible fade show' role='alert' id='errormsg'>
    <strong id='alertcontent'>The SubCategory Has Been Updated Successfully!!!</strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
                           }?> 
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
                          
                                    <input type="text" class="form-control" name="subcategory" pattern='^[a-zA-Z\s]*[a-zA-Z]+[.a-zA-Z0-9\-]*$' placeholder="Enter A Sub Category" required>
                                  
  
<div class="mb-5">
<h3 class="mb-0 text-dark">HTML</h3>
         <textarea id="editor"></textarea>
</div>
       
    
    


                                    <div class="input-group-prepend">
                                        <input type="submit" class="btn" id="button-addon1" name="addsubcategory" value="SAVE SUB CATEGORY">
                                  
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h3 class="mb-0">SUB CATEGORY LIST</h3>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                        <table class="table align-items-center table-flush mx-auto" id="subcategorytable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-white" data-sort="Category">Category</th>
                                    <th scope="col" class="text-white" data-sort="Sub Category">Sub Category</th>
                                    <th scope="col" class="text-white" data-sort="Status">Status</th>
                                    <th scope="col" class="text-white" data-sort="Launch Date">Launch Date</th>
                                    <th scope="col" class="text-white" data-sort="Action">Action</th>
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
                            echo "<td><button type='button' class='btn btn-warning'><a class='text-white' href='editcategory.php?edit=1&id=$result[id]'>EDIT</a></button>
                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalCenter$result[id]'>DELETE</button>
                          </td>";
                            echo "</tr>";
                            $i++;
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
<?php
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
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>



<script>
$(document).ready(function() {
    tinymce.init({
  selector: "textarea#editor",
  skin: "bootstrap",
  plugins: "lists, link, image, media",
  toolbar:
    "h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help",
  menubar: false,
  setup: (editor) => {
    // Apply the focus effect
    editor.on("init", () => {
      editor.getContainer().style.transition =
        "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out";
    });
    editor.on("focus", () => {
      (editor.getContainer().style.boxShadow =
        "0 0 0 .2rem rgba(0, 123, 255, .25)"),
        (editor.getContainer().style.borderColor = "#80bdff");
    });
    editor.on("blur", () => {
      (editor.getContainer().style.boxShadow = ""),
        (editor.getContainer().style.borderColor = "");
    });
  },
});
  
    $('#subcategorytable').DataTable();
});
</script>
