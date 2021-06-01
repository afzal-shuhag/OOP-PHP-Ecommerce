<?php include 'inc/header.php'; ?>

<?php
  $login = Session::get("cuslogin");
  if ($login == true) {
    header("Location:order.php");
  }
 ?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">

         <?php

         // $cmr = new Customer();
         if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
           $email = $_POST['email'];
           $pass = $_POST['pass'];
           $customerLogin = $cmr->customerLogin($email,$pass);
         }

           ?>

           <?php

             // $a1 = new Adminlogin();
             // if($_SERVER['REQUEST_METHOD'] == 'POST'){
             //   $adminUser = $_POST['adminUser'];
             //   $adminPass = md5($_POST['adminPass']);
             //   $loginchk = $a1->adminLogin($adminUser,$adminPass);
             // }

           ?>

        	<h3>Existing Customers</h3>
          <?php
            if (isset($customerLogin)) {
              echo $customerLogin;
            }
           ?>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post" id="member">
                	<input name="email" placeholder="Email" type="text">
                  <input name="pass" placeholder="Password" type="password">
                  <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
                  </div>
          </form>


      <?php

      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
        $customerReg = $cmr->customerRegistration($_POST);
      }

        ?>

    	<div class="register_account">
        <?php
          if (isset($customerReg)) {
            echo $customerReg;
          }
         ?>
    		<h3>Register New Account</h3>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name"/>
							</div>

							<div>
							   <input type="text" name="city" placeholder="City">
							</div>

							<div>
								<input type="text" name="zip" placeholder="Zip-Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="Email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address">
						</div>
		    		<div>
              <input type="text" name="country" value="Country">
				 </div>

		           <div>
		          <input type="text" name="phone" placeholder="Phone">
		          </div>

				  <div>
					<input type="text" name="pass" placeholder="Password">
				</div>
		    	</td>
		    </tr>
		    </tbody></table>
		   <div class="search"><div><button class="grey" Name="register">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>
       <div class="clear"></div>
    </div>
 </div>
</div>
  <?php include 'inc/footer.php'; ?>
