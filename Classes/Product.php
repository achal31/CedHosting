<?php
// session_start();

include_once('Dbcon.php');
class Product
{
    
    function __construct()
    {
        $conn      = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->dbh = $conn;
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    /*-------------------FUNCTION TO GET CATEGORY AND CATEGORY NAME ON THE CREATE CATEGORY PAGE-------------*/
    public function getcategory($type)
    {   

        /*------------CONDITION FOR THE SELECT ELEMENT-----------------*/
        if($type=='0')
        {
          $selectedcategory= mysqli_query($this->dbh, "SELECT * FROM tbl_product where `prod_parent_id`='$type'");
        }
        /*-------------CONDITION FOR GETING THE CATEGORY NAME IN THE DATATABLE ---------------*/
        else{
            $selectedcategory= mysqli_query($this->dbh, "SELECT * FROM tbl_product where `id`='$type'");
        
        }
        if (mysqli_num_rows($selectedcategory) > 0)
        {
            return $selectedcategory;
        }
        else
        {
            return 0;
        }
    }

    /*----------FUNCTION TO INSERT THE NEW PRODUCT TO THE DATABASE----------------*/
    public function addsubcategory($subcategory,$selectedcategory,$categoryhref)
    {
        $selectedcategoryid= mysqli_query($this->dbh, "SELECT * FROM tbl_product where `prod_name`='$subcategory'");
        $category = mysqli_fetch_assoc($selectedcategoryid);
        if($category==0)
        {
        $returncategory= mysqli_query($this->dbh, "INSERT INTO tbl_product (prod_parent_id,prod_name,link,prod_available,prod_launch_date) VALUES('$selectedcategory','$subcategory','$categoryhref','1',now())");
      return 1;
        }
        return 0;
    }

    /*---------------------FUNCTION TO GET THE SUBCATEGORY OF THE CATEGORY-----------------------*/
    public function getsubcategory()
    {

        /*---------------------QUERY TO PICK THE CATEGORY PROD_PARENT_ID-----------------------------*/
        $selectedcategoryid= mysqli_query($this->dbh, "SELECT * FROM tbl_product where `prod_parent_id`='0'");
        $category = mysqli_fetch_assoc($selectedcategoryid);
        if($category>0)
        {
            /*-------------------QUERY TO GET THE SUBCATEGORY WHICH IS EQUAL TO THE ID OF CATEGORY--------------*/
        $selectsubcategory= mysqli_query($this->dbh, "SELECT * FROM tbl_product where `prod_parent_id`='$category[id]'");
        if (mysqli_num_rows($selectsubcategory) > 0)
        {
            return $selectsubcategory;
        }
        else
        {
            return 0;
        }
        }
    }

    /*---------------------------FUNCTION TO DELETE THE SUBCATEGORY---------------------------------*/
    public function deleteitem($itemid)
    {
        $deletecategory=mysqli_query($this->dbh, "DELETE FROM `tbl_product` where `id`='$itemid'");

        
    }

    /*--------------------------FUNCTION USED TO UPDATE THE SUBCATEGORY VALUES---------------------*/
    public function updatesubcategory($id,$name,$href,$status)
    {
        $sql=mysqli_query($this->dbh,"SELECT * FROM tbl_product where prod_name='$name' and id!='$id'");
        $result=$sql->num_rows;
        if($result==0)
        {
        $updatesubcategory=mysqli_query($this->dbh, "UPDATE tbl_product SET `prod_name`='$name',`link`='$href',`prod_available`='$status' WHERE `id`='$id'");
        if($updatesubcategory)
        {
            return 1;
        }else {
        return 0;
        }
    }
        else{
            return 0;
        }
    
    }

    public function insertproduct($productsubcategoryid,$productname,$producturl,$productmonthlyprice,$productannualprice,$productsku,$feature_encode)
    {
        $instproduct= mysqli_query($this->dbh, "INSERT INTO tbl_product (prod_parent_id,prod_name,link,prod_available,prod_launch_date) VALUES('$productsubcategoryid','$productname','$producturl','1',now())");
        $last_id = mysqli_insert_id($this->dbh);
        if($instproduct)
        {
            $instproductdetail= mysqli_query($this->dbh, "INSERT INTO `tbl_product_description`(`prod_id`,`description`,`mon_price`,`annual_price`,`sku`) VALUES('$last_id','$feature_encode','$productmonthlyprice','$productannualprice','$productsku')");
            if($instproductdetail)
            {
                return 1;
            }
            else {
               return 0;
            }
        }
        else{
            return 0;
        }
    }

    public function fetchproducttable()
    {
        $sql=mysqli_query($this->dbh,"SELECT * FROM `tbl_product` WHERE `prod_parent_id`!=0 AND `prod_parent_id`!=1");
        if (mysqli_num_rows($sql) > 0)
        {
            return $sql;
        }
        else
        {
            return 0;
        }
    }
}