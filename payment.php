<?php include 'inc/header.php'; ?>
<?php
  $login = Session::get("cuslogin");
  if ($login != true) {
     header("Location:login.php");
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
  .payment{
    width: 550px; min-height: 200px; text-align: center; border: 1px solid #ddd; margin: 0 auto;
  }
  .payment h2{
    border: 1px solid #ddd; margin-bottom: 40px; padding-bottom: 10px;
  }
  .payment a{
    background: #ff0000; font-size: 25px; padding: 5px 30px; border-radius: 5px; color: #fff;
  }
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="payment">
          <h2>Choose a payment option</h2>
          <a href="paymentoffline.php">Offline Payment</a>
          <a href="paymentonline.php">Online Payment</a>
        </div>
 		</div>
 	</div>
	</div>
   <?php include 'inc/footer.php'; ?>
