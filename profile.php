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

</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
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
   <?php include 'inc/footer.php'; ?>
