<?php
  $filepath = realpath(dirname(__FILE__));
  include_once ($filepath.'/../lib/Database.php');
  include_once ($filepath.'/../helpers/Format.php');
  // include_once '../lib/Database.php';
  // include_once '../helpers/Format.php';
?>

<?php
  class Category{
    private $db;
    private $fm;

    function __construct()
    {
      $this->db = new Database();
      $this->fm = new Format();
    }

    public function catInsert($catName)
    {
      $catName = $this->fm->validation($catName);

      $catName = mysqli_real_escape_string($this->db->link,$catName);

      if(empty($catName)){
        $msg = "Insert a Categoryname!!";
        return $msg;
      }else{
        $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
        $catInsert = $this->db->insert($query);
        if($catInsert){
          $msg = " <span class='success'>Category inserted successffully...</span> ";
          return $msg;
        }else{
          $msg = " <span class='error'>Failed...</span> ";
          return $msg;
        }
      }
    }

    public function getAllCat()
    {
      $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
      $result = $this->db->select($query);
      return $result;
    }

    public function getCatById($id)
    {
        $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function catUpdate($catName,$id)
    {
      echo "Okay";
      $catName = $this->fm->validation($catName);

      $catName = mysqli_real_escape_string($this->db->link,$catName);
      $catId = mysqli_real_escape_string($this->db->link,$catId);

      if(empty($catName)){
        $msg = "Insert a Categoryname!!";
        return $msg;
      }else{
        $query = "
            UPDATE tbl_category
            SET catName = '$catName'
            WHERE catId = '$id'
        ";
        $catUpdate = $this->db->insert($query);
        if($catUpdate){
          $msg = " <span class='success'>Category updated successffully...</span> ";
          return $msg;
        }else{
          $msg = " <span class='error'>Failed...</span> ";
          return $msg;
        }
      }
    }

    public function delCatById($id)
    {
      $query = " DELETE FROM tbl_category WHERE catId = '$id' ";
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
