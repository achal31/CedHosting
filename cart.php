<?php include ('header.php');

?>
<div class="content">
        <div class="about-section">
            <div class="container">
              <h1><i class="fa fa-shopping-cart" style="font-size:35px;color:#E6653D"></i>CART</h1>
  <div class="table-responsive">
  <table  class="table align-items-center table-flush mx-auto text-center" id="carttable">
    <thead>
        <tr>
        <th>S.NO</th>
        <th>PRODUCT SKU</th>
        <th>PRODUCT NAME</th>
        <th>MONTHLY SUBSCRIPTION</th>
        <th>ANNUAL SUBSCRIPTION</th>
        <th>TOTAL DISK SPACE</th>
        <th>TOTAL DATA TRANSFER</th>
        <th>TOTAL DOMAIN</th>
        <th>TOTAL TECHNOLOGY</th>
        <th>MAIL BOX</th>
        <th>REMOVE</th>
        </tr>
        
    </thead>
    <tbody>
  
      <?php
      if(isset($_GET['removeid']))
      {
        
            $key=array_search($_GET['removeid'],$_SESSION['cart']);
            if($key!==false)
            unset($_SESSION['cart'][$key]);
            $_SESSION["cart"] = array_values($_SESSION["cart"]);
        } 
        
      
if(isset($_SESSION['cart']))
{
include_once ('Classes/Product.php');
$product = new Product();
$i=1;
$monthlytotal=0;
$annualtotal=0;
foreach ($_SESSION['cart'] as $id)
{
    $sql = $product->selecttheproduct($id);
    if ($sql == '0')
    {
        echo "No Data Available";
    }
    else
    {
       
        foreach ($sql as $result)
        {
            $monthlytotal=$monthlytotal+(int)$result['mon_price'];
            $annualtotal=$annualtotal+(int)$result['annual_price'];
            $productname = $result['prod_name'];
            $product_id = $result['product_id'];
            $decoded = json_decode($result['description']);
            $productfreedomain = $decoded->productfreedomain;
            $productweb = $decoded->productweb;
            $productbandwidth = $decoded->productbandwidth;
            $producttechnology = $decoded->producttechnology;
            $productmailbox = $decoded->productmailbox;
            $monthly = $result['mon_price'];
            $annual = $result['annual_price'];
            $productsku = $result['sku'];

?>

 

        <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $productsku; ?></td>
<td><?php echo $productname; ?></td>
<td>₹<?php echo $monthly; ?></td>
<td>₹<?php echo $annual; ?></td>
<td><?php echo $productweb; ?>GB</td>
<td><?php echo $productbandwidth; ?>00 GB</td>
<td><?php echo $productfreedomain; ?></td>
<td><?php echo $producttechnology; ?></td>
<td><?php echo $productmailbox; ?></td>
<td><button class="removebutton"><a href="cart.php?removeid=<?php echo $product_id; ?>">Remove</a></button></td>
        </tr>
    

<?php
        }

    }
    $i++;
}
?>
<tr>
<td colspan="3">Calculated charge:</td><td>₹<?php echo $monthlytotal; ?></td><td>₹<?php echo $annualtotal; ?></td>  
</tr>
<?php
}
else {
?>
<h1>Seems Like Your Cart is Empty</h1>
<?php } ?>
</tbody>
</table>

  </div>
     </div>
        </div>
</div>





<?php include ('footer.php'); ?>
