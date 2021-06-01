 <?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../lib/Database.php');
  include_once ($filepath.'/../helpers/Format.php');
  // include_once 'lib/Database.php';
  // include_once 'helpers/Format.php';
?>

<?php

  /**
   *
   */
  class Cart
  {

    private $db;
    private $fm;

    function __construct()
    {
      $this->db = new Database();
      $this->fm = new Format();
    }

    public function addToCart($quantity,$id)
    {
      $quantity = $this->fm->validation($quantity);
      $quantity = mysqli_real_escape_string($this->db->link,$quantity);
      $productId = mysqli_real_escape_string($this->db->link,$id);
      $sId = session_id();

      $squery = " SELECT * FROM tbl_product WHERE productId = '$productId' ";
      $result = $this->db->select($squery)->fetch_assoc();

      $productName = $result['productName'];
      $price = $result['price'];
      $image = $result['image'];

      $chquery = " SELECT * FROM tbl_cart WHERE productId = '$productId' AND  sId = '$sId' ";
      $result = $this->db->select($chquery);
      if($result != null){
        $msg = "Already in Cart";
        return $msg;
      }else{
        $query = "INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image)
        VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
        $insert = $this->db->insert($query);
        if($insert){
          header("Location:cart.php");
        }else{
            header("Location:index.php");
        }
      }

    }

    public function getCartProduct()
    {
      $sId = session_id();
      $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
      $result = $this->db->select($query);
      if ($result) {
        return $result;
      }else {
        header("Location:index.php");
      }
    }

    public function updateCart($quantity,$cartId)
    {
      $quantity = mysqli_real_escape_string($this->db->link,$quantity);
      $cartId = mysqli_real_escape_string($this->db->link,$cartId);

      $query = "
           UPDATE tbl_cart
           SET
           quantity = '$quantity'

           WHERE cartId = '$cartId'
      ";
      $cartUpdate = $this->db->update($query);
      if($cartUpdate){
        $msg = " <span class='success'>Cart upated successffully...</span> ";
        return $msg;
      }else{
        $msg = " <span class='error'>Failed...</span> ";
        return $msg;
      }

    }

    public function delProductByCart($id)
    {
      // $query = " SELECT * FROM tbl_cart WHERE cartId = '$id' ";
      // $getData = $this->db->select($query);
      // if($getData){
      //   while($value = $getData->fetch_assoc()){
      //     $delImage = $value['image'];
      //     unlink($delImage);
      //   }
      // }
      $delquery = " DELETE FROM tbl_cart WHERE cartId = '$id' ";
      $deldata = $this->db->delete($delquery);
      if($deldata){
        $msg = " <span class='success'>Product deleted successffully...</span> ";
        return $msg;
      }else{
        $msg = " <span class='error'>Failed...</span> ";
        return $msg;
      }
    }

    public function getLatestFromIphone()
    {
      $query = "SELECT * FROM tbl_product WHERE brandId = '5' ORDER BY productId DESC LIMIT 1";
      $result = $this->db->select($query);
      return $result;
    }

    public function getLatestFromAcer()
    {
      $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
      $result = $this->db->select($query);
      return $result;
    }

    public function getLatestFromCanon()
    {
      $query = "SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId DESC LIMIT 1";
      $result = $this->db->select($query);
      return $result;
    }

    public function getLatestFromSamsung()
    {
      $query = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId DESC LIMIT 1";
      $result = $this->db->select($query);
      return $result;
    }

    public function delCustomerCart()
    {
      $sId = session_id();
      $query = " DELETE FROM tbl_cart WHERE sId = '$sId' ";
      $this->db->delete($query);
    }

    public function checkCart()
    {
      $sId = session_id();
      $query = " SELECT * FROM tbl_cart WHERE sId = '$sId' ";
      $result = $this->db->select($query);
      return $result;
    }

    public function orderProduct($id)
    {
      $sId = session_id();
      $query = " SELECT * FROM tbl_cart WHERE sId = '$sId' ";
      $getPro = $this->db->select($query);
      if ($getPro) {
        while ($result = $getPro->fetch_assoc()) {
          $productId = $result['productId'];
          $productName = $result['productName'];
          $quantity = $result['quantity'];
          $price = $result['price'];
          $image = $result['image'];

          $query = "INSERT INTO tbl_order(cmrId,productId,productName,quantity,price,image)
          VALUES('$id','$productId','$productName','$quantity','$price','$image')";
          $insert = $this->db->insert($query);
        }
      }
    }

    public function payableAmount($cmrId)
    {
      $query = " SELECT * FROM tbl_order WHERE cmrId = '$cmrId' AND date = now() ";
      $result = $this->db->select($query);
      return $result;
    }

    public function getOrderProduct($cmrId)
    {
      $query = " SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ORDER BY productId DESC ";
      $result = $this->db->select($query);
      return $result;
    }

    public function checOrder($cmrId)
    {
      $query = " SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ";
      $result = $this->db->select($query);
      return $result;
    }

    public function getAllOrderProduct($value='')
    {
      $query = " SELECT * FROM tbl_order ORDER BY date DESC ";
      $result = $this->db->select($query);
      return $result;
    }

  }


 ?>
