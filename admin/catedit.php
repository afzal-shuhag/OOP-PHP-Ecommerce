<?php include '../classes/Category.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php

  if(!isset($_GET['catId']) || $_GET['catId'] == null){
    echo "<script> window.location = 'catlist.php'; </script>";
  }else{
    $id = $_GET['catId'];
  }
  $cat = new Category();
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $catName = $_POST['catName'];
    $updatecat = $cat->catUpdate($catName,$id);
  }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock">
                 <?php
                    if(isset($updatecat)){
                      echo $updatecat;
                    }
                  ?>
                  <?php
                    $getCat = $cat->getCatById($id);
                    if($getCat){
                      while($result = $getCat->fetch_assoc()){
                  ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="text" name="catName" value=" <?php echo $result['catName']; ?> " class="medium" />
                            </td>
                        </tr>
						             <tr>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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
