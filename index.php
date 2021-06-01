<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<?php
// include 'lib/Database.php';
// include 'helpers/Format.php';
// include 'classes/Product.php';
// include 'classes/Cart.php';

// $db = new Database();
// $fm = new Format();
// $pd = new Product();
// $ct = new Cart();
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
          <?php
            $getFpd = $pd->getFeaturedProduct();
            if ($getFpd) {
              while ($result = $getFpd->fetch_assoc()) {
           ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?proId=<?php echo $result['productId']; ?>"><img style="	height: 200px;" src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['productId'], 60); ?></p>
					 <p><span class="price">$<?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="preview.php?proId=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>

      <?php } } ?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
        <?php
          $getNpd = $pd->getNewProduct();
          if ($getNpd) {
            while ($result = $getNpd->fetch_assoc()) {
         ?>
				<div class="grid_1_of_4 images_1_of_4">
          <a href="preview.php?proId=<?php echo $result['productId']; ?>"><img style="	height: 200px;" src="admin/<?php echo $result['image']; ?>" alt="" /></a>
          <h2><?php echo $result['productName']; ?></h2>
          <p><?php echo $fm->textShorten($result['productId'], 60); ?></p>
          <p><span class="price">$<?php echo $result['price']; ?></span></p>
            <div class="button"><span><a href="preview.php?proId=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
      <?php } } ?>
			</div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>
