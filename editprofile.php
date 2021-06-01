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

<?php

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $id = Session::get("cmrId");
    $updateCmr = $cmr->customerUpdate($_POST,$id);
  }

?>

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
         <form class="" action="" method="post">
           <table class="tblone">
             <?php
               if (isset($updateCmr)) {
                 echo $updateCmr;
               }
              ?>
             <tr>
               <td colspan="3"> <h2>Update Profile Details</h2> </td>
             </tr>
             <tr>
               <td width="20%">Name</td>
               <td> <input type="text" name="name" value="<?php echo $result['name']; ?>"> </td>
             </tr>
             <tr>
               <td>Phone</td>
               <td> <input type="text" name="phone" value="<?php echo $result['phone']; ?>"> </td>
             </tr>
             <tr>
               <td>Email</td>
               <td> <input type="text" name="email" value="<?php echo $result['email']; ?>"> </td>
             </tr>
             <tr>
               <td>Address</td>
               <td> <input type="text" name="address" value="<?php echo $result['address']; ?>"> </td>
             </tr>
             <tr>
               <td>City</td>
               <td> <input type="text" name="city" value="<?php echo $result['city']; ?>"> </td>
             </tr>
             <tr>
               <td>Zip Code</td>
               <td> <input type="text" name="zip" value="<?php echo $result['zip']; ?>"> </td>
             </tr>
             <tr>
               <td>Country</td>
               <td> <input type="text" name="country" value="<?php echo $result['country']; ?>"> </td>
             </tr>
             <tr>
               <td></td>
               <td> <input type="submit" name="submit" value="Save"> </td>
             </tr>
           </table>
         </form>
 		</div>
 	</div>
	</div>
   <?php include 'inc/footer.php'; ?>
