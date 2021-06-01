<?php include 'inc/header.php'; ?>
<?php
  $login = Session::get("cuslogin");
  if ($login != true) {
     header("Location:login.php");
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Order</title>
  </head>
  <body>
    <div class="">
      <h1 style="font-size:25px; padding:10px;">Your Order Details</h1>
      <table class="tblone">
        <tr>
          <th>No.</th>
          <th>Product Name</th>
          <th>Image</th>
          <th>Quantity</th>
          <th>Total Price</th>
          <th>Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        <?php
        $cmrId = Session::get("cmrId");
        $getOrder = $ct->getOrderProduct($cmrId);
          if($getOrder){
            $i = 0;
            while($result = $getOrder->fetch_assoc()){
              $i++;
         ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td> <a href="preview.php?proId=<?php echo $result['productId']; ?>"><?php echo $result['productName']; ?></a> </td>
          <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
          <td><?php echo $result['quantity']; ?></td>
          <td>
            <?php
              $total = $result['price'] * $result['quantity'];
              echo $total;
             ?>
          </td>
          <td><?php echo $fm->formatDate($result['date']); ?></td>
          <td><?php
            if ($result['status'] == 0) {
              echo "Pending";
            }elseif ($result['status'] == 1) {
              echo "Approved";
            }else {
              echo "Unknown Sorry!";
            }
          ?></td>
            <?php
            if ($result['status'] == 1) { ?>
              <td><a onclick="return confirm('Are you sure to delete!');" href="">X</a></td>
            <?php } else { ?>
              <td>N/A</td>
            <?php } ?>
        </tr>
      <?php } }?>
    </div>
  </body>
</html>
