<?php include 'inc/header.php'; ?>
<?php
  $login = Session::get("cuslogin");
  if ($login != true) {
     header("Location:login.php");
  }
 ?>

 <?php

  if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $id = Session::get("cmrId");
    $insertOrder = $ct->orderProduct($id);
    $deldata = $ct->delCustomerCart();
    header("Location:success.php");
  }

  ?>

<?php

  // if(!isset($_GET['proId']) || $_GET['proId'] == null){
  //   echo "<script> window.location = 'index.php'; </script>";
  // }else{
  //   $id = $_GET['proId'];
  // }
  // // $pd = new Product();
  // if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //   $quantity = $_POST['quantity'];
  //   $addCart = $ct->addToCart($quantity,$id);
  // }
 ?>

 <style media="screen">
   .tblone{
     width: :550px;
     margin: : 0 auto !important;
     border: 2px solid #ddd;
   }
   .division{
     width: 50%;
     float: left;
   }
   .ordernow{
     overflow: hidden;
   }
   .ordernow a{
     width: 200px;
     margin: 20px auto 0;
     text-align: center;
     padding: 5px;
     font-size: 30px;
     display: block;
     background: #ff0000;
     color: #fff;
     border-radius: 3px;
   }

 </style>

 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="division">
          <table class="tblone">
            <tr>
              <th>No</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total Price</th>
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
              <td>$<?php echo $result['price']; ?></td>
              <td> <?php echo $result['quantity']; ?></td>
              <?php
                $total = $result['quantity'] * $result['price'];
                $subTotal += $total;
               ?>
              <td>$<?php echo $total; ?></td>
            </tr>
          <?php } }?>

          </table>
          <table style="float:right;text-align:left;width: 250px;
            margin: 5px 15px;
            border: 1px solid #ddd" width="40%">
            <tr>
              <th>Sub Total</th>
              <td>:</td>
              <td width="40px">$<?php echo $subTotal; ?></td>
            </tr>
            <tr>
              <th>VAT</th>
              <td>:</td>
              <td>5%</td>
            </tr>
            <?php
              $tax = $subTotal * (5/100);
              $grandTotal = $subTotal+$tax;
             ?>
            <tr>
              <th>Grand Total</th>
              <td>:</td>
              <td>$<?php echo $grandTotal; ?></td>
            </tr>
           </table>
           <div class="ordernow">
             <a href="?orderid=order">Order</a>
           </div>
        </div>
        <div class="division">
          <?php
            $id = Session::get("cmrId");
            $getData = $cmr->getCustomerData($id);
            if ($getData) {
              $result = $getData->fetch_assoc();
            }
           ?>
          <table class="tblone">
            <tr>
              <td colspan="3"> <h2>Your Profile Details</h2> </td>
            </tr>
            <tr>
              <td width="20%">Name</td>
              <td width="5%">:</td>
              <td><?php echo $result['name']; ?></td>
            </tr>
            <tr>
              <td>Phone</td>
              <td>:</td>
              <td><?php echo $result['phone']; ?></td>
            </tr>
            <tr>
              <td>Email</td>
              <td>:</td>
              <td><?php echo $result['email']; ?></td>
            </tr>
            <tr>
              <td>Address</td>
              <td>:</td>
              <td><?php echo $result['address']; ?></td>
            </tr>
            <tr>
              <td>City</td>
              <td>:</td>
              <td><?php echo $result['city']; ?></td>
            </tr>
            <tr>
              <td>Zip Code</td>
              <td>:</td>
              <td><?php echo $result['zip']; ?></td>
            </tr>
            <tr>
              <td>Country</td>
              <td>:</td>
              <td><?php echo $result['country']; ?></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td>:</td>
              <td> <a href="editprofile.php?id=<?php echo $id; ?>">Update Details</a> </td>
            </tr>
          </table>
        </div>
 		</div>
 	</div>
	</div>
   <?php include 'inc/footer.php'; ?>
