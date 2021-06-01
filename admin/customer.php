<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Customer.php');
?>
<?php

  if(!isset($_GET['custid']) || $_GET['custid'] == null){
    echo "<script> window.location = 'Inbox.php'; </script>";
  }else{
    $id = $_GET['custid'];
  }
  // if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //   $catName = $_POST['catName'];
  //   $updatecat = $cat->catUpdate($catName,$id);
  // }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
               <div class="block copyblock">
                 <?php
                    // if(isset($updatecat)){
                    //   echo $updatecat;
                    // }
                  ?>
                  <?php
                    $cus = new Customer();
                    $getCust = $cus->getCustomerData($id);
                    if($getCust){
                      while($result = $getCust->fetch_assoc()){
                  ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>Name</td>
                            <td>
                                <input readonly type="text" name="name" value=" <?php echo $result['name']; ?> " class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                <input readonly type="text" name="address" value=" <?php echo $result['address']; ?> " class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>
                                <input readonly type="text" name="city" value=" <?php echo $result['city']; ?> " class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zip</td>
                            <td>
                                <input readonly type="text" name="zip" value=" <?php echo $result['zip']; ?> " class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>
                                <input readonly type="text" name="phone" value=" <?php echo $result['phone']; ?> " class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input readonly type="text" name="email" value=" <?php echo $result['email']; ?> " class="medium" />
                            </td>
                        </tr>
						             <tr>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php
                    }
                  }
                 ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>
