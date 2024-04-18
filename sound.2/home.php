<?php

require_once dirname(__FILE__) . "/layout/header.php";


?>





<main class="l-main">
   <div class="marign-container">
      <div class="login-form bd-grid">
         <div class="login">
            <div class="login-content">
               <div class="login-title">
                  <h1>
                     Login
                  </h1>
                  <p>Please login using acount detail bellow.</p>
               </div>
               <form class="form" method="post" action="<?php echo login_submit ?>">
                  <input type="text" placeholder="Email or Username" class="inputs">
                  <input type="password" placeholder="Enter your Password" class="inputs">

               </form>
               <div class="remember-meta">
                  <div class="custom-control custom-checkbox">
                     <input type="checkbox" class="custom-control-input" id="rememberMe">
                     <label class="custom-control-label" for="rememberMe">Remember Me</label>
                  </div>
                  <a href="#" class="forget-pwd mb-3">Forget Password?</a>
               </div>
               <div class="single-input-item">
                  <a href="#" class="btn">Login</a>
               </div>
            </div>
         </div>
         <div class="login">
            <div class="login-content">
               <div class="login-title">
                  <h1>
                     Create Account
                  </h1>
                  <p>Please login using acount detail bellow.</p>
               </div>
               <form class="form" method="post" action="<?php echo login_submit ?>">
                  <input type="text" placeholder="First Name" name="fname" class="inputs">
                  <input type="text" placeholder="Last Name" name="lname" class="inputs">
                  <input type="email" placeholder="Email or Username" name="email"  class="inputs">
                  <input type="password" placeholder="Enter your password" name="password" class="inputs">
                  <input type="password" placeholder="Enter your confirm password" name="Confirm_passwords" class="inputs">

                  <div class="remember-meta">
                     <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="rememberMe">
                        <label class="custom-control-label" for="rememberMe">Subscribe Our Newsletter</label>
                     </div>
                  </div>
                  <div class="single-input-item">
                     <input type="submit" class="btn" name="register">
                     <!-- <a href="#" class="btn">Register</a>s -->
                  </div>

               </form>

            </div>
         </div>
      </div>
      </section>


      <?php

      require_once dirname(__FILE__) . "/layout/footer.php";

      ?>