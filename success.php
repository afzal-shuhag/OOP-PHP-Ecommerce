<?php include 'inc/header.php'; ?>
<?php
  // $login = Session::get("cuslogin");
  // if ($login != true) {
  //    header("Location:login.php");
  // }
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
  .success{
    width: 550px; min-height: 200px; text-align: center; border: 1px solid #ddd; margin: 0 auto;
  }
  .success h2{
    border: 1px solid #ddd; margin-bottom: 40px; padding-bottom: 10px;
  }
  .success p{
    line-height: 25px;

  }
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="success">
          <h2>Success</h2>

          <?php
            $cmrId = Session::get("cmrId");
            $amount = $ct->payableAmount($cmrId);
            if ($amount) {
              $sum = 0;
              while ($result = $amount->fetch_assoc()) {
                $price = $result['price'];
                $sum = $sum + $price;
              }
            }
           ?>

          <p>Total payable amount (including VAT) : $
            <?php
              $vat = $sum * (5/100);
              $total = $sum + $vat;
              echo $total;
             ?>
          </p>
          <p>Thanks for purchasing from us. We will contact you soon. Here is your order details.. <a href="orderdetails.php">Visit Here</a> </p>
        </div>
 		</div>
 	</div>
	</div>
   <?php include 'inc/footer.php'; ?>
