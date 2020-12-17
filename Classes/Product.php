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
    public function addsubcategory($subcategory,$selectedcategory)
    {
        $selectedcategoryid= mysqli_query($this->dbh, "SELECT * FROM tbl_product where `prod_name`='$subcategory'");
        $category = mysqli_fetch_assoc($selectedcategoryid);
        if($category==0)
        {
        $returncategory= mysqli_query($this->dbh, "INSERT INTO tbl_product (prod_parent_id,prod_name,prod_available,prod_launch_date) VALUES('$selectedcategory','$subcategory','1',now())");
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

    public function selectsubcategory($id)
    {
        $selectsubcategory= mysqli_query($this->dbh, "SELECT * FROM tbl_product where `id`='$id'");
        if (mysqli_num_rows($selectsubcategory) > 0)
        {
            return $selectsubcategory;
        }
        else
        {
            return 0;
        }
    }
    /*---------------------------FUNCTION TO DELETE THE SUBCATEGORY---------------------------------*/
    public function deleteitem($itemid)
    {
        $deletecategory=mysqli_query($this->dbh, "DELETE FROM `tbl_product` where `id`='$itemid'");
 
    }

    /*--------------------------FUNCTION USED TO UPDATE THE SUBCATEGORY VALUES---------------------*/
    public function updatesubcategory($id,$name,$status)
    {
        $sql=mysqli_query($this->dbh,"SELECT * FROM tbl_product where prod_name='$name' and id!='$id'");
        $result=$sql->num_rows;
        if($result==0)
        {
        $updatesubcategory=mysqli_query($this->dbh, "UPDATE tbl_product SET `prod_name`='$name',`prod_available`='$status' WHERE `id`='$id'");
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

    /*-----------------FUNCTION TO INSERT THE NEW PRODUCT IN THE DATABASE----------------------------------*/
    public function insertproduct($productsubcategoryid,$productname,$producturl,$productstatus,$productmonthlyprice,$productannualprice,$productsku,$feature_encode)
    {
        $instproduct= mysqli_query($this->dbh, "INSERT INTO tbl_product (prod_parent_id,prod_name,html,prod_available,prod_launch_date) VALUES('$productsubcategoryid','$productname','$producturl','$productstatus',now())");
        $last_id = mysqli_insert_id($this->dbh);
        if($instproduct)
        {
            $instproductdetail= mysqli_query($this->dbh, "INSERT INTO `tbl_product_description`(`prod_id`,`description`,`mon_price`,`annual_price`,`sku`) VALUES('$last_id','$feature_encode','$productmonthlyprice','$productannualprice','$productsku')");
            if($instproductdetail)
            {
                echo "<script>window.location.href='viewproduct.php?productadded=1'</script>";
            }
            else {
               return 0;
            }
        }
        else{
            return 0;
        }
    }

    /*---------------FUNCTION TO SHOW THE PRODUCT TABLE ON VIEW PRODUCT PAGE-----------------------------*/
    public function fetchproducttable()
    {
        $sql=mysqli_query($this->dbh,"SELECT tbl_product_description.id,prod_id,description,mon_price,annual_price,sku,tbl_product.id,prod_parent_id,prod_name,html,prod_available,prod_launch_date FROM tbl_product_description INNER JOIN tbl_product ON tbl_product_description.prod_id =tbl_product.id");
        if (mysqli_num_rows($sql) > 0)
        {
            return $sql;
        }
        else
        {
            return 0;
        }
    }

    /*--------------------FUNCTION TO DELETE THE PRODUCT FROM THE DATABASE----------------------------------------*/
    public function deleteproduct($productid)
    {
        $deletecategory=mysqli_query($this->dbh, "DELETE tbl_product, tbl_product_description FROM tbl_product INNER JOIN tbl_product_description ON tbl_product.id=tbl_product_description.prod_id WHERE tbl_product.id='$productid'");
    }

    /*-------------------FUNCTION TO SHOW PRODUCT TO THE USER,THAT HE WANT TO EDIT-----------------------*/
    public function fetchproducttoupdate($productid)
    {
        $sql=mysqli_query($this->dbh,"SELECT tbl_product_description.id,prod_id,description,mon_price,annual_price,sku,tbl_product.id,prod_parent_id as productid,prod_name,link,prod_available,prod_launch_date FROM tbl_product_description INNER JOIN tbl_product ON tbl_product_description.prod_id =tbl_product.id WHERE tbl_product.id='$productid'");
        if (mysqli_num_rows($sql) > 0)
        {
            return $sql;
        }
        else
        {
            return 0;
        } 
    }

    /*-------------------FUNCTION TO UPDATE THE PRODUCT DETAILS--------------------------*/

    public function updateproduct($productsubcategoryid,$productname,$producturl,$productstatus,$productmonthlyprice,$productannualprice,$productsku,$feature_encode,$prod_id)
    {
        $sql=mysqli_query($this->dbh,"UPDATE tbl_product_description as td INNER JOIN tbl_product as tp ON td.prod_id = tp.id SET
tp.prod_name = '$productname', tp.prod_parent_id ='$productsubcategoryid',tp.html = '$producturl',tp.prod_available ='$productstatus',
td.description = '$feature_encode', td.mon_price ='$productmonthlyprice',td.annual_price ='$productannualprice',td.sku ='$productsku' WHERE tp.id='$prod_id'");

    echo "<script>window.location.href='viewproduct.php?productupdate=1'</script>";
}

/*--------------------SHOWING DYNAMIC DATA TO THE USER ON THE USER PANEL-------------------------------------*/
public function showdynamicdata($productid)
    {
        $sql=mysqli_query($this->dbh,"SELECT tbl_product_description.id,prod_id,description,mon_price,annual_price,sku,tbl_product.id as product_id,prod_parent_id,prod_name,html,prod_available,prod_launch_date FROM tbl_product_description INNER JOIN tbl_product ON tbl_product_description.prod_id =tbl_product.id WHERE tbl_product.prod_parent_id='$productid'");
        if (mysqli_num_rows($sql) > 0)
        {
            return $sql;
        }
        else
        {
            return 0;
        }
    }

    public function selecttheproduct($productid)
    {
        $sql=mysqli_query($this->dbh,"SELECT tbl_product_description.id,prod_id,description,mon_price,annual_price,sku,tbl_product.id as product_id,prod_parent_id,prod_name,html,prod_available,prod_launch_date FROM tbl_product_description INNER JOIN tbl_product ON tbl_product_description.prod_id =tbl_product.id WHERE tbl_product.id='$productid'");
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

