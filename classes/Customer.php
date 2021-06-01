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
  class Customer
  {

    private $db;
    private $fm;

    function __construct()
    {
      $this->db = new Database();
      $this->fm = new Format();
    }

    public function customerRegistration($data)
    {
      $name = mysqli_real_escape_string($this->db->link,$data['name']);
      $address = mysqli_real_escape_string($this->db->link,$data['address']);
      $city = mysqli_real_escape_string($this->db->link,$data['city']);
      $country = mysqli_real_escape_string($this->db->link,$data['country']);
      $phone = mysqli_real_escape_string($this->db->link,$data['phone']);
      $email = mysqli_real_escape_string($this->db->link,$data['email']);
      $pass= mysqli_real_escape_string($this->db->link,md5($data['pass']));
      $zip = mysqli_real_escape_string($this->db->link,$data['zip']);

      if($name == '' || $address == '' || $city == '' || $country == '' || $phone == '' || $email == '' || $pass == '' || $zip == ''){
        $msg = " <span class='error'>Fields must not be empty</span> ";
        return $msg;
      }

      $mailquery = " SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1 ";
      $mailchk = $this->db->select($mailquery);
      if ($mailchk != false) {
        $msg = " <span class='error'>Email already exists!</span> ";
        return $msg;
      }else {
        $query = "INSERT INTO tbl_customer(name,address,city,country,phone,email,pass,zip)
        VALUES('$name','$address','$city','$country','$phone','$email','$pass','$zip')";
        $customerInsert = $this->db->insert($query);
        if($customerInsert){
          $msg = " <span class='success'>Customer registration successffully done...</span> ";
          return $msg;
        }else{
          $msg = " <span class='error'>Failed...</span> ";
          return $msg;
        }
      }
    }

    public function customerLogin($email,$pass)
    {

      $email = $this->fm->validation($email);
      $pass = $this->fm->validation($pass);

      $email = mysqli_real_escape_string($this->db->link,$email);
      $pass= mysqli_real_escape_string($this->db->link,md5($pass));

      if (empty($email) || empty($pass)) {
        $msg = " <span class='error'>Fields must not be empty</span> ";
        return $msg;
      }else{

        $query = " SELECT * FROM tbl_customer WHERE email = '$email' AND pass = '$pass' ";
        $result = $this->db->select($query);
        if ($result != false) {
          $value = $result->fetch_assoc();
          Session::set("cuslogin", true);
          Session::set("cmrId", $value['id']);
          Session::set("cmrName", $value['name']);
          header("Location:cart.php");
        }else {
          $msg = " <span class='error'>Email and password doesn't match</span> ";
          return $msg;
        }

      }
    }

    public function getCustomerData($id)
    {
      $id = $id;
      $query = " SELECT * FROM tbl_customer WHERE id = '$id' ";
      $result = $this->db->select($query);
      return $result;
    }

    public function customerUpdate($data,$id)
    {
      $name = mysqli_real_escape_string($this->db->link,$data['name']);
      $address = mysqli_real_escape_string($this->db->link,$data['address']);
      $city = mysqli_real_escape_string($this->db->link,$data['city']);
      $country = mysqli_real_escape_string($this->db->link,$data['country']);
      $phone = mysqli_real_escape_string($this->db->link,$data['phone']);
      $email = mysqli_real_escape_string($this->db->link,$data['email']);
      $zip = mysqli_real_escape_string($this->db->link,$data['zip']);

      if($name == '' || $address == '' || $city == '' || $country == '' || $phone == '' || $email == '' || $zip == ''){
        $msg = " <span class='error'>Fields must not be empty</span> ";
        return $msg;
      } else {

          $query = "
             UPDATE tbl_customer
             SET
             name = '$name',
             address = '$address',
             city = '$city',
             country = '$country',
             phone = '$phone',
             email = '$email',
             zip = '$zip'

             WHERE id = '$id'
        ";
        $customerUpdate = $this->db->update($query);
        if($customerUpdate){
          $msg = " <span class='success'>Details upated successffully...</span> ";
          return $msg;
        }else{
          $msg = " <span class='error'>Failed...</span> ";
          return $msg;
        }
      }
    }



  }


 ?>
