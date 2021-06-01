<?php include 'inc/header.php'; ?>
<?php
    if(isset($_GET['delpro'])){
      $id = $_GET['delpro'];
      $delProduct = $ct->delProductByCart($id);
    }
 ?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $cartId = $_POST['cartId'];
      $quantity = $_POST['quantity'];
      $updateCart = $ct->updateCart($quantity,$cartId);
      if($quantity <= 0){
        $delProduct = $ct->delProductByCart($cartId);
      }
    }
 ?>

 <?php
    if (!isset($_GET['id'])) {
      echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
    }
  ?>


 <div class="main">
    <div class="content">
    	<div class="cartoption">
			<div class="cartpage">
			    	<h2>Your Cart</h2>

            <?php
                if (isset($updateCart)) {
                  echo $updateCart;
                }
             ?>
            <?php
                if (isset($delProduct)) {
                  echo $delProduct;
                }
             ?>

						<table class="tblone">
							<tr>
								<th width="5%">SL.</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="10%">Price</th>
								<th width="20%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
              <?php
                $getPro = $ct->getCartProduct();
                if($getPro){
                  $i = 0;
                  $subTotal = 0;
                  while($result = $getPro->fetch_assoc()){
                    $i++;
                    $total = 0;
               ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td> <a href="preview.php?proId=<?php echo $result['productId']; ?>"><?php echo $result['productName']; ?></a> </td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td><?php echo $result['price']; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
                <?php
                  $total = $result['quantity'] * $result['price'];
                  $subTotal += $total;
                  Session::set("sum",$subTotal);
                 ?>
								<td><?php echo $total; ?></td>
								<td><a onclick="return confirm('Are you sure to delete!');" href="?delpro=<?php echo $result['cartId']; ?>">X</a></td>
							</tr>
            <?php } }?>

						</table>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$<?php echo $subTotal; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>5%</td>
							</tr>
              <?php
                $tax = $subTotal * (5/100);
                $grandTotal = $subTotal+$tax;
               ?>
							<tr>
								<th>Grand Total :</th>
								<td>$<?php echo $grandTotal; ?></td>
							</tr>
					   </table>
             <?php echo session_id(); ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>
       <div class="clear"></div>
    </div>
 </div>
</div>
  <?php include 'inc/footer.php'; ?>
