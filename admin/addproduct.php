<?php include('header.php');?>
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Icons</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Components</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Icons</li>
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
            <div class="row justify-content-center">
                <div class=" col ">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h3 class="mb-0">Add Products</h3>
                        </div>
                        <div class="card-body">
                            <div class="row icon-examples">
                            <form>
                            <div class="input-group mb-3">
                            <div class="input-group-append">
    <label class="input-group-text" for="inputGroupSelect02">Categories</label>
  </div>
                            <select class="mdb-select">
  <option value="1">Option 1</option>
  <option value="2">Option 2</option>
  <option value="3">Option 3</option>
</select>

</div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('footer.php'); ?>
            <script>
                $(document).ready(function() {
$('.mdb-select').materialSelect();
});
            </script>