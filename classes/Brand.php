<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../lib/Database.php');
  include_once ($filepath.'/../helpers/Format.php');
  // include_once '../lib/Database.php';
  // include_once '../helpers/Format.php';
?>

<?php

  /**
   *
   */
  class Brand
  {

    function __construct()
    {
      $this->db = new Database();
      $this->fm = new Format();
    }

    public function brandInsert($brandName)
    {
      $brandName = $this->fm->validation($brandName);

      $brandName = mysqli_real_escape_string($this->db->link,$brandName);

      if(empty($brandName)){
        $msg = "Insert a Brand name!!";
        return $msg;
      }else{
        $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
        $brandInsert = $this->db->insert($query);
        if($brandInsert){
          $msg = " <span class='success'>Brand inserted successffully...</span> ";
          return $msg;
        }else{
          $msg = " <span class='error'>Failed...</span> ";
          return $msg;
        }
      }
    }

    public function getAllBrand()
    {
      $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
      $result = $this->db->select($query);
      return $result;
    }

    public function getBrandById($id)
    {
        $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function brandUpdate($brandName,$id)
    {
      echo "Okay";
      $brandName = $this->fm->validation($brandName);

      $brandName = mysqli_real_escape_string($this->db->link,$brandName);
      $brandId = mysqli_real_escape_string($this->db->link,$brandId);

      if(empty($brandName)){
        $msg = "Insert a Brand name!!";
        return $msg;
      }else{
        $query = "
            UPDATE tbl_brand
            SET brandName = '$brandName'
            WHERE brandId = '$id'
        ";
        $brandUpdate = $this->db->insert($query);
        if($brandUpdate){
          $msg = " <span class='success'>Brand  updated successffully...</span> ";
          return $msg;
        }else{
          $msg = " <span class='error'>Failed...</span> ";
          return $msg;
        }
      }
    }

    public function delBrandById($id)
    {
      $query = " DELETE FROM tbl_brand WHERE brandId = '$id' ";
      $result = $this->db->delete($query);
      if($result){
        $msg = "<span class='success'>Deleted Successfully</span>";
        return $msg;
      }else{
        $msg = "<span class='error'>Something went wrong</span>";
        return $msg;
      }
    }

}

 ?>
